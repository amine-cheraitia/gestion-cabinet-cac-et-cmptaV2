@extends('main')
@section('title')
Création de Mission
@endsection
@section('style')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">

@endsection
@section('content')
<h2 class="my-4 text-center"></h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / <a
            class="text-dark" href="{{route('mission.list')}}">Liste des
            missions</a> / Création de Mission</li>
</ol>

<div class="card shadow">
    <div class="card-header">
        <h6><i class="fas fa-project-diagram"></i><strong> Création de Mission</strong></h6>
    </div>
    <div class="card-body">


        <form class="row g-3 needs-validation " novalidate method="POST" action="{{route('mission.store')}}">
            @csrf
            <div class="col-md-12">
                <label for="devis_id" class="form-label">Via un Devis</label>
                <select class="form-select shadow @error('devis_id')is-invalid
                    @enderror" id="devis_id" required name="devis_id">
                    <option selected disabled value="{{null}}">...</option>
                    @foreach ($devis as $d)
                    <option value="{{$d->id}}">{{$d->num_devis}}</option>
                    @endforeach
                </select>
                @error('entreprise_id')
                <div class="invalid-feedback">{{$errors->first('entreprise_id')}}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="entreprise_id" class="form-label">Raison Social de l'Entreprise</label>
                <select class="form-select shadow @error('entreprise_id')is-invalid
                    @enderror" id="entreprise_id" required name="entreprise_id">
                    <option selected disabled value="">...</option>
                    @foreach ($entreprises as $entreprise)
                    <option value="{{$entreprise->id}}">{{$entreprise->raison_social}}</option>
                    @endforeach
                </select>
                @error('entreprise_id')
                <div class="invalid-feedback">{{$errors->first('entreprise_id')}}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="prestation_id" class="form-label">Désignation de la prestation</label>
                <select class="form-select shadow @error('prestation_id')is-invalid
                @enderror" id="prestation_id" required name="prestation_id">
                    <option selected disabled value="">...</option>
                    @foreach ($prestations as $prestation)
                    <option value="{{$prestation->id}}">{{$prestation->designation}}</option>
                    @endforeach
                </select>
                @error('prestation_id')
                <div class="invalid-feedback">{{$errors->first('prestation_id')}}</div>
                @enderror
            </div>
            {{-- <td><input type="text" name="total" id="total" class="sub_total form-control shadow"
                    readonly="readonly">
            </td> --}}
            <div class="col-md-12">
                <label for="total" class="form-label">Montant total de la mission</label>
                <input type="text" class="form-control shadow  @error('total')is-invalid
                @enderror" id="total" value="{{old('total')}}" required name="total" readonly="readonly">
                @error('total')
                <div class="invalid-feedback">{{$errors->first('total')}}</div>
                @enderror
            </div>
            {{-- --}}
            <div class="col-md-3">
                <label for="start" class="form-label">Date de debut</label>
                <input class="form-control shadow @error('start')is-invalid
                @enderror" id="start" placeholder="Veuillez saisir la raison social" value="{{old('start')}}" required
                    name="start">
                @error('start')
                <div class="invalid-feedback">{{$errors->first('start')}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="end" class="form-label">Date de fin</label>
                <input class="form-control shadow @error('end')is-invalid
                @enderror" id="end" placeholder="Veuillez saisir la raison social" value="{{old('end')}}" required
                    name="end">
                @error('end')
                <div class="invalid-feedback">{{$errors->first('end')}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="color" class="form-label">Couleur du fond</label>
                <input style="height: 38px" type="color" class="form-control shadow  @error('color')is-invalid
            @enderror" id="color" value="{{old('color')}}" required name="color">
                @error('color')
                <div class="invalid-feedback">{{$errors->first('color')}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="textColor" class="form-label">Couleur du text</label>
                <input style="height: 38px" type="color" class="form-control shadow  @error('textColor')is-invalid
            @enderror" id="textColor" value="{{old('num_art_imposition')}}" required name="textColor">
                @error('textColor')
                <div class="invalid-feedback">{{$errors->first('textColor')}}</div>
                @enderror
            </div>


            <div class="col-12 text-center mt-5">
                <button class="btn btn-dark shadow mb-5 " type="submit">Enregistré</button>
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
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('#prestation_id').val(null).change();
        $('#entreprise_id').val(null).change();
        $('#devis_id').val(null).change();
        $('#total').val(null).change();
        if(($("#entreprise_id").val()==null ) || ($("#prestation_id").val()==null)  ){
            $('#total').val("");
        }
        // click entreprise
        $('#entreprise_id').click(function (e) {

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
        })
        // click prestation
        $('#prestation_id').click(function (e) {

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
        });
        //change devis
        $('#devis_id').change(function (e) {

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
        });



        jQuery.datetimepicker.setLocale('fr');
        $('#start').datetimepicker({format:"d-m-Y H:i:s"});
        $('#end').datetimepicker({format:"d-m-Y H:i:s"});

    })
    //end ready

</script>
<script src="{{asset('/js/jquery.datetimepicker.full.min.js')}}"></script>
<script src="{{asset('/js/jquery.min.js')}}"></script>
@endsection
