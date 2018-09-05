<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sky - Trolley Tracking System</title>
        <link href="{{ asset('public/css/all.css') }}" rel="stylesheet">
        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> --}}

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
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        {{-- <a href="{{ url('/home') }}">Home</a> --}}
                    @else
                        {{-- <a href="{{ route('login') }}">Login</a> --}}
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                     <img src="{{url('public/images/tts.png')}}" alt="homepage" class="dark-logo" /><br>
                     <hr>
                     <a href="{{url('home')}}"><button class="btn btn-info btn-lg" title="Click to goto Home"><i class="fa fa-home" aria-hidden="true"></i> HOME</button></a>
          {{--           Trolley Tracking System --}}
                </div>

               
            </div>
        </div>
        <footer class="footer">
    <small style="font-size:12px"><b>© 2018</b> <a href="https://www.skylogistics.com.ph" target="_blank"><img src="{{url('public/images/skykitchen.png')}}" style="width:100px;height:auto"> <img src="{{url('public/images/skylogisitics.png')}}" style="width:100px;height:auto"> </a> | Trolley Tracking System | <a href="http://www.nikkozabala.com" target="_blank" style="font-size:90%;"> created by: Nikko Zabala</a></small>
</footer>`
    </body>
</html>
