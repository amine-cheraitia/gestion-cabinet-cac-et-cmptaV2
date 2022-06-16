@extends('main')

@section('content')
<style>

</style>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tableau de bord</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tableau de bord</li>
    </ol>

    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card text-white bg-dark mb-5">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <i style="font-size: 35px" class="fas fa-tasks"></i>
                    <div>Tâche(s) En cours <br>
                        <div class="text-center fs-8 w-100">{{ $tachesEncours }}</div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('tache.list')}}">Voir plus</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>

            <div class="card bg-primary text-white  mb-5">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <i style="font-size: 35px" class="fas fa-check-double"></i>
                    <div>Tâche(s) Achevée(s) <br>
                        <div class="text-center fs-8 w-100">{{$tachesAchevé}}</div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('tache.list')}}">Voir plus</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>


        </div>
        <div class="col-xl-6 col-md-12 col-sm-12">
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-chart-pie"></i>
                    Etat des Missions
                </div>

                <div class="card-body position-relative "><canvas id="myPieCharttask" style="width: 100% !important;"
                        width="50%" height="30%"></canvas></div>
            </div>
        </div>





    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        tachesAchevé = JSON.parse('{!! json_encode($tachesAchevé) !!}');
        tachesEncours = JSON.parse('{!! json_encode($tachesEncours) !!}');
        /*y_data=JSON.parse(); */

/*     $('#year').change(function (e) {

        var y = $('#year').val();
        var _token = $('input[name="_token"]').val();
        console.log(y);
        $.ajax({
            type: "post",
            url: "{{route('fetchCA')}}",
            data: {y:y,_token:_token },
            dataType: "dataType",
            success: function (response) {
                console.log(response);
                x_data= response.xdata,
                x_max=response.x_max
            }
        });

    }); */
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    {{-- <script src="{{asset('assets/charts/chart-bar-Chiffre-dAffaire.js')}}" defer></script>--}}
    <script src="{{asset('assets/charts/chart-pie-tacheIndividuel.js')}}" defer></script>
    @endsection
