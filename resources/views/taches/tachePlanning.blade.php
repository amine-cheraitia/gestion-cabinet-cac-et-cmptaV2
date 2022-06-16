@extends('main')
@section('title')
Planning de Tache
@endsection
@section('style')
{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css"
    integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css"
    integrity="sha512-okE4owXD0kfXzgVXBzCDIiSSlpXn3tJbNodngsTnIYPJWjuYhtJ+qMoc0+WUwLHeOwns0wm57Ka903FqQKM1sA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
</script>

</script> --}}
{{-- css fullcalendar --}}
<link rel="stylesheet" href="{{asset('css/fullcalendar.css')}}">



<link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">

@endsection
@section('content')
<h2 class="my-4 text-center">{{-- Liste des tâches --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / Planning des tâches
    </li>
</ol>


@can('admin')
<div class="mb-4">
    <button class="btn btn-dark" id="create" data-toggle="modal" data-target="#exampleModalCenter">Création de
        Tache</button>
</div>
@endcan
<div id="calendar"></div>

{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> --}}
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
                <h5 class="modal-title" id="ModalLabel">Ajouté une tache</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- modal planning --}}
                <form class="row g-3 needs-validation p-3" novalidate method="POST"
                    action="{{route('tache.storeViaPlanning')}}">
                    @csrf
                    <div class="col-md-12">
                        <label for="mission_id" class="form-label">Mission</label>
                        <select class="form-select shadow  @error('mission_id')is-invalid
                                @enderror " id="mission_id" required name="mission_id">
                            <option selected disabled value="{{null}}">...</option>
                            @foreach ($missions as $mission)
                            <option value="{{$mission->id}}">{{$mission->title}}</option>
                            @endforeach
                        </select>
                        @error('entreprise_id')
                        <div class="invalid-feedback">{{$errors->first('entreprise_id')}}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="user_id" class="form-label">Affecter à </label>
                        <select class="form-select shadow  @error('user_id')is-invalid
                                @enderror " id="user_id" required name="user_id">
                            <option selected disabled value="">...</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->role_f}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">{{$errors->first('user_id')}}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="designation" class="form-label">designation</label>
                        <input type="text" class="form-control shadow @error('designation')is-invalid
                            @enderror " id="designation" placeholder="Veuillez décrire la tache"
                            value="{{old('designation')}} " required name="designation">
                        @error('designation')
                        <div class="invalid-feedback">{{$errors->first('designation')}}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="start" class="form-label">Date de debut</label>
                        <input class="form-control shadow  @error('start')is-invalid
                        @enderror " id="start" placeholder="Veuillez choisir une date" value="{{old('start')}}"
                            required name="start">
                        @error('start')
                        <div class="invalid-feedback">{{$errors->first('start')}}</div>
                        @enderror
                    </div>
                    <input type="hidden" id="eventId" name="id">
                    <div class="col-md-6">
                        <label for="end" class="form-label">Date de fin</label>
                        <input class="form-control shadow @error('end')is-invalid
                            @enderror " id="end" placeholder="Veuillez choisir une date" value="{{old('end')}}"
                            required name="end">
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
                events:"{{ route('tache.planning')}}"
                ,
                @can('admin')


                 eventClick:function(event){
                    $('#mission_id').val(event.mission_id)
                    $('#user_id').val(event.user_id)
                    $('#designation').val(event.designation)

                    $('#start').val(convert(event.start))
                    $('#end').val(convert(event.end))
                    $('#color').val(event.color)
                    $('#textColor').val(event.textColor)
                    $('#eventId').val(event.id)
                    $('#delete').show();
                    var url= "{{url('taches/')}}"
                    $('#delete').attr('href',url+'/'+event.id+'/deleteViaPlanning')
                    $('#ModalLabel').html("Modifier la tache"+event.num_tache)
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
                    $('#mission_id').val("")
                    $('#user_id').val("")
                    $('#designation').val("")
                    $('#color').val("")
                    $('#textColor').val("")
                    $('#eventId').val("")
                    $('#ModalLabel').html("Ajouté une tache")
                    $('#delete').hide();
                    $('#exampleModal2').modal('show')



                },
                //dayclick
                 dayClick:function(date,event,view){
                    $('#ModalLabel').html("Ajouté une mission")
                    $('#delete').hide();
                    $('#mission_id').val("")
                    $('#user_id').val("")
                    $('#designation').val("")

                    $('#start').val("")
                    $('#end').val("")
                    $('#color').val("")
                    $('#textColor').val("")
                    $('#eventId').val("")
                    $('#start').val(convert(date));
                    $('#exampleModal2').modal('show')

                },
                @endcan
                buttonText:{
                    today:    'aujourd\'hui',
                    month:    'mois',
                    week:     'semaine',
                    day:      'jour',
                    year:     'année'
                    }


            })

    })
    //calendart part
    $('#create').click(function (e) {
        $('#ModalLabel').html("Ajouté une mission")
        $('#delete').hide();
        $('#mission_id').val("")
        $('#user_id').val("")
        $('#designation').val("")

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
