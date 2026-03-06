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

        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0;">

            <form action="{{ route('crear-directorio') }}" method="POST" style="gap: 0.8rem;">
                @csrf

                <div class="input-group">

                    <label for="title">Nuevo Directorio</label>

                    <div style="display: flex; gap: 8px;">
                        <input type="text" name="title" id="title" placeholder="Nombre de la carpeta..." 
                            style="flex: 1; 
                                   padding: 10px; 
                                   border: 2px solid #e2e8f0; 
                                   border-radius: 10px; 
                                   font-size: 0.9rem;
                                   outline: none;
                                   transition: border-color 0.2s;"
                            onfocus="this.style.borderColor='var(--primary)'"
                            onblur="this.style.borderColor='#e2e8f0'">
                            @error('title')<span style=""color: #ef4444; font-size: 0.75rem; margin-top: 4px;> {{$message}} </span>@enderror
                        
                        <button type="submit" 
                            style="background-color: #64748b; padding: 10px 15px; font-size: 0.85rem; white-space: nowrap;">
                            <i class="fa-solid fa-folder-plus"></i>
                            Crear
                        </button>
                        @if(session('success'))
                            <span style="color: #22c55e; font-size: 0.75rem; margin-top: 4px;"> {{ session('success') }} </span>
                        @endif

                    </div>
                </div>
            </form>
        </div>

        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0;">
            <form action="{{ route('images.upload') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf

                <div class="input-group">
                    <label for="directory">Selecciona directorio</label>
                    <select name="title" id="directory" 
                        style="padding: 10px; 
                               border: 2px solid #e2e8f0; 
                               border-radius: 10px; 
                               font-size: 0.9rem;
                               outline: none;
                               transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--primary)'"
                        onblur="this.style.borderColor='#e2e8f0'">
                        <option value="">-- Selecciona un directorio --</option>
                        @foreach($directories ?? [] as $dir)
                            <option value="{{ $dir }}">{{ $dir }}</option>
                        @endforeach
                    </select>
                    @error('title')<span style="color: #ef4444; font-size: 0.75rem; margin-top: 4px;"> {{$message}} </span>@enderror
                </div>

                <div class="input-group">
                    <label for="filename">Nombre del archivo (sin extensión)</label>
                    <input type="text" name="filename" id="filename" placeholder="ej: foto_principal_salon" 
                        style="padding: 10px; 
                               border: 2px solid #e2e8f0; 
                               border-radius: 10px; 
                               font-size: 0.9rem;
                               outline: none;
                               transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--primary)'"
                        onblur="this.style.borderColor='#e2e8f0'">
                    <small style="color: #64748b; margin-top: 4px;">Solo letras, números, guiones y guiones bajos</small>
                    @error('filename')<span style="color: #ef4444; font-size: 0.75rem; margin-top: 4px;"> {{$message}} </span>@enderror
                </div>

                <div class="input-group">
                    <label>Subir imagen a R2</label>
                    <div class="file-upload" onclick="document.getElementById('imageR2').click()">
                        <input type="file" name="image" id="imageR2" accept="image/*" onchange="updateR2FileName(this)">
                        <div class="file-label" id="file-label-r2">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Haz clic para subir imagen</span>
                            <small>(JPEG, PNG, JPG, WebP - máx 5MB)</small>
                        </div>
                    </div>
                    @error('image')<span style="color: #ef4444; font-size: 0.75rem; margin-top: 4px;"> {{$message}} </span>@enderror
                </div>

                <button type="submit" style="background-color: #10b981;">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    Subir a R2
                </button>

                @if(session('image_success'))
                    <div style="padding: 12px; background-color: #dcfce7; border: 1px solid #22c55e; border-radius: 8px; color: #166534; font-size: 0.85rem;">
                        <i class="fa-solid fa-check-circle"></i> {{ session('image_success') }}
                    </div>
                @endif

                @if(session('image_error'))
                    <div style="padding: 12px; background-color: #fee2e2; border: 1px solid #ef4444; border-radius: 8px; color: #991b1b; font-size: 0.85rem;">
                        <i class="fa-solid fa-exclamation-circle"></i> {{ session('image_error') }}
                    </div>
                @endif
            </form>
        </div>
    </div>


    <script>
        function updateFileName(input) {
            const label = document.getElementById('file-label-text');
            if (input.files && input.files.length > 0) {
                label.innerHTML = `<i class="fa-solid fa-file-circle-check"></i> <span>${input.files.length} archivo(s) seleccionado(s)</span>`;
            }
        }

        function updateR2FileName(input) {
            const label = document.getElementById('file-label-r2');
            if (input.files && input.files.length > 0) {
                label.innerHTML = `<i class="fa-solid fa-file-circle-check"></i> <span>${input.files[0].name}</span>`;
            }
        }
    </script>
</body>
</html>