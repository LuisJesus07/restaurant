@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-success float-right ml-5">Hoy</span>
                    <h5>Clientes</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$num_clientes_hoy}}</h1>
                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                    <small>Mesas atendidas hoy</small>
                </div>
            </div>

            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">Mes</span>
                    <h5>Clientes</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$num_ventas_mes}}</h1>
                    <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                    <small>Mesas atendidas este mes</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">Hoy</span>
                    <h5>Ventas</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{$monto_ventas_hoy}}</h1>
                    <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                    <small>Monto total</small>
                </div>
            </div>

            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-danger float-right">Low</span>
                    <h5>User activity</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">80,600</h1>
                    <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                    <small>In first month</small>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Ventas de la semana</h5>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <canvas id="barChart1" height="140"></canvas>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Meseros mas productivos (de los ultimos 6 meses)</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="barChart2" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Meseros mas productivos (de la semana)</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="barChart3" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- ChartJS-->
<script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>
<script type="text/javascript">
    $(function () {

        const sales_week = {!! json_encode($sales_week) !!};
        const ventas_meseros_month = {!! json_encode($ventas_meseros_month) !!};
        const ventas_meseros_week = {!! json_encode($ventas_meseros_week) !!};



        var barDataWeek = {
            labels: [
                        sales_week[6].dia, 
                        sales_week[5].dia, 
                        sales_week[4].dia, 
                        sales_week[3].dia, 
                        sales_week[2].dia, 
                        sales_week[1].dia, 
                        sales_week[0].dia
                    ],
            datasets: [
                {
                    label: "Ventas(monto)",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [
                            sales_week[6].total_amount,
                            sales_week[5].total_amount, 
                            sales_week[4].total_amount, 
                            sales_week[3].total_amount, 
                            sales_week[2].total_amount, 
                            sales_week[1].total_amount, 
                            sales_week[0].total_amount,
                            
                    ]
                }
                //,
                //{
                //    label: "Data 2",
                //    backgroundColor: 'rgba(26,179,148,0.5)',
                //    borderColor: "rgba(26,179,148,0.7)",
                //    pointBackgroundColor: "rgba(26,179,148,1)",
                //    pointBorderColor: "#fff",
                //    data: [28, 48, 40, 19, 86, 27, 90]
                //}
            ]
        };

        var barDataMeserosMonth = {
            labels : [
                    ventas_meseros_month[5].name,
                    ventas_meseros_month[4].name,
                    ventas_meseros_month[3].name,
                    ventas_meseros_month[2].name,
                    ventas_meseros_month[1].name,
                    ventas_meseros_month[0].name
            ],
            datasets : [
                {
                    label: "Ventas(monto)",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [
                        ventas_meseros_month[5].total_amount,
                        ventas_meseros_month[4].total_amount,
                        ventas_meseros_month[3].total_amount,
                        ventas_meseros_month[2].total_amount,
                        ventas_meseros_month[1].total_amount,
                        ventas_meseros_month[0].total_amount  
                    ]

                }

            ] 
        };

        var barDataMeserosWeek = {
            labels : [
                    ventas_meseros_week[5].name,
                    ventas_meseros_week[4].name,
                    ventas_meseros_week[3].name,
                    ventas_meseros_week[2].name,
                    ventas_meseros_week[1].name,
                    ventas_meseros_week[0].name
            ],
            datasets : [
                {
                    label: "Ventas(monto)",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [
                        ventas_meseros_week[5].total_amount,
                        ventas_meseros_week[4].total_amount,
                        ventas_meseros_week[3].total_amount,
                        ventas_meseros_week[2].total_amount,
                        ventas_meseros_week[1].total_amount,
                        ventas_meseros_week[0].total_amount  
                    ]

                }

            ] 
        };

        var barOptions = {
            responsive: true
        };


        var ctx2 = document.getElementById("barChart1").getContext("2d");
        new Chart(ctx2, {type: 'bar', data: barDataWeek, options:barOptions});

        var ctx2 = document.getElementById("barChart2").getContext("2d");
        new Chart(ctx2, {type: 'bar', data: barDataMeserosMonth, options:barOptions});

        var ctx2 = document.getElementById("barChart3").getContext("2d");
        new Chart(ctx2, {type: 'bar', data: barDataMeserosWeek, options:barOptions});

    });
</script>
@endsection
