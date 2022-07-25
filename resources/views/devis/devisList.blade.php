@extends('main')
@section('title')
    Liste des Devis
@endsection
@section('style')
    <style>
        .dataTable-pagination li.active a {
            background-color: #212529 !important;
            border-color: #212529 !important;
            color: #fff !important;
        }

        .dataTable-pagination-list li a {
            color: #212529 !important
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
</script>
</script> --}}
@endsection
@section('content')
    <h2 class="my-4 text-center">{{-- Liste des Entreprises --}}</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a class="text-dark" href="{{ route('/') }}">Tableau de bord</a> / Liste des
            Devis</li>
    </ol>
    @if (session('errors'))
        <div class="col-lg-12">
            <div class="alert alert-danger" role="alert">{{ session('errors') }}</div>
        </div>
    @endif
    @if (session('message'))
        <div class="col-lg-12">
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        </div>
    @endif

    <div class="card mb-4 shadow">

        <div class="card-header d-flex justify-content-between align-items-center">
            <div class=""><i class="fas fa-file-alt"></i>
                <strong>Liste des Devis</strong>
            </div>
            {{-- //todo: boutton d'ajout --}}
            <div class="d-flex justify-content-center align-items-center">
                <span style="line-height: 50%;" class="mr-2">Exercice</span>
                <form id="formExercice" action="{{-- {{route('devis.store')}} --}}" method="get" class="mr-2">
                    <select id="selectExercice" class="form-control form-select shadow" style="width: 100px">
                        <option>...</option>
                        @foreach ($exercices as $exercice)
                            <option id="{{ $exercice->id }}" value="{{ $exercice->id }}"
                                {{ $exercice->id == request()->id ? 'selected' : '' }}>
                                {{ $exercice->id }}</option>
                        @endforeach
                    </select>
                </form>

                <a href="{{ route('devis.create') }}" class="btn btn-dark">Crée un Devis</a>
            </div>


        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° de Devis</th>
                        <th>Raison social</th>
                        <th>Date de Devis</th>
                        <th>Montal total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>N° de Devis</th>
                        <th>Raison social</th>
                        <th>Date de Devis</th>
                        <th>Montal total</th>
                        <th>action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($devis as $d)
                        <tr>
                            <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                            <td><strong><a href="{{ route('devis.edit', $d->id) }}" class="link-dark"
                                        style="text-underline-position: none">{{ $d->num_devis }}</a></strong></td>
                            <td>{{ $d->entreprise->raison_social }}</td>
                            <td>{{ Carbon\Carbon::parse($d->date_devis)->format('d-m-Y') }}</td>
                            <td>{{ number_format($d->total, 2, ',', ' ') }} DA</td>

                            {{-- <td>{{$entreprise->num_registre_commerce}}</td>
                    <td>{{$entreprise->num_id_fiscale}}</td>
                    <td>{{$entreprise->num_art_imposition}}</td> --}}

                            <td class="d-flex justify-content-center">
                                <a target="_blank" href="{{ route('devis.pdf', $d->id) }}"
                                    class="btn btn-outline-primary  rounded-circle"><i {{-- style="font-size: 15px;" --}}
                                        class="fas fa-print"></i></a>&nbsp;
                                <a href="{{ route('devis.edit', $d->id) }}"
                                    class="btn btn-outline-secondary  rounded-circle">
                                    <i class="fas fa-minus"></i></a> &nbsp;
                                <a id="{{ $d->id }}" class="btn btn-outline-danger  rounded-circle dlt"><i
                                        {{-- style="font-size: 20px" --}} class="fas fa-times"></i></a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Suppression de Devis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <p>Etes vous sur de vouloir Supprimer ce Devis ?</p>
                </div>
                <div class="modal-footer">
                    <a id="confirm" href="" class="btn btn-dark">Oui</a>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $(".dlt").click(function(e) {
                e.preventDefault();
                var url = "{{ url('devis/') }}"
                var id = $(this).attr('id');
                $("#confirm").attr('href', url + '/' + id + '/delete')
                $('#editModal').modal('show')

            });

            $("#datatablesSimple").bind("DOMSubtreeModified", function() {
                $(".dlt").click(function(e) {
                    e.preventDefault();
                    let url = "{{ url('devis/') }}"
                    console.log($(this));
                    let id = $(this).attr('id');
                    $("#confirm").attr('href', url + '/' + id + '/delete')
                    $('#editModal').modal('show')

                });
            });

            /*  */
            $('#selectExercice').change(function(e) {
                e.preventDefault();
                let url = "{{ url('devis/ex/') }}"
                let id = $(this).val();

                $('#formExercice').attr('action', url + '/' + id);
                $('#formExercice').submit();
            });

        })
    </script>
@endsection
