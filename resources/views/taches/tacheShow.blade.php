@extends('main')
@section('title')
Tâche
{{$tache->num_tache}}
@endsection
@section('style')
{{--
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>
    .dataTable-pagination li.active a {
        background-color: #212529 !important;
        border-color: #212529 !important;
        color: #fff !important;
    }

    .dataTable-pagination li a {
        color: #212529 !important
    }

    @media (max-width: 576px) {

        .text-right,
        .text-left {
            text-align: center;
        }

        #btn {
            flex-direction: column;
        }
    }
</style>



@endsection
@section('content')


<h2 class="my-4 text-center">{{-- Liste des tâches --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / <a
            class="text-dark" href="{{route('tache.list')}}">Liste des tâches</a> / Détail de la tâche
        {{$tache->num_tache}}
    </li>
</ol>

<div class="card mb-4 shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <div><i class="fa fa-tasks" aria-hidden="true"></i> <strong>{{$tache->title}}</strong>

        </div>
    </div>
    <div class="card-body p-4">
        <div class="row ">
            <figure>
                <blockquote class="blockquote">
                    <div class=" d-flex justify-content-between row">
                        <div class="col-sm-12 col-md-6 text-left text-sm-center">Tache Ref:
                            <strong>{{$tache->title}}</strong>
                        </div>
                        <div class="col-sm-12 col-md-6 text-right text-sm-center col-xs-text-center">
                            Affecté à:
                            <strong>{{$tache->user->role_f}}</strong>
                        </div>
                    </div>
                </blockquote>
                <figcaption class="blockquote-footer text-center my-2">
                    Debut de la mission <cite
                        title="Source Title"><strong>{{Carbon\Carbon::parse($tache->start)->isoFormat('LL')}}</strong></cite>
                    , Fin de la mission <cite
                        title="Source Title"><strong>{{Carbon\Carbon::parse($tache->end)->isoFormat('LL')/*
                            ->format('d-M-Y' )*/}}</strong></cite>
                </figcaption>
            </figure>

        </div>
        <hr>
        <div class="row my-3">
            <div class=" d-flex justify-content-between row my-2">
                <div class="col-sm-12 col-md-6 text-left text-sm-center"><strong>Statut:</strong>
                    {!!$tache->status_int!!}
                </div>
                <div class="col-sm-12 col-md-6 text-right text-sm-center col-xs-text-center">
                    Désignation: <strong><i> {{$tache->designation}}</i></strong>
                </div>
            </div>


        </div>

        <div class="row my-3">
            <div id="btn" class="d-flex flex text-center justify-content-center">

            </div>


        </div>
    </div>

</div>
{{-- edit tache --}}
@can('cmp-adt')


<div class="card shadow my-5 shadow">
    <div class="card-header">
        <h6><i class="fa fa-tasks" aria-hidden="true"></i><strong> Modification du statut de la tâche:
                {{$tache->num_tache}}
            </strong></h6>
    </div>
    <div class="card-body">


        <form class="row g-3 needs-validation " novalidate method="POST"
            action="{{route('tache.updateStatut',$tache->id)}}">
            @csrf
            @method('PATCH')


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
            <div class="col-12 text-center mt-2">
                <button class="btn btn-dark shadow mb-1 " type="submit">Enregistré</button>
            </div>
        </form>
    </div>
</div>
@endcan

{{-- commentaire --}}
@can('cac-adt')


<div class="card mb-4 shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <div><i class="far fa-comment-dots"></i> <strong>Liste des commentaires</strong>

        </div>
    </div>
    <div class="card-body p-4">


        <div class="row">
            <div class="list-group">
                @foreach ($tache->commentaires as $commentaire)

                <div class="list-group-item">
                    <h4><strong>Remarque N° {{$loop->iteration}}</strong></h4>
                    <p id="commentaire">{{$commentaire->description}}</p>
                    <div class="d-flex justify-content-between align-content-center">
                        <small id="user_id">Posté le <strong>{{$commentaire->date_commentaire}}</strong></small>
                        <span class="font-weight-lighter">Posté par
                            {{$commentaire->user->fullname}}</span>
                    </div>
                    <div>
                        <a href="" class="edit text-dark font-weight-bold" id="{{$commentaire->id}}">Modifier</a>
                        <a href="{{route('commentaire.destroy',$commentaire->id)}}"
                            class="font-weight-bold text-dark">Supprimer</a>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="d-flex justify-content-center mt-2">
                {{-- page 1 page 2 --}}
            </div>
        </div>
        <hr>
        <div class="row ">
            <form action="{{route('commentaire.store',$tache->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="comment">Commentaire</label>
                    <textarea class="form-control @error('description') is-invalid  @enderror " id="comment"
                        name="description" rows="3"></textarea>
                    @error('description')
                    <div class="invalid-feedback">{{$errors->first('description')}}</div>
                    @enderror
                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-dark"> Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modification du commentaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form action="{{route('commentaire.update',$tache->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="commentModal">Commentaire</label>
                        <textarea class="form-control @error('description') is-invalid  @enderror " id="commentModal"
                            name="description" rows="3"></textarea>
                        @error('description')
                        <div class="invalid-feedback">{{$errors->first('description')}}</div>
                        @enderror
                    </div>
                    <input type="hidden" id="id" name="id">

                    <div class="text-center">
                        {{-- <button type="submit" class="btn btn-dark"> Ajouter</button> --}}
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">Enregistrer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endcan
<script>
    $('.edit').click(function (e) {
         e.preventDefault();
/*     alert($(this).parent().val()); */
        var commentaire = $(this).parents(".list-group-item").find("#commentaire").text();
        var id = $(this).attr('id')
       /*  console.log(id); */

        $('#commentModal').val(commentaire)
        $('#id').val(id)
        $('#editModal').modal('show')
    });
</script>

@endsection
