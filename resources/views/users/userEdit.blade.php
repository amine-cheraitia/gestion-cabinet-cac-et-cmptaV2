@extends('main')
@section('title')
Modification de l'Utilisateur
@endsection
@section('style')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<style>
    footer {
        position: absolute;
        bottom: 0px;
    }
</style>
@endsection
@section('content')

<h2 class="my-4 text-center">{{-- Liste des Entreprises --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / <a
            class="text-dark" href="{{route('users.list')}}">Liste des
            Utilisateurs</a> / Modification de l'Utilisateur</li>
</ol>


<div class="row justify-content-center mt-2 mb-5">
    <div class="col-10">
        <div class="card shadow">
            <div class="card-header">
                <i class="fa fa-user" aria-hidden="true"></i> <strong>Modification de
                    l'Utilisateur</strong>
            </div>

            <div class="card-body">
                <form action="{{route('users.update',$user->id)}}" method="post" class="row g-3 needs-validation ">
                    @csrf
                    @method('PATCH')
                    <div class="row">

                        <div class="col-md-12 my-2">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control shadow  @error('name')is-invalid
                            @enderror" id="name" value="{{ old('name') ?? $user->name}}" required name="name">

                            @error('name')
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 my-2">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control shadow  @error('prenom')is-invalid
                            @enderror" id="prenom" value="{{ old('prenom') ?? $user->prenom}}" required name="prenom">

                            @error('prenom')
                            <div class="invalid-feedback">{{$errors->first('prenom')}}</div>
                            @enderror
                        </div>


                        {{-- <div class="col-md-12 my-2">
                            <label for="email" class="form-label">Nom</label>
                            <input type="email" class="form-control shadow  @error('email')is-invalid
                            @enderror" id="email" value="{{ old('email') ?? $user->email}}" required name="email">

                            @error('email')
                            <div class="invalid-feedback">{{$errors->first('email')}}</div>
                            @enderror
                        </div> --}}

                        <div class="col-md-12 my-2">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control shadow  @error('email')is-invalid
                            @enderror" id="email" value="{{ old('email') ?? $user->email}}" required name="email">

                            @error('email')
                            <div class="invalid-feedback">{{$errors->first('email')}}</div>
                            @enderror
                        </div>

                        <div class="col-md-12  my-2">
                            <label for="role_id" class="form-label">Role de l'utilisateur</label>
                            <select class="form-select shadow @error('role_id')is-invalid
                                @enderror" id="role_id" required name="role_id">
                                <option selected disabled value="">...</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}" {{($role->id == $user->role_id)? "selected" :
                                    ""}}>{{$role->role}}</option>
                                @endforeach

                            </select>
                            @error('role_id')
                            <div class="invalid-feedback">{{$errors->first('role_id')}}</div>
                            @enderror
                        </div>



                        <div class="col-12 text-center mt-5">
                            <button class="btn btn-dark shadow mb-5 " type="submit">Enregistré</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>



    {{ csrf_field() }}
    <script>
        $(document).ready(function(){


            $("#type_paiement_id").change(function (e) {
                $("#num_piece_c").val('-')

            });
    $('#facture_id').change(function (e) {

            var facture_id = $("#facture_id").val();
            console.log(facture_id);
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{ route('paiement.fetch') }}",
            method:"POST",
            data:{facture_id:facture_id, _token:_token },
            success:function(result)
                {
                console.log(result);

                $('#montant').val(result);

                }

            })

    })


});
    </script>

    @endsection
