            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>
                        Mesas asignadas
                    </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="">
                                Lista de mesas
                            </a>
                        </li> 
                    </ol>
                </div>
                <div class="col-sm-8"> 
                    <div class="title-action">
                        @if(isset($add_action) and $add_action)
                        <a href="{{ url('mesero/') }}"  class="btn btn-primary" >
                            Regresar al inicio
                        </a>
                        @endif
                    </div>
                </div>
            </div>