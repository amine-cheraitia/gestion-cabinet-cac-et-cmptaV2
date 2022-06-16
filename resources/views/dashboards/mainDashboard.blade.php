@extends('main')

@section('content')
<style>
    /*     div {
        color: #e7bd31;
    } */
</style>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tableau de bord</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tableau de bord</li>
    </ol>

    <div class="row">
        <div class="col-xl-3 col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <i style="font-size: 35px" class="fas fa-project-diagram"></i>
                    <div>Mission(s) En cours <br>
                        <div class="text-center fs-8 w-100">{{$missionEncours}}</div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('mission.list')}}">Voir plus</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4">
            <div class="card bg-primary text-white  mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <i style="font-size: 35px" class="fas fa-tasks"></i>
                    <div>Tâche(s) En cours <br>
                        <div class="text-center fs-8 w-100">{{$tachesEncours}}</div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('tache.list')}}">Voir plus</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-4">
            <div class="card text-white bg-secondary mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    {{-- <i style="font-size: 35px" class="fas fa-file-invoice"></i> --}}
                    <i style="font-size: 35px" class="fas fa-file-invoice-dollar"></i>
                    <div>Chiffre d'Affaire <br>
                        <div class="text-center fs-8 w-100">{{number_format($chiffreDaffaire, 2, ',', ' ')}} DA</div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('facture.list')}}">Voir plus</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>

        </div>

        <div class="col-xl-3 col-md-4">
            <div class="card text-dark bg-warning mb-4">
                <div class="card-body d-flex justify-content-between align-items-center text-secondary">
                    <i style="font-size: 35px" class="fas fa-file-invoice text-secondary"></i>

                    <div>Facture(s) impayée(s)<br>
                        <div class="text-center fs-8 w-100">{{$factImpayé}}</div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-secondary stretched-link " href="{{route('paiement.creances')}}">Voir plus</a>
                    <div class="small text-secondary"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
            {{-- --}}
            {{-- <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Warning card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div> --}}
        </div>
        {{--
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Success Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Chiffre d'Affaire par mois
                </div>

                <div class="card-body position-relative"><canvas id="myBarChart" style="width: 100% !important;"
                        width="50%" height="30%"></canvas></div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-chart-pie"></i>
                    Etat des Missions
                </div>

                <div class="card-body position-relative "><canvas id="myPieChart" style="width: 100% !important;"
                        width="50%" height="30%"></canvas></div>
            </div>
        </div>

        {{-- <div class="card-body col-6"><canvas id="myBarChart" width="50%" height="30%"></canvas></div> --}}
        {{-- <div class="card-body col-md-6  col-sm-12"><canvas id="myPieChart" width="50%" height="30%"></canvas></div>
        celui d'avant --}}
        {{-- <div class="card-body"><canvas id="myBarChart2" width="100%" height="40"></canvas></div> --}}
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    x_data= JSON.parse('{!! json_encode($xdata) !!}');
    x_max = JSON.parse('{!! json_encode($x_max) !!}');
    missionAchevé = JSON.parse('{!! json_encode($missionAchevé) !!}');
    missionEncours = JSON.parse('{!! json_encode($missionEncours) !!}');
    console.log(missionAchevé+" "+missionEncours);
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
<script src="{{asset('assets/charts/chart-bar-Chiffre-dAffaire.js')}}" defer></script>
<script src="{{asset('assets/charts/chart-pie-missions.js')}}" defer></script>
@endsection
