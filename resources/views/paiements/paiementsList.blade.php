@extends('main')
@section('title')
Liste des Paiements
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

<h2 class="my-4 text-center">{{-- Liste des tâches --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / Liste des
        Paiements
    </li>
</ol>
@if(session('errors'))
<div class="col-lg-12">
    <div class="alert alert-danger" role="alert">{{ session('errors') }}</div>
</div>
@endif
@if(session('message'))
<div class="col-lg-12">
    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
</div>
@endif

<div class="card mb-4 shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <div><i class="fas fa-file-invoice-dollar"></i><strong>
                Liste des Paiements</strong></div>
        {{-- //todo: boutton d'ajout --}}
        <a href="{{route('paiement.create')}}" id="cree" class="btn btn-dark ">Crée un Paiement</a>

    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Facture Réf</th>
                    <th>Raison social</th>
                    <th>Mission Réf</th>
                    <th>N° piéce</th>
                    <th>Date de paiement</th>
                    <th>Montant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Facture Réf</th>
                    <th>Raison social</th>
                    <th>Mission Réf</th>
                    <th>N° piéce</th>
                    <th>Date de paiement</th>
                    <th>Montant</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($paiements as $paiement)
                <tr>
                    <td class="text-center"><strong>{{$loop->index+1}}</strong></td>
                    <td><strong><a href="{{-- {{route('devis.edit',$facture->id)}} --}}" class="link-dark"
                                style="text-underline-position: none">{{$paiement->facture->num_fact}}</a></strong></td>
                    <td>{{$paiement->facture->mission->entreprise->raison_social}}</td>
                    <td>{{$paiement->facture->mission->num_missions}}</td>
                    <td>{{$paiement->num_piece_c}}</td>
                    <td>{{Carbon\Carbon::parse($paiement->date_paiement)->format('d-m-Y')}}</td>
                    {{-- <td class="text-center">{{ $paiement->fact_avoir_id ? $facture->factureAvoir->num_fact : "-"}}
                    </td> --}}
                    <td>{{ number_format($paiement->montant, 2, ',', ' '); }} DA</td>

                    {{-- <td>{{$entreprise->num_registre_commerce}}</td>
                    <td>{{$entreprise->num_id_fiscale}}</td>
                    <td>{{$entreprise->num_art_imposition}}</td> --}}

                    <td class="d-flex">
                        {{-- <a target="_blank" href="{{-- {{route('facture.pdf',$facture->id)}} " --}} {{--
                            class="btn btn-outline-primary"><i style="font-size: 15px;"
                                class="fas fa-print"></i></a>&nbsp; --}}
                        <a href="{{route('paiement.edit',$paiement->id)}}" class="btn btn-outline-secondary">
                            <i class="fas fa-minus"></i></a> &nbsp;
                        <a id="{{$paiement->id}}" class="btn btn-outline-danger dlt"><i style="font-size: 20px"
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
                <h5 class="modal-title" id="editModalLabel">Suppression de paiement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <p>Etes vous sur de vouloir Supprimer ce paiement ?</p>
            </div>
            <div class="modal-footer">
                <a id="confirm" href="" class="btn btn-dark">Oui</a>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $(".dlt").click(function (e) {
            e.preventDefault();
            var url= "{{url('paiements/')}}"
            var id=$(this).attr('id');
            $("#confirm").attr('href',url+'/'+id+'/delete')
            $('#editModal').modal('show')

        });

        $("#datatablesSimple").bind("DOMSubtreeModified", function() {
            $(".dlt").click(function (e) {
            e.preventDefault();
            var url= "{{url('paiements/')}}"
            var id=$(this).attr('id');
            $("#confirm").attr('href',url+'/'+id+'/delete')
            $('#editModal').modal('show')

            });
        });

        /*  */

    })
</script>
@endsection
