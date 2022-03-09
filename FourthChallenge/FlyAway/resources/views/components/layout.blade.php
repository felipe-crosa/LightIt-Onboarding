<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Laravel</title>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>




</head>




<body id="app" style="font-family: Open Sans, sans-serif" class="bg-slate-300">
    <section class="px-3 py-4">
        <nav class="mt-0 md:flex md:justify-between md:items-center bg-slate-600 border border-black border-opacity-5 rounded-xl text-center py-6 px-10">
            <div>
                <a href="/" class="flex">
                    <img src="/images/plane.svg" alt="" class="mx-auto" style="width: 50px;">
                    <p class="px-3"><strong> FlyAway</strong> </p>
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                <a class="{{ request()->is('register') ? 'font-semibold' : '' }} font-medium text-black hover:text-gray-400" href='/flights'>Flights</a>
                <a class="{{ request()->is('register') ? 'font-semibold' : '' }} ml-14 font-medium text-black hover:text-gray-400" href='/airlines'>Airlines</a>
                <a class="{{ request()->is('register') ? 'font-semibold' : '' }} mx-14 font-medium text-black hover:text-gray-400" href='/cities'>Cities</a>
            </div>


        </nav>

        {{ $slot }}

        <footer id="footer"
            class="bg-slate-600 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="/images/plane.svg" alt="" class="mx-auto mb-3" style="width: 100px;">

            <h5 class="text-3xl">If traveling, think of FlyAway!</h5>
            <p class="text-sm mt-3">The best way to plan your flights.</p>


        </footer>
    </section>

    <x-flash/>
    <script src="/js/app.js"> </script>
</body>

</html>
