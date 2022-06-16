@extends('main')
@section('title')
Liste des clients
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
<h2 class="my-4 text-center">{{-- Liste des Entreprises --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / Liste des
        Entreprises</li>
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
        <div><i class="far fa-address-card"></i>
            <strong>Liste des Entreprises</strong>
        </div>
        {{-- //todo: boutton d'ajout --}}
        <a href="{{route('client.index')}}" class="btn btn-dark {{-- my-2 --}}">Crée une fiche d'entreprise</a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Raison social</th>
                    <th>Adresse</th>
                    <th>N° Tel</th>
                    <th>Email</th>
                    {{-- <th>N° Registre de Commerce</th>
                    <th>N° Identifiant fiscal</th>
                    <th>N° Article d'imposition</th> --}}
                    <th>Régime fiscal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Raison social</th>
                    <th>Adresse</th>
                    <th>N° de télephone</th>
                    <th>Email</th>
                    {{-- <th>N° Registre de Commerce</th>
                    <th>N° Identifiant fiscal</th>
                    <th>N° Article d'imposition</th> --}}
                    <th>Régime fiscal</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($entreprises as $entreprise)
                <tr>
                    <td class="text-center"><strong>{{$loop->iteration}}</strong></td>
                    <td><strong><a href="{{route('client.edit',$entreprise->id)}}" class="link-dark"
                                style="text-underline-position: none">{{$entreprise->raison_social}}</a></strong></td>
                    <td>{{$entreprise->adresse}}</td>
                    <td>{{$entreprise->num_tel}}</td>
                    <td>{{$entreprise->email}}</td>

                    {{-- <td>{{$entreprise->num_registre_commerce}}</td>
                    <td>{{$entreprise->num_id_fiscale}}</td>
                    <td>{{$entreprise->num_art_imposition}}</td> --}}
                    <td>{{$entreprise->RegimeFiscal->designation}}</td>
                    <td class="d-flex"><a href="{{route('client.edit',$entreprise->id)}}"
                            class="btn btn-outline-secondary"> <i class="fas fa-minus"></i></a> &nbsp;
                        {{-- <a href="{{route('client.destroy',$entreprise->id)}}" class="btn btn-outline-danger"><i
                                style="font-size: 20px" class="fas fa-times"></i></a> --}}
                        <a id="{{$entreprise->id}}" class="btn btn-outline-danger dlt"><i style="font-size: 20px"
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
                <h5 class="modal-title" id="editModalLabel">Suppression d'Entreprise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <p>Etes vous sur de vouloir Supprimer cette entreprise ?</p>
            </div>
            <div class="modal-footer">
                <a id="confirm" href="" class="btn btn-dark">Oui</a>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>

        </div>
    </div>
</div>
<script defer>
    $(document).ready(function(){
        $(".dlt").click(function (e) {
            e.preventDefault();
            console.log('click');
            var url= "{{url('clients/')}}"
            var id=$(this).attr('id');
            $("#confirm").attr('href',url+'/'+id+'/delete')
            $('#editModal').modal('show')

        });
        window.addEventListener("DOMContentLoaded", (event) => {
    console.log("DOM entièrement chargé et analysé");
  });

  $("#datatablesSimple").bind("DOMSubtreeModified", function() {
        $(".dlt").click(function (e) {
        e.preventDefault();
        console.log('click');
        var url= "{{url('clients/')}}"
        var id=$(this).attr('id');
        $("#confirm").attr('href',url+'/'+id+'/delete')
        $('#editModal').modal('show')

        });
    });

    })
</script>

@endsection
