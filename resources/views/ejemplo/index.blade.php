<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesion</title>
    <style>
        @import url('https://fonts.googleapis.com/css bladen+Sans:400,600,700&display=swap');
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
            background: #111;
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
            width: 300px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
        }

        .login h2 {
            font-size: 2em;
            color: #fff;
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
            color: #fff;
            box-shadow: none;
            outline: none;
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
            color: #fff;
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
                <h2>Login</h2><br>
                <div class="inputBx">
                    <input type="email" id="email" name="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><br>
                <div class="inputBx">
                    <input type="password" id="password" name="password" placeholder="Contraseña" class="@error('password') is-invalid @enderror" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><br>
                <div class="inputBx">
                    <a href="{{ url('/') }}" class="volver">Regresar</a>
                    <input type="submit" value="Iniciar Sesion">
                </div><br><br>
                <div class="inputBx">
                </div>
            </form>
        </div>
    </div>
</body>
</html>