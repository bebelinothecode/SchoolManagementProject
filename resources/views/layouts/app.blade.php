<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  //jquery --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js@11.0.2/public/assets/scripts/choices.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@11.0.2/public/assets/styles/choices.min.css">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div id="app">

        @include('layouts.navbar')
        
        <div class="main flex flex-wrap justify-end mt-16">
            
            @include('layouts.sidebar')

            <div class="content w-full sm:w-5/6">
                <div class="container mx-auto p-4 sm:p-6">

                    @yield('content')
                    
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(function() {
            $( "#opennavdropdown" ).on( "click", function() {
                $( "#navdropdown" ).toggleClass( "hidden" );
            })
        })
    </script>

    @stack('scripts')
    @stack('select_form')

</body>
</html>