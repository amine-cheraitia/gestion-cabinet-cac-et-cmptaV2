@extends('main')
@section('title')
Performance globale du cabinet
@endsection
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">{{-- Tableau de bord --}}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / Performance
            globale du cabinet
    </ol>


    <hr>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-chart-pie"></i>
                    Etat des Missions
                </div>

                <div class="card-body  position-relative"><canvas id="myPieChart" style="width: 100% !important;"
                        width="50%" height="30%"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Chiffre d'Affaire par années
                </div>

                <div class="card-body position-relative"><canvas id="myAreaChart" style="width: 100% !important;"
                        width="50%" height="30%"></canvas>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-chart-line"></i>
                    Prestations les plus demandées
                </div>

                <div class="card-body  position-relative"><canvas style="width: 100% !important;" id="myPieChart2"
                        width="50%" height="30%"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-chart-bar"></i>
                    Contribution des Prestations dans le Chiffre d'Affaire
                </div>

                <div class="card-body  position-relative"><canvas style="width: 100% !important;" id="myBarChart2"
                        width="50%" height="30%"></canvas>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <span style="line-height: 50%;" class="mr-2">Employé</span>
            <form id="formExercice" action="{{-- {{route('devis.store')}} --}}" method="get" class="mr-2">
                @csrf
                <select id="selectExercice" class="form-control form-select shadow" style="width: 250px">
                    <option>...</option>
                    @foreach ($users as $user)
                    <option id="{{$user->id}}" value="{{$user->id}}" {{$user->id == request()->id?
                        "selected" : "" }}>{{$user->fullname}}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-tasks"></i>
                    Tâche(s) En cours
                </div>

                <div class="card-body  position-relative"><canvas id="myPieCharttask" style="width: 100% !important;"
                        width="50%" height="30%"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    x_data= JSON.parse('{!! json_encode($xdata) !!}');
    years= JSON.parse('{!! json_encode($years) !!}');
    x_max = JSON.parse('{!! json_encode($x_max) !!}');

    tachesAchevé = null;
    tachesEncours = null;

    missionAchevé = JSON.parse('{!! json_encode($missionAchevé) !!}');
    missionEncours = JSON.parse('{!! json_encode($missionEncours) !!}');

    prestationLabel= JSON.parse('{!! json_encode($prestationDemande) !!}');
    prestationNbr= JSON.parse('{!! json_encode($prestationDemandeeNbr) !!}');

    prestationCaLabel= JSON.parse('{!! json_encode($prestationCALabel) !!}');
    prestationCaMontant= JSON.parse('{!! json_encode($prestationCaMontant) !!}');
    max_montant= JSON.parse('{!! json_encode($max_montant) !!}');
    tachesAchevé = null;
        tachesEncours = null

    /* console.log(prestationLabel+" "+prestationNbr); */
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

<script src="{{asset('assets/charts/chart-area-Chiffre-Affaire-parAnnée.js')}}" defer></script>
{{-- <script src="{{asset('assets/charts/chart-bar-Chiffre-dAffaire.js')}}" defer></script> --}}
<script src="{{asset('assets/charts/chart-pie-prestation-demandé.js')}}" defer></script>
<script src="{{asset('assets/charts/chart-pie-missions.js')}}" defer></script>
<script src="{{asset('assets/charts/chart-bar-contribution-ca.js')}}" defer></script>
<script src="{{asset('assets/charts/chart-pie-tacheIndividuel.js')}}" defer></script>
<script defer>
    $('#selectExercice').change(function (e) {
/*             e.preventDefault();
            let url ="{{url('kpi/usr/')}}"
            let id=$(this).val();

            $('#formExercice').attr('action',url+'/'+id);
            $('#formExercice').submit(); */

console.log($("#selectExercice").val());
        var id = $("#selectExercice").val();

        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{ route('kpi.showUser') }}",
        method:"POST",
        data:{id:id, _token:_token },
        success:function(result)
            {
console.log(chart);
chart.data.datasets[0].data= [result.tachesAchevé,result.tachesEncours]

                console.log(chart.data.datasets.data);
                chart.update();

/*             $('#montant').val(result.total);
            $('#total').val(result.total);
            $('#prestation').val(result.designation);
            console.log(result.zyada); */

            }

        })
    });
</script>
@endsection
