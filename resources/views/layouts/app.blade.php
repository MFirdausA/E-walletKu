<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <style>
            .poppins-thin {
            font-family: "Poppins", serif;
            font-weight: 100;
            font-style: normal;
            }

            .poppins-extralight {
            font-family: "Poppins", serif;
            font-weight: 200;
            font-style: normal;
            }

            .poppins-light {
            font-family: "Poppins", serif;
            font-weight: 300;
            font-style: normal;
            }

            .poppins-regular {
            font-family: "Poppins", serif;
            font-weight: 400;
            font-style: normal;
            }

            .poppins-medium {
            font-family: "Poppins", serif;
            font-weight: 500;
            font-style: normal;
            }

            .poppins-semibold {
            font-family: "Poppins", serif;
            font-weight: 600;
            font-style: normal;
            }

            .poppins-bold {
            font-family: "Poppins", serif;
            font-weight: 700;
            font-style: normal;
            }

            .poppins-extrabold {
            font-family: "Poppins", serif;
            font-weight: 800;
            font-style: normal;
            }

            .poppins-black {
            font-family: "Poppins", serif;
            font-weight: 900;
            font-style: normal;
            }

            .poppins-thin-italic {
            font-family: "Poppins", serif;
            font-weight: 100;
            font-style: italic;
            }

            .poppins-extralight-italic {
            font-family: "Poppins", serif;
            font-weight: 200;
            font-style: italic;
            }

            .poppins-light-italic {
            font-family: "Poppins", serif;
            font-weight: 300;
            font-style: italic;
            }

            .poppins-regular-italic {
            font-family: "Poppins", serif;
            font-weight: 400;
            font-style: italic;
            }

            .poppins-medium-italic {
            font-family: "Poppins", serif;
            font-weight: 500;
            font-style: italic;
            }

            .poppins-semibold-italic {
            font-family: "Poppins", serif;
            font-weight: 600;
            font-style: italic;
            }

            .poppins-bold-italic {
            font-family: "Poppins", serif;
            font-weight: 700;
            font-style: italic;
            }

            .poppins-extrabold-italic {
            font-family: "Poppins", serif;
            font-weight: 800;
            font-style: italic;
            }

            .poppins-black-italic {
            font-family: "Poppins", serif;
            font-weight: 900;
            font-style: italic;
            }

        </style>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik+Mono+One&family=Staatliches&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-G7Y07B8XCW"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-G7Y07B8XCW');
    </script>

        <body>
            <div id="Content-Container"
        class="relative flex flex-col w-full max-w-[640px] min-h-screen mx-auto bg-[#f2f2f7] overflow-x-hidden">

        @yield('content')

            </div>
        </body>
</html>
