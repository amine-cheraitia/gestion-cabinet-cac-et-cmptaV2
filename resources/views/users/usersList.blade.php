@extends('main')
@section('title')
Liste des Utilisateurs
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
<h2 class="my-4 text-center"></h2>
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

<h2 class="my-4 text-center">{{-- Liste des Entreprises --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / Liste des
        Utilisateurs</li>
</ol>
<div class="card mb-4 shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div><i class="fas fa-users"></i>
            <strong>Liste des Utilisateurs</strong>
        </div>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nom et prénom</th>
                    <th>Prénom</th>
                    <th>Adresse Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="text-center"><strong>{{$loop->iteration}}</strong></td>
                    <td><strong><a href="{{-- {{route('devis.edit',$facture->id)}} --}}" class="link-dark"
                                style="text-underline-position: none">{{$user->fullname}}</a></strong></td>
                    <td>{{$user->prenom}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role_title}}</td>

                    <td class="d-flex">

                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-outline-secondary">
                            <i class="fas fa-minus"></i></a> &nbsp;
                        <a id="{{$user->id}}" class="btn btn-outline-danger dlt"><i style="font-size: 20px"
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
                <h5 class="modal-title" id="editModalLabel">Suppression de l'utilisateurs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <p>Etes vous sur de vouloir Supprimer cet utilisateur ?</p>
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
            var url= "{{url('users/')}}"
            var id=$(this).attr('id');
            $("#confirm").attr('href',url+'/'+id+'/delete')
            $('#editModal').modal('show')

        });

        $("#datatablesSimple").bind("DOMSubtreeModified", function() {
            $(".dlt").click(function (e) {
            e.preventDefault();
            var url= "{{url('users/')}}"
            var id=$(this).attr('id');
            $("#confirm").attr('href',url+'/'+id+'/delete')
            $('#editModal').modal('show')

            });
        });

        /*  */

    })
</script>


@endsection
