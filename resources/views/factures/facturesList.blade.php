@extends('main')
@section('title')
    Liste des Factures
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
@endsection
@section('content')
    {{-- <h2 class="my-4 text-center">Liste des Factures</h2> --}}
    <h2 class="my-4 text-center">{{-- Liste des tâches --}}</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a class="text-dark" href="{{ route('/') }}">Tableau de bord</a> / Liste des
            Factures
        </li>
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
            <div><i class="fas fa-file-alt"></i><strong>
                    Liste des Factures</strong></div>
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
                <a href="" id="cree" class="btn btn-dark ">Crée une Facture</a>
            </div>

        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° de Facture</th>
                        <th>Raison social</th>
                        <th>Mission Réf</th>
                        <th>Date de Facture</th>
                        <th>Facture Réf</th>
                        <th>Montant</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>N° de Facture</th>
                        <th>Raison social</th>
                        <th>Mission Réf</th>
                        <th>Date de Facture</th>
                        <th>Facture Réf</th>
                        <th>Montant</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($factures as $facture)
                        <tr>
                            <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                            <td><strong><a href="{{ route('facture.edit', $facture->id) }}" class="link-dark"
                                        style="text-underline-position: none">{{ $facture->num_fact }}</a></strong></td>
                            <td>{{ $facture->mission->entreprise->raison_social }}</td>
                            <td>{{ $facture->mission->title }}</td>
                            <td>{{ Carbon\Carbon::parse($facture->date_facturation)->format('d-m-Y') }}</td>
                            <td class="text-center">{{ $facture->fact_avoir_id ? $facture->factureAvoir->num_fact : '-' }}
                            </td>
                            <td>{{ number_format($facture->montant, 2, ',', ' ') }} DA</td>
                            <td class="d-flex">
                                <a target="_blank" href="{{ route('facture.pdf', $facture->id) }}"
                                    class="btn btn-outline-primary"><i style="font-size: 15px;"
                                        class="fas fa-print"></i></a>&nbsp;
                                <a href="{{ route('facture.edit', $facture->id) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-minus"></i></a> &nbsp;
                                <a id="{{ $facture->id }}" class="btn btn-outline-danger dlt"><i style="font-size: 20px"
                                        class="fas fa-times"></i></a>

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
                    <h5 class="modal-title" id="editModalLabel">Type de Facture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <p>Quel type de Facture vous voulez crée ?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('facture.create') }}" class="btn btn-dark">Facture régulière</a>
                    <a href="{{ route('facture.createAvoir') }}" class="btn btn-dark">Facture d'Avoir</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="editModalD" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Suppression de Facture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <p>Etes vous sur de vouloir Supprimer cette facture ?</p>
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
                var url = "{{ url('factures/') }}"
                var id = $(this).attr('id');
                $("#confirm").attr('href', url + '/' + id + '/delete')
                $('#editModalD').modal('show')

            });

            $("#datatablesSimple").bind("DOMSubtreeModified", function() {
                $(".dlt").click(function(e) {
                    e.preventDefault();
                    var url = "{{ url('factures/') }}"
                    var id = $(this).attr('id');
                    $("#confirm").attr('href', url + '/' + id + '/delete')
                    $('#editModalD').modal('show')

                });
            });

            /*  */
            $('#selectExercice').change(function(e) {
                e.preventDefault();
                let url = "{{ url('factures/ex/') }}"
                let id = $(this).val();

                $('#formExercice').attr('action', url + '/' + id);
                $('#formExercice').submit();
            });

        })

        $('#cree').click(function(e) {
            e.preventDefault();

            $('#editModal').modal('show')
        });
    </script>
@endsection
