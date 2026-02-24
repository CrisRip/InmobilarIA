<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InmobilarIA | Generador Inteligente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg: #f8fafc;
            --text: #1e293b;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-color: var(--bg);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: var(--text);
        }

        .container {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 450px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-icon {
            background: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
            color: #0f172a;
        }

        p.subtitle {
            font-size: 0.875rem;
            color: #64748b;
            margin-top: 0.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
        }

        textarea {
            width: 100%;
            height: 120px;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            resize: none;
            box-sizing: border-box;
            transition: border-color 0.2s;
            font-size: 0.95rem;
        }

        textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* Estilo para el input de archivo */
        .file-upload {
            border: 2px dashed #e2e8f0;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-upload:hover {
            background-color: #f1f5f9;
            border-color: var(--primary);
        }

        input[type="file"] {
            display: none;
        }

        .file-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: #64748b;
            font-size: 0.9rem;
        }

        .file-label i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        button {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.2s;
        }

        button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        button i {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-section">
            <div class="logo-icon">
                <i class="fa-solid fa-robot"></i>
            </div>
            <h1>EVOLUCIÓN HABITAD IA</h1>
            <p class="subtitle">Genera fichas técnicas en segundos con IA</p>
        </div>

        <form action="{{ route('procesar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="input-group">
                <label for="descripcion">Descripción o notas</label>
                <textarea 
                    id="descripcion"
                    name="descripcion" 
                    placeholder="Escribe detalles de la propiedad o pega un texto de WhatsApp..."
                ></textarea>
            </div>

            <div class="input-group">
                <label>Flyer o fotografía</label>
                <div class="file-upload" onclick="document.getElementById('foto').click()">
                    <input type="file" name="imagenes[]" id="foto" multiple onchange="updateFileName(this)">
                    <div class="file-label" id="file-label-text">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span>Haz clic para subir imágenes</span>
                        <small>(Flyers o fotos de la casa)</small>
                    </div>
                </div>
            </div>

            <button type="submit">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                Generar Ficha Inteligente
            </button>
        </form>
    </div>

    <script>
        function updateFileName(input) {
            const label = document.getElementById('file-label-text');
            if (input.files && input.files.length > 0) {
                label.innerHTML = `<i class="fa-solid fa-file-circle-check"></i> <span>${input.files.length} archivo(s) seleccionado(s)</span>`;
            }
        }
    </script>
</body>
</html>