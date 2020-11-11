    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" class="rounded-circle" src="{{ asset('img/user.jpg') }}"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">
                                {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                            </span>
                            <span class="text-muted text-xs block">
                                {{ Auth::user()->role_id }}
                            </span>
                        </a> 
                    </div>
                    <div class="logo-element">
                        HPV
                    </div>
                </li> 

                <li class="{{ (request()->is('user*')) ? 'active' : '' }}">
                    <a href="{{ url('/users') }}">
                        <i class="fa fa-users fa-2x"></i> 
                        <span class="nav-label">
                            USUARIOS
                        </span>
                        <!-- <span class="label label-info float-right">
                            62
                        </span> -->
                    </a>
                </li>  

                <li class="{{ (request()->is('sales')) ? 'active' : '' }}">
                    <a href="{{ url('/sales') }}">
                        <i class="fa fa-money fa-2x"></i> 
                        <span class="nav-label">
                            VENTAS
                        </span> 
                    </a>
                </li>

                <li class="{{ (request()->is('dish*')) ? 'active' : '' }}">
                    <a href="{{ url('/dishes') }}">
                        <i class="fa fa-cutlery fa-2x"></i> 
                        <span class="nav-label">
                            PLATILLOS
                        </span> 
                    </a>
                </li> 

                <li class="{{ (request()->is('table*')) ? 'active' : '' }}">
                    <a href="{{ url('/tables') }}">
                        <i class="fa fa-vcard fa-2x"></i> 
                        <span class="nav-label">
                            MESAS
                        </span> 
                    </a>
                </li> 

                <li class="{{ (request()->is('box')) ? 'active' : '' }} {{ (request()->is('bill_detail*')) ? 'active' : '' }}">
                    <a href="{{ url('/box') }}">
                        <i class="fa fa-inbox fa-2x"></i> 
                        <span class="nav-label">
                            CAJA
                        </span> 
                    </a>
                </li> 
            </ul>

        </div>
    </nav>