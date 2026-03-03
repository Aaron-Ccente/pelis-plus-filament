<!DOCTYPE html>
<html>
<head>
    <title>Acceso restringido</title>
    <style>
        body {
            background:#000000;
            color:white;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            font-family:sans-serif;
            text-align:center;
        }
        .box {
            background:#000119;
            padding:40px;
            border-radius:12px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>403</h1>
        <h2>No tienes acceso a este módulo</h2>
        <p>Tu usuario no cuenta con los permisos necesarios.</p>
        <a href="{{ url('/') }}" style="color:#38bdf8;">Volver al inicio</a>
    </div>
</body>
</html>