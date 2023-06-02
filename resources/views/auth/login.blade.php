<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesion</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url({{ asset('dist/img/lab2.jpg') }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            opacity: 0; 
            transition: opacity ease-in-out 1s;
        }

        body.loaded {
            opacity: 1; /* Establecer la opacidad en 1 después de cargar */
        }

        .square {
            position: relative;
            width: 500px;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .square i {
            position: absolute;
            inset: 0;
            border: 2px solid #fff;
            transition: 0.5s;
        }

        .square i:nth-child(1) {
            border-radius: 38% 62% 63% 37% / 41% 44% 56% 59%;
            animation: animate 6s linear infinite;
        }

        .square i:nth-child(2) {
            border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
            animation: animate 4s linear infinite;
        }

        .square i:nth-child(3) {
            border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
            animation: animate 10s linear infinite;
        }

        .square:hover I {
            border: 6px solid var(--clr);
            filter: drop-shadow(0 0 20px var(--clr));
        }

        @keyframes animate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes animate2 {
            0% {
                transform: rotate(360deg);
            }
            100% {
                transform: rotate(0deg);
            }
        }

        .login {
            position: absolute;
            width: 350px;
            height: 450px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
            border: 1px solid #000;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0.8;
        }
        .login:hover {
            color: rgba(255, 255, 255, 1) !important;
            box-shadow: 0 4px 16px #318AAC;
        }

        .login h2 {
            font-size: 2em;
            color: #fff;
            text-align: center;
        }

        .login .inputBx {
            position: relative;
            width: 100%;
        }

        .login .inputBx input {
            position: relative;
            width: 100%;
            padding: 12px 20px;
            background: transparent;
            border: 2px solid #fff;
            border-radius: 40px;
            font-size: 1.2em;
            color: #000;
            box-shadow: none;
            outline: none;
        }

        .login .inputBx .email {
            color: #fff;
            margin: 5px;
        }
        .login .inputBx .password {
            color: #fff;
            margin: 5px;
        }

        .login .inputBx input[type="submit"] {
            width: 56%;
            background: linear-gradient(to right, #a0b5eb 0%,#ea52f8 0%,#0066ff 100%);
            border: none;
            cursor: pointer;
        }

        .login .inputBx input[type="submit"]:hover {
            color: rgba(255, 255, 255, 1) !important;
            box-shadow: 0 4px 16px #318AAC;
            transition: all 0.2s ease;
            text-shadow: 1px 1px 6px #fff;
        }
        
        .volver {
            position: relative;
            width: 150%;
            padding: 12px 20px;
            background: transparent;
            border: 2px solid #fff;
            border-radius: 40px;
            font-size: 1.2em;
            color: #000;
            box-shadow: none;
            outline: none;
            background: linear-gradient(90deg, #318AAC, #6DCEE1);
            border: none;
            cursor: pointer;
        }

        .volver:hover {
            color: rgba(255, 255, 255, 1) !important;
            box-shadow: 0 4px 16px #318AAC;
            transition: all 0.2s ease;
            text-shadow: 1px 1px 6px #fff;
        }

        a:link, a:visited, a:active {
            text-decoration:none;
        }
        
    </style>
</head>
<body>
    <div class="square">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
        <div class="login">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h2>{{ __('Iniciar Sesión') }}</h2><br>
                <div class="inputBx">
                    <input type="email" id="email" name="email" placeholder="Email" class="email @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @php
                    // Inicializar variable para contar errores
                        $errorCount = 0;
                    @endphp
                    @foreach ($errors->get('email') as $error)
                        @php
                            // Incrementar contador de errores
                            $errorCount++;
                        @endphp
                        <div style="background-color: white; width: 280px; margin: 10px; padding: 2px; border-radius: 5px; text-align: center;">
                            <small>
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    {{ $error }} {{ $errorCount }}
                                </span>
                            </small>
                        </div>
                    @endforeach
                    @if ($errorCount >= 3)
                        <!-- Mostrar contador sólo si hay 3 o más errores -->
                        <div id="countdown" style="background-color: white; width: 280px; margin: 10px; padding: 2px; border-radius: 5px; text-align: center;"></div>
                        <script>
                            var timeLeft = 60; // tiempo deseado en segundos
                            var countdownEl = document.getElementById('countdown');
                            setInterval(function() {
                                if (timeLeft > 0) {
                                    countdownEl.innerHTML = 'Puede intentarlo nuevamente en ' + timeLeft + ' segundos';
                                    timeLeft--;
                                } else {
                                    countdownEl.innerHTML = '';
                                }
                            }, 1000);
                        </script>
                    @endif
                </div>
                <div class="inputBx">
                    <input type="password" id="password" name="password" placeholder="Contraseña" class="password @error('password') is-invalid @enderror" required autocomplete="current-password">
                    @php
                    // Inicializar variable para contar errores
                        $errorCount = 0;
                    @endphp
                    @foreach ($errors->get('password') as $error)
                        @php
                            // Incrementar contador de errores
                            $errorCount++;
                        @endphp
                        <div style="background-color: white; width: 280px; margin: 5px; padding: 2px; border-radius: 5px;">
                            <small>
                                <span class="invalid-feedback" role="alert" style="color: red">
                                    {{ $message }}
                                </span>
                            </small>
                        </div>
                        @endforeach
                        @if ($errorCount >= 3)
                            <!-- Mostrar contador sólo si hay 3 o más errores -->
                            <div id="countdown" style="background-color: white; width: 280px; margin: 10px; padding: 2px; border-radius: 5px; text-align: center;"></div>
                            <script>
                                var timeLeft = 60; // tiempo deseado en segundos
                                var countdownEl = document.getElementById('countdown');
                                setInterval(function() {
                                    if (timeLeft > 0) {
                                        countdownEl.innerHTML = 'Puede intentarlo nuevamente en ' + timeLeft + ' segundos';
                                        timeLeft--;
                                    } else {
                                        countdownEl.innerHTML = '';
                                    }
                                }, 1000);
                            </script>
                        @endif
                </div><br>
                <div class="links">
                    <input type="checkbox" name="show-password" id="show-password"><label for="show-password">&nbsp;&nbsp;Mostrar contraseña</label> 
                </div><br>
                <div class="inputBx">
                    <a href="{{ url('/') }}" class="volver">Regresar</a>
                    <input type="submit" value="Iniciar Sesion">
                </div><br><br>
            </form>
        </div>
    </div>
    <script>
        // var index = 0;
        // var images = [
        //     "ruta_de_imagen_1.jpg",
        //     "ruta_de_imagen_2.jpg",
        //     "ruta_de_imagen_3.jpg"
        // ];
        // var slider = document.createElement("img");
        // slider.setAttribute("src", images[index]);
        // slider.setAttribute("style", "position: absolute; top: 0px; left: 0px; transition: opacity ease-in-out 1s;");
        // document.body.appendChild(slider);

        // setInterval(function() {
        //     index = (index + 1) % images.length;
        //     slider.style.opacity = "0";
        //     setTimeout(function() {
        //         slider.setAttribute("src", images[index]);
        //         slider.style.opacity = "1";
        //     }, 1000);
        // }, 5000);

        document.addEventListener("DOMContentLoaded", function() {
            document.body.classList.add("loaded"); /* Agregar la clase loaded a body después de cargar */
        });

        const checkbox = document.getElementById('show-password');
        const passwordInput = document.getElementById('password');

        function togglePasswordVisibility() {
        if (checkbox.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
        }

        checkbox.addEventListener('change', togglePasswordVisibility);
    </script>
</body>
</html>