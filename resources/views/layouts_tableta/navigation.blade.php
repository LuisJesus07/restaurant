        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <!-- <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                        <i class="fa fa-bars"></i>
                    </a>  -->

                    <a class="navbar-minimalize minimalize-styl-2  " >
                        <i class="fa fa-user-circle-o fa-2x"></i> 
                        <b>
                            {{ Auth()->user()->name }} {{ Auth()->user()->lastname }}
                        </b>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">

                    <li>
                        <span class="m-r-sm text-muted welcome-message">
                            Punto de venta - Hacienda el paraíso
                        </span>
                    </li> 

                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <i class="fa fa-sign-out"></i> <b style="color: black;">Salir de la cuenta</b>
                        </a>
                    </li>
                    
                </ul> 
            </nav>
        </div>