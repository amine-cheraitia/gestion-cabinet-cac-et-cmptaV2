@extends('main')
@section('title')
    Liste des missions
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
@endsection
@section('content')
    <h2 class="my-4 text-center">{{-- Liste des tâches --}}</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a class="text-dark" href="{{ route('/') }}">Tableau de bord</a> / Liste des
            tâches
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
            <div><i class="fas fa-tasks"></i><strong>
                    Liste des tâches</strong></div>
            {{-- //todo: boutton d'ajout --}}
            <a href="{{ route('tache.create') }}" class="btn btn-dark {{-- my-2 --}} ">Crée une tâche</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° de tâche</th>
                        <th>N° de mission</th>
                        <th>Collaborateur</th>
                        <th>Date de debut</th>
                        <th>Date de fin</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>N° de tâche</th>
                        <th>N° de mission</th>
                        <th>Collaborateur</th>
                        <th>Date de debut</th>
                        <th>Date de fin</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($taches as $tache)
                        <tr>
                            <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                            <td><strong><a href="{{ route('tache.show', $tache->id) }}" class="link-dark"
                                        style="text-underline-position: none">{{ $tache->num_tache }}</a></strong></td>
                            <td>{{ $tache->mission->num_missions }}</td>
                            <td>{{ $tache->user->name }}</td>
                            <td>{{ $tache->starte }}</td>
                            <td>{{ $tache->ende }} </td>
                            <td style="text-align: center">
                                {!! $tache->status_int !!}</span>
                            </td>

                            <td class="@can('admin') d-flex @endcan text-center justify-content-center">
                                {{-- TO do consulter les missions aprés le setup des taches --}}
                                <a href="{{ route('tache.show', $tache->id) }}"
                                    class="btn btn-outline-primary  rounded-circle"><i {{-- style="font-size: 15px" --}}
                                        class="fas fa-sign-in-alt"></i></a>
                                @can('admin')
                                    &nbsp;
                                    <a href="{{ route('tache.edit', $tache->id) }}"
                                        class="btn btn-outline-secondary  rounded-circle">
                                        <i class="fas fa-minus"></i></a>

                                    &nbsp;
                                    <a id="{{ $tache->id }}" class="btn btn-outline-danger dlt  rounded-circle"><i
                                            {{-- style="font-size: 20px" --}} class="fas fa-times"></i></a>
                                @endcan
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
                    <h5 class="modal-title" id="editModalLabel">Suppression de tâche</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <p>Etes vous sur de vouloir Supprimer cette tâche ?</p>
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
                var url = "{{ url('taches/') }}"
                var id = $(this).attr('id');
                $("#confirm").attr('href', url + '/' + id + '/delete')
                $('#editModal').modal('show')

            });

            $("#datatablesSimple").bind("DOMSubtreeModified", function() {
                $(".dlt").click(function(e) {
                    e.preventDefault();
                    var url = "{{ url('taches/') }}"
                    var id = $(this).attr('id');
                    $("#confirm").attr('href', url + '/' + id + '/delete')
                    $('#editModal').modal('show')

                });
            });

            /*  */

        })
    </script>
@endsection
