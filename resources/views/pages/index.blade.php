<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 0;
                top: 15px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                display: inline-block;
                color: #FFF;
                padding: 10px 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                margin-right: 15px;
                border-radius: 4px;
                background-color: #e74c3c;
            }

            .links a:hover {
                background-color: #FF6656;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            blockquote {
                font-family: Georgia, serif;
                font-size: 16px;
                font-style: italic;
                max-width: 500px;
                margin: 0.25em 0;
                padding: 0 20px;
                line-height: 1.45;
                position: relative;
                color: #383838;
            }

            blockquote:before {
                display: block;
                content: "\201C";
                font-size: 48px;
                position: absolute;
                left: -20px;
                top: -20px;
                color: #FFF;
            }

            blockquote:after {
                display: block;
                content: "\201D";
                font-size: 48px;
                position: absolute;
                right: -20px;
                bottom: -20px;
                color: #FFF;
            }

            blockquote cite {
                color: #999999;
                font-size: 14px;
                display: block;
                margin-top: 5px;
            }

            blockquote cite:before {
                content: "\2014 \2009";
            }

            .welcome {
                background-size: cover;
                background: no-repeat center center;
                transition: background 0.5s linear;
            }

            .white {
                color: #FFF;
            }
        </style>
    </head>
    <body>
        <div class="welcome flex-center position-ref full-height" style="background-image: url({!! asset($wallpaper->path) !!})">
            <div class="top-right links">
                @if (Auth::guest())
                    <a class="btn-link" href="{{ url('/login') }}">Login</a>
                    <a class="btn-link" href="{{ url('/register') }}">Register</a>
                @else
                    <a href="{{ url('/home') }}">Home</a>
                @endif
            </div>
            <div class="content">
                <div class="title m-b-md white">
                    {{ config('app.name') }}
                </div>
                <div class="quote">
                    <blockquote class="white">
                        {{ $quote->text }}
                        <cite class="white">{{ $quote->by }}</cite>
                    </blockquote>
                </div>
            </div>
        </div>
    </body>
</html>
