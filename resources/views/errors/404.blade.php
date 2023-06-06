<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Pagina no encontrada</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <style>
        body {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                height: 100%;
                background-image: url("{{ asset('dist/img/img-404.gif') }}");
                background-size: cover;
            }
            
            img {
                max-width: 100%;
                height: auto;
            }

            h1 {
                font-size: 8rem;
                margin-top: 3rem;
                margin-bottom: 0;
                text-align: center;
                color: #FFC107;
            }

            h2 {
                text-align: center;
                color: #F48A1D;
            }

            p {
                font-size: 1.2rem;
                text-align: center;
                margin-top: 1.5rem;
            }

            a {
                font-size: 1.2rem;
                color: green;
                text-decoration: none;
                margin-top: 1rem;
            }
    </style>
</head>
<body>
    <div>
        <h1>404</h1>
        <h2><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Página no encontrada.</h2>
        <p>No pudimos encontrar la pagina que estabas buscando.</p>
        <a href="{{ url('/home') }}">Regresar al inicio</a>
    </div>
</body>
</html>