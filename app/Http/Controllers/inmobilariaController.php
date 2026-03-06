<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class inmobilariaController extends Controller
{
    /* Porcesaro texto e imagenes para la generación de ficha */
   public function procesarFicha(Request $request){
        $descripcionUsuario = $request->input('descripcion');
        $archivos = $request->file('imagenes');
        
        $contenidoUsuario = [];

        // Agregamos el texto si existe
        if ($descripcionUsuario) {
            $contenidoUsuario[] = [
                "type" => "text", 
                "text" => "Información en texto proporcionada: " . $descripcionUsuario
            ];
        }

        // Agregamos las imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($archivos as $archivo) {
                $base64 = base64_encode($archivo->get());
                $contenidoUsuario[] = [
                    "type" => "image_url",
                    "image_url" => [
                        "url" => "data:image/jpeg;base64,$base64",
                        "detail" => "high" // Forzamos alta resolución para leer el texto pequeño
                    ]
                ];
            }
        }

        $promptSistema = <<<EOD
            # ROL
            Eres un experto en OCR y extracción de datos inmobiliarios.
            Tu objetivo es transcribir la información de IMÁGENES (flyers, anuncios) o TEXTO a un formato JSON.

            # INSTRUCCIONES DE VISIÓN
            1. Lee todo el texto contenido en la imagen, incluyendo el que acompaña a los emojis.
            2. Si ves un signo de pesos ($) seguido de números, eso es el "precio".
            3. Si ves números seguidos de "m2", son las superficies de terreno o construcción.
            4. Los iconos de camas, baños o coches indican los datos de la "ficha_tecnica".

            # REGLAS DE ORO
            - Extrae la información aunque el formato sea comercial.
            - Si el dato es numérico, elimina letras y símbolos (ej: "1,080 m2" -> 1080).
            - SOLO usa null si realmente el dato no existe en ninguna parte de la imagen.

            # ESQUEMA DE SALIDA (JSON ÚNICAMENTE)
            {
            "titulo": "string",
            "tipo_vivienda": "Casa | Departamento | Terreno",
            "precio": number,
            "moneda": "MXN",
            "ubicacion": { "ciudad": "string", "estado": "string", "zona": "string" },
            "superficie": { "terreno_m2": number, "construccion_m2": number },
            "ficha_tecnica": { "niveles": number, "recamaras": number, "banos": number, "estacionamiento_autos": number },
            "amenidades": []
            }
        EOD;

        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini', 
                'messages' => [
                    ['role' => 'system', 'content' => $promptSistema],
                    ['role' => 'user', 'content' => $contenidoUsuario]
                ],
                'response_format' => ['type' => 'json_object']
            ]);

        // Validación de seguridad para evitar el error del foreach
        $data = $response->json();
        if (!isset($data['choices'][0]['message']['content'])) {
            return response()->json(['error' => 'La IA no pudo procesar la imagen'], 500);
        }

        return response()->json(json_decode($data['choices'][0]['message']['content']));
    }

    public function directory(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $carpeta = strtoupper($request->title);
        $ruta = "casas/{$carpeta}/.keep";


        Storage::disk('r2')->put($ruta,'');

        return redirect()->back()->with('success',"Archivo subido a la carpeta virtual"); 
    }


}
