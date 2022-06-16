@extends('main')
@section('title')
Planning de Missions
@endsection
@section('style')
{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css"
    integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css"
    integrity="sha512-okE4owXD0kfXzgVXBzCDIiSSlpXn3tJbNodngsTnIYPJWjuYhtJ+qMoc0+WUwLHeOwns0wm57Ka903FqQKM1sA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
</script>

</script> --}}
{{-- css fullcalendar --}}
<link rel="stylesheet" href="{{asset('css/fullcalendar.css')}}">



<link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">

@endsection
@section('content')


<h2 class="my-4 text-center">{{-- Liste des Missions --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / Planning de
        Missions</li>
</ol>
<div class="mb-4">
    <button class="btn btn-dark" id="create" data-toggle="modal" data-target="#exampleModalCenter">Création de
        Mission</button>
</div>
<div id="calendar"></div>

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
{{-- teste modal --}}

<!-- Button trigger modal -->
{{-- <button id="z" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter">
    Planning de mission
</button> --}}

<!-- Modal -->
<div class="modal fade shadow" id="exampleModal2" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Ajouté une mission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- modal planning --}}
                <form class="row g-3 needs-validation p-3" novalidate method="POST"
                    action="{{route('mission.storeViaPlanning')}}">
                    @csrf
                    <div class="col-md-12">
                        <label for="devis_id" class="form-label">Via un Devis</label>
                        <select class="form-select shadow  @error('devis_id')is-invalid
                                @enderror " id="devis_id" required name="devis_id">
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
                        <select class="form-select shadow  @error('entreprise_id')is-invalid
                                @enderror " id="entreprise_id" required name="entreprise_id">
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
                            @enderror " id="prestation_id" required name="prestation_id">
                            <option selected disabled value="">...</option>
                            @foreach ($prestations as $prestation)
                            <option value="{{$prestation->id}}">{{$prestation->designation}}</option>
                            @endforeach
                        </select>
                        @error('prestation_id')
                        <div class="invalid-feedback">{{$errors->first('prestation_id')}}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="total" class="form-label">Montant total de la mission</label>
                        <input type="text" class="form-control shadow @error('total')is-invalid
                            @enderror " id="total" value="{{old('total')}} " required name="total" readonly="readonly">
                        @error('total')
                        <div class="invalid-feedback">{{$errors->first('total')}}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">

                        <label for="start" class="form-label">Date de debut</label>
                        <input class="form-control shadow  @error('start')is-invalid
                        @enderror " id="start" value="{{old('start')}}" required name="start">
                        @error('start')
                        <div class="invalid-feedback">{{$errors->first('start')}}</div>
                        @enderror
                    </div>
                    <input type="hidden" id="eventId" name="id">
                    <div class="col-md-6">
                        <label for="end" class="form-label">Date de fin</label>
                        <input class="form-control shadow @error('end')is-invalid
                            @enderror " id="end" value="{{old('end')}}" required name="end">
                        @error('end')
                        <div class="invalid-feedback">{{$errors->first('end')}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="color" class="form-label">Couleur du fond</label>
                        <input style="height: 38px" type="color" class="form-control shadow @error('color')is-invalid
                        @enderror " id="color" value="{{old('color')}}" required name="color">
                        @error('color')
                        <div class="invalid-feedback">{{$errors->first('color')}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="textColor" class="form-label">Couleur du text</label>
                        <input style="height: 38px" type="color" class="form-control shadow @error('textColor')is-invalid
                        @enderror " id="textColor" value="{{old('num_art_imposition')}} " required name="textColor">
                        @error('textColor')
                        <div class="invalid-feedback">{{$errors->first('textColor')}}</div>
                        @enderror
                    </div>


                    {{-- <div class="col-12 text-center mt-5">
                        <button class="btn btn-dark shadow mb-5 " type="submit">Enregistré</button>
                    </div> --}}

                    {{-- fin --}}
            </div>
            <div class="modal-footer col-12 text-center mt-5">

                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                <button id="sbt" class="btn btn-dark shadow " type="submit">Crée</button>
                <a class="btn btn-outline-danger" href="" id="delete">Supprimer</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('js/fullcalendar.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr-ca.min.js"></script>


<script>
    jQuery(document).ready(function($){

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
        //conversion date
        function convert(str){
        const date = new Date(str);
        //YYYY-MM-DD format
        return  date.toISOString().slice(0, 19).replace('T', ' ');
        //console.log(mysqlDate);
        }



        jQuery.datetimepicker.setLocale('fr');
        $('#start').datetimepicker({format:"Y-m-d H:i:s"});
        $('#end').datetimepicker({format:"Y-m-d H:i:s"});

        //fetch devis/prestation/

        //calendar
        var calendar = $('#calendar').fullCalendar({
                allDay:false,
                allDayDefault: false,
                locale: 'fr-ca',
                selectable:true,
                selectHelper:true,
                //aspectRatio:2,
                height:650,
                showNonCurrentDates:false,
                editable:true,//passer en true pour rendre le dragable possible
                defaultView:'month',
                yearColumns:3,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'year,month,basicWeek,basicDay,agendaWeek',
                },
                events:"{{ route('mission.planning')}}"
                ,
                 eventClick:function(event){
                    $('#devis_id').val(event.devis_id)
                    $('#entreprise_id').val(event.entreprise_id)
                    $('#prestation_id').val(event.prestation_id)
                    $('#total').val(event.total)
                    $('#start').val(convert(event.start))
                    $('#end').val(convert(event.end))
                    $('#color').val(event.color)
                    $('#textColor').val(event.textColor)
                    $('#eventId').val(event.id)
                    $('#delete').show();
                    var url= "{{url('missions/')}}"
                    $('#delete').attr('href',url+'/'+event.id+'/deleteViaPlanning')
                    $('#ModalLabel').html("Modifier la mission"+event.num_missions)
                    $('#sbt').html("Enregistré")
                    $('#exampleModal2').modal('show')
                },
                //select
                select:function(start,end){
/*                     $('#start').val(converet(start));
                    // console.log($('#start').val());
                    $('#end').val(converet(end));
                    $('#title').val('');
                    $('#color').val('')
                    $('#textColor').val('')
                    $('#eventId').val('')
                    $('#delete').hide(); */
                    $('#start').val(convert(start))
                    $('#end').val(convert(end))
                    $('#devis_id').val("")
                    $('#entreprise_id').val("")
                    $('#prestation_id').val("")
                    $('#total').val("")
                    $('#color').val("")
                    $('#textColor').val("")
                    $('#eventId').val("")
                    $('#ModalLabel').html("Ajouté une mission")
                    $('#delete').hide();
                    $('#exampleModal2').modal('show')



                },
                //dayclick
                 dayClick:function(date,event,view){
                    $('#ModalLabel').html("Ajouté une mission")
                    $('#delete').hide();
                    $('#devis_id').val("")
                    $('#entreprise_id').val("")
                    $('#prestation_id').val("")
                    $('#total').val("")
                    $('#start').val("")
                    $('#end').val("")
                    $('#color').val("")
                    $('#textColor').val("")
                    $('#eventId').val("")
                    $('#start').val(convert(date));
                    $('#exampleModal2').modal('show')

                },

                buttonText:{
                    today:    'aujourd\'hui',
                    month:    'mois',
                    week:     'semaine',
                    day:      'jour',
                    year:     'année',

                    }


            })
    })
    //calendart part
    $('#create').click(function (e) {
        $('#ModalLabel').html("Ajouté une mission")
        $('#delete').hide();
        $('#devis_id').val("")
        $('#entreprise_id').val("")
        $('#prestation_id').val("")
        $('#total').val("")
        $('#start').val("")
        $('#end').val("")
        $('#color').val("")
        $('#textColor').val("")
        $('#eventId').val("")
        $('#exampleModal2').modal('show')

    });

    //end ready

</script>
<script src="{{asset('/js/jquery.datetimepicker.full.min.js')}}"></script>
<script src="{{asset('/js/jquery.min.js')}}"></script>
@endsection
