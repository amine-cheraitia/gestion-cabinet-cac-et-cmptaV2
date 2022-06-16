@extends('main')
@section('title')
Modification de la tâche: {{$tache->num_tache}}
@endsection
@section('style')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
</script>
</script>

<link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">

@endsection
@section('content')
<h2 class="my-4 text-center">{{-- Liste des tâches --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / <a
            class="text-dark" href="{{route('tache.list')}}">Liste des tâches</a> / Modification de la tâche:
        {{$tache->num_tache}}
    </li>
</ol>

<div class="card shadow ">
    <div class="card-header">
        <h6><i class="fa fa-tasks" aria-hidden="true"></i><strong> Modification de la tâche: {{$tache->num_tache}}
            </strong></h6>
    </div>

    <div class="card-body">


        <form class="row g-3 needs-validation " novalidate method="POST" action="{{route('tache.update',$tache->id)}}">
            @csrf
            @method('PATCH')
            <div class="col-md-12">
                <label for="mission_id" class="form-label">Mission</label>
                <select class="form-select shadow @error('mission_id')is-invalid
                    @enderror" id="mission_id" required name="mission_id">
                    <option selected disabled value="{{null}}">...</option>
                    @foreach ($missions as $mission)
                    <option value="{{$mission->id}}" {{($mission->id==$tache->mission_id)? "selected" : ""
                        }}>{{$mission->title}}</option>
                    @endforeach
                </select>
                @error('mission_id')
                <div class="invalid-feedback">{{$errors->first('mission_id')}}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="user_id" class="form-label">Affecter à </label>
                <select class="form-select shadow @error('user_id')is-invalid
                    @enderror" id="user_id" required name="user_id">
                    <option selected disabled value="">...</option>
                    @foreach ($users as $user)
                    <option value="{{$user->id}}" {{($user->id==$tache->user_id)? "selected" : ""
                        }}>{{ $user->role_f}}</option>
                    @endforeach
                </select>
                @error('user_id')
                <div class="invalid-feedback">{{$errors->first('user_id')}}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="designation" class="form-label">Désignation</label>
                <input type="text" class="form-control shadow  @error('total')is-invalid
                @enderror" id="designation" placeholder="Veuillez décrire la tache"
                    value="{{old('designation') ?? $tache->designation}}" required name="designation">
                @error('designation')
                <div class="invalid-feedback">{{$errors->first('designation')}}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="status" class="form-label">Statut de la tâche</label>
                <select class="form-select shadow @error('status')is-invalid
                @enderror" id="status" required name="status">
                    <option selected disabled value="{{null}}">...</option>
                    <option value=1 {{( 1==$tache->status )? "selected" : ''}}>Achevé</option>
                    <option value=0 {{( 0==$tache->status )? "selected" : ''}}>En cours</option>


                </select>
                @error('entreprise_id')
                <div class="invalid-feedback">{{$errors->first('entreprise_id')}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="start" class="form-label">Date de debut</label>
                <input class="form-control shadow @error('start')is-invalid
                @enderror" id="start" placeholder="Veuillez choisir une date"
                    value="{{old('start') ?? $tache->starte}}" required name="start">
                @error('start')
                <div class="invalid-feedback">{{$errors->first('start')}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="end" class="form-label">Date de fin</label>
                <input class="form-control shadow @error('end')is-invalid
                @enderror" id="end" placeholder="Veuillez choisir une date" value="{{old('end') ?? $tache->ende}}"
                    required name="end">
                @error('end')
                <div class="invalid-feedback">{{$errors->first('end')}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="color" class="form-label">Couleur du fond</label>
                <input style="height: 38px" type="color" class="form-control shadow  @error('color')is-invalid
            @enderror" id="color" value="{{old('color') ?? $tache->color}}" required name="color">
                @error('color')
                <div class="invalid-feedback">{{$errors->first('color')}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="textColor" class="form-label">Couleur du text</label>
                <input style="height: 38px" type="color" class="form-control shadow  @error('textColor')is-invalid
            @enderror" id="textColor" value="{{old('textColor')  ?? $tache->textColor}}" required name="textColor">
                @error('textColor')
                <div class="invalid-feedback">{{$errors->first('textColor')}}</div>
                @enderror
            </div>


            <div class="col-12 text-center mt-5">
                <button class="btn btn-dark shadow mb-5 " type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Erreur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                Veuillez choisir une entreprise !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
/*
        $('#prestation_id').val(null).change();
        $('#entreprise_id').val(null).change();
        $('#devis_id').val(null).change();
        $('#total').val(null).change();
        if(($("#entreprise_id").val()==null ) || ($("#prestation_id").val()==null)  ){
            $('#total').val("");
        } */
        // click entreprise
/*         $('#entreprise_id').click(function (e) {

            if($("#devis_id").val()!==null){
                $('#prestation_id').val(null).change();
                $('#entreprise_id').val(null).change();
                $('#devis_id').val(null).change();
                $('#total').val(null).change();
                $('#modalContent').html("Vous ne pouvez pas modifier l'Entreprise");
                $("#exampleModal").modal('show');
            }

            if($("#prestation_id").val()!==null){

                var entreprise_id = $("#entreprise_id").val();

                var prestation_id =  $('#prestation_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{ route('devis.calculPrix') }}",
                method:"POST",
                data:{entreprise_id:entreprise_id, prestation_id:prestation_id,_token:_token },
                success:function(result){
                    console.log(result);
                    $('#total').val(result);
                    }
                })
            }
        }) */
        // click prestation
/*         $('#prestation_id').click(function (e) {

            if($("#devis_id").val()!==null){
                $('#modalContent').html("Vous ne pouvez pas modifier la Prestation");
                $("#exampleModal").modal('show');
                $('#prestation_id').val(null).change();
                $('#entreprise_id').val(null).change();
                $('#devis_id').val(null).change();
                $('#total').val(null).change();
            }

            if( ($("#entreprise_id").val()=="" ) || ($("#entreprise_id").val()==null) ){

                $('#modalContent').html("Veuillez choisir une entreprise !");
                $("#exampleModal").modal('show');
                $('#prestation_id').val(null).change();
            }else{
                var entreprise_id = $("#entreprise_id").val();
                var prestation_id =  $('#prestation_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('devis.calculPrix') }}",
                    method:"POST",
                    data:{entreprise_id:entreprise_id, prestation_id:prestation_id,_token:_token },
                    success:function(result){
                        $('#total').val(result);
                        $('#row_sub_total').val(result);
                        }
                    })
                }
        }); */
        //change devis
/*         $('#devis_id').change(function (e) {

            var devis_id = $('#devis_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "{{route('mission.devisContent')}}",
                data: {devis_id:devis_id,_token:_token },
                success: function (response) {
                    $('#total').val(response.total);
                    $('#prestation_id').val(response.prestation_id);
                    $('#entreprise_id').val(response.entreprise_id);
                    }
                });
        }); */


        jQuery.datetimepicker.setLocale('fr');
        $('#start').datetimepicker({format:"d-m-Y H:i:s"});
        $('#end').datetimepicker({format:"d-m-Y H:i:s"});


    })
    //end ready

</script>
<script src="{{asset('/js/jquery.datetimepicker.full.min.js')}}"></script>
<script src="{{asset('/js/jquery.min.js')}}"></script>
@endsection
