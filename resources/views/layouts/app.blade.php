<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Art On Wheels') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Favicon -->
    {{--    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">--}}
    {{--    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">--}}
    {{--    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">--}}
    {{--    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">--}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png')}}">
    {{--    <link rel="manifest" href="/manifest.json">--}}'
    {{--    <meta name="msapplication-TileColor" content="#ffffff">--}}
    {{--    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">--}}
    {{--    <meta name="theme-color" content="#ffffff">--}}
<!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous"/>

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media_query.css') }}" rel="stylesheet">

</head>
<body>
<div id="app " class="d-flex fdc">
    <div class="container d-flex fdc">
        <header>
            <div class="one d-flex">
                <div class=" d-flex item1 bg_white"></div>
                <div class=" d-flex item2 bg_white">

                </div>
                <div class=" d-flex item3 bg_white"></div>
                <div class=" d-flex item4 bg_white">
                    <h2 class="slogan">{{__('messages.slogan')}}</h2>
                </div>
                <div class=" d-flex item5 bg_yellow">
                    <img src="{{asset('images/bus_logo.png')}}" alt="logo" class="d-flex" id="pot"></div>
                <div class=" d-flex item6 bg_white"></div>
            </div>
            <div class="two d-flex">
                <div class=" d-flex item7 bg_blue"></div>
                <div class=" d-flex item8 bg_white">

                </div>
                <div class="d-flex item9 bg_red"></div>
                <div class=" d-flex item10 bg_white">

                </div>
                <div class=" d-flex item11 bg_blue"></div>
            </div>
        </header>
        <div class="d-flex fdr">
            <section class="fdc d-flex left_block">
                <nav class="fdc">
                    <div class="three d-flex">
                        <div class=" d-flex item12 bg_black"></div>
                        <div class=" d-flex item13 bg_white">
                            <div class="i">
                                @php
                                    $icons = getSocial();
                                $r_count = getRoutCount();
                                $route = getRout();

                                @endphp
                                <a href="/"><i class="icon fas fa-home"></i></a>
                                <a href="{{route('map')}}"><i class="icon fas fa-compact-disc"></i></a>
                                <a href="#"><i class="icon fas fa-search-plus "></i>

                                </a>
                                @if(!empty($r_count)  && $r_count==1)
                                    <a href="{{route('routes',[$route->id])}}"><i
                                            class="icon fas fa-map-marker-alt"></i></a>
                                @else
                                    @php
                                        $routes = getRouts();
                                    @endphp
                                    <a href="javascript:void(0)" onclick="openRoute()"><i
                                            class="icon fas fa-map-marker-alt dropbtn"></i></a>
                                    <div id="route" class="dropdown-content">
                                        @foreach($routes as $r)
                                            <a href="{{route('routes',$r->id)}}">{{$r->title}}</a>
                                        @endforeach
                                    </div>
                                @endif
                                @if(!empty($icons))
                                    @foreach($icons as $icon)
                                        @if($icon->name === "facebook")
                                            <a href="{{$icon->link}}" target="_blank"><i
                                                    class="icon fab fa-facebook-square"></i></a>
                                        @else
                                            <a href="{{$icon->link}}" target="_blank"><i
                                                    class="icon fab fa-instagram"></i></a>
                                        @endif
                                    @endforeach
                                @endif
                                <a href="#"><i class="icon fas fa-phone-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="two d-flex">
                    <div class=" d-flex item21 bg_white"></div>
                    <div class=" d-flex item22 bg_blue"></div>
                </div>

            </section>
            <main>
                @yield('content')
            </main>
        </div>
        <footer>
            <div class="six d-flex fdr">
                <div class=" d-flex item26 bg_white"></div>
                <div class=" d-flex item27 bg_white"></div>
                {{--            </div>--}}
                {{--            <div class="six d-flex fdr">--}}

                <div class=" d-flex item28 bg_white"></div>
                <div class=" d-flex item29 bg_white"></div>
                <div class=" d-flex item30 bg_yellow"></div>
                <div class=" d-flex item31 bg_white">
                    <img src="{{asset('images/storagrutyun.png')}}" alt="signature" class="d-flex">
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{asset("assets/js/main.js/")}}"></script>
</body>
</html>

