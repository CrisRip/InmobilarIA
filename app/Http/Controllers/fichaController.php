<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class fichaController extends Controller
{
    public function generar(Request $request) {
        $textoUsuario = $request->input('descripcion');
        $foto = $request->file('foto')->get(); // Obtenemos el contenido binario
        $base64Image = base64_encode($foto);

        $client = OpenAI::client(env('OPENAI_API_KEY'));

        $response = $client->chat()->create([
            'model' => 'gpt-4o', 
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        ['type' => 'text', 'text' => "Crea una ficha técnica profesional con este texto: $textoUsuario"],
                        ['type' => 'image_url', 'image_url' => ['url' => "data:image/jpeg;base64,$base64Image"]]
                    ],
                ],
            ],
        ]);

        return view('ficha', ['resultado' => $response->choices[0]->message->content]);
    }
            
}
