<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

use Intervention\Image\Laravel\Facades\Image;

class ImageController extends Controller

{

    public function uploadImage(Request $request)
    {
        // Validamos que venga una imagen, el nombre y el título de la carpeta
        $request->validate([
            'title' => 'required|string',
            'filename' => 'required|string|regex:/^[a-zA-Z0-9_-]+$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // máx 5MB
        ], [
            'filename.regex' => 'El nombre solo puede contener letras, números, guiones y guiones bajos.'
        ]);

        try {
            $carpeta = strtoupper($request->title);
            $file = $request->file('image');
            $nombrePersonalizado = $request->filename;

            // Convertimos la imagen a WebP
            $imagen = Image::read($file);

            // Para codificar a WebP
            $webpImage = $imagen->encodeByMediaType('image/webp', quality: 80);

            // Nombre del archivo con extensión .webp
            $nombreArchivo = $nombrePersonalizado . '.webp';

            // Definimos la ruta dentro de tu carpeta 'casas' existente
            $rutaDestino = "casas/{$carpeta}/{$nombreArchivo}";
            // 1. Subimos el archivo convertido a WebP a R2
            Storage::disk('r2')->put($rutaDestino, (string) $webpImage);

            // 2. Obtenemos la URL pública
            $urlPublica = Storage::disk('r2')->url($rutaDestino);

            return back()
                ->with('image_success', "Imagen '{$nombreArchivo}' convertida a WebP y subida correctamente a R2")
                ->with('image_url', $urlPublica);
        } catch (\Exception $e) {
            return back()
                ->with('image_error', 'Error al subir la imagen: ' . $e->getMessage())
                ->withInput();
        }
    }
}
