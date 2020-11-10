<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    @yield('head')
</head>

<body class="">

    <div id="wrapper">

    @include('layouts.sidebar')

        <div id="page-wrapper" class="gray-bg">

        @include('layouts.navigation')

            @include('layouts.breadcrum')

            <div class="wrapper wrapper-content">

                @yield('content')

                 
            </div>
            
            @include('layouts.footer')

            @yield('modals')
            
        </div>

    </div>

    @include('layouts.scripts') 
    @yield('scripts')

</body>

</html>
