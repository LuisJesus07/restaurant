<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    @yield('head')
</head>

<body class="mini-navbar">

    <div id="wrapper"> 

        <div id="page-wrapper" class="gray-bg" style="width: 100% !important;">

        @include('layouts_tableta.navigation')

        @if(isset($breadcrum) and $breadcrum)
            @include('layouts_tableta.breadcrum')
        @endif

            @yield('breadcrum')

            <div class="wrapper wrapper-content" >

                @yield('content')
                 
            </div>
            
            @include('layouts.footer')

        </div>

    </div>

    @include('layouts.scripts') 
    @yield('scripts')

</body>

</html>
