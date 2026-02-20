<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Propiedad - InmobilarIA</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .ficha-container {
            background: white;
            max-width: 800px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .property-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .description {
            line-height: 1.6;
            color: #34495e;
            font-size: 1.1rem;
            white-space: pre-line;
        }
        .actions {
            margin-top: 30px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .btn {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: opacity 0.3s;
        }
        .btn-back {
            background-color: #95a5a6;
            color: white;
        }
        .btn-back:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="ficha-container">
        <div class="header">
            <h1>Ficha de Propiedad</h1>
        </div>
        <div class="content">
            @if(isset($foto))
                <img src="{{ asset('storage/' . $foto) }}" alt="Propiedad" class="property-image">
            @endif
            
            <div class="description">
                {{ $descripcion_ia }}
            </div>

            <div class="actions">
                <a href="/" class="btn btn-back">Volver a generar</a>
            </div>
        </div>
    </div>
</body>
</html>
