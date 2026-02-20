<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>InmobilarIA | Generar Ficha</title>
</head>
<body>
    <div class="container">
    <h1>InmobilarIA</h1>
    <form action="{{ route('procesar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="descripcion" placeholder="Ej: Casa 3 pisos, jardín, cerca de escuela..."></textarea>
        <input type="file" name="foto">
        <button type="submit">Generar Ficha con IA</button>
    </form>
</div>
</body>
</html>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f7f6;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
    }
    h1 {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    textarea {
        width: 100%;
        height: 120px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        resize: none;
        box-sizing: border-box;
    }
    input[type="file"] {
        font-size: 0.9rem;
    }
    button {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.3s;
    }
    button:hover {
        background-color: #2980b9;
    }
</style>


