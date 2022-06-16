@extends('main')
@section('title')
Création de Facture
@endsection
@section('style')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


@endsection
@section('content')
<h2 class="my-4 text-center">{{-- Liste des tâches --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / <a
            class="text-dark" href="{{route('facture.list')}}">Liste des
            Factures</a> / Création de Facture
    </li>
</ol>



<div class="row justify-content-center mt-2">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header">
                <i class="fas fa-file-alt"></i> <strong>Creation de Facture</strong>
            </div>

            <div class="card-body">
                <form action="{{route('facture.store')}}" method="post" class="row g-3 needs-validation ">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 my-2">
                            <label for="mission_id" class="form-label">Mission Réf</label>
                            <select class="form-select shadow @error('mission_id')is-invalid
                                @enderror" id="mission_id" required name="mission_id">
                                <option selected disabled value="">...</option>
                                @foreach ($missions as $mission)
                                <option value="{{$mission->id}}">{{$mission->title}}</option>
                                @endforeach
                            </select>
                            @error('mission_id')
                            <div class="invalid-feedback">{{$errors->first('mission_id')}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="date_facturation" class="form-label">Date de Facturation</label>
                            <input type="date" class="form-control shadow @error('date_facturation')is-invalid
                                @enderror" id="date_facturation" placeholder="Veuillez saisir la date"
                                value="{{old('date_facturation')}}" required name="date_facturation">
                            @error('date_facturation')
                            <div class="invalid-feedback">{{$errors->first('date_facturation')}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6  my-2">
                            <label for="validationCustom099" class="form-label">Exercice</label>
                            <select class="form-select shadow @error('exercice')is-invalid
                                @enderror" id="validationCustom099" required name="exercice_id">
                                <option selected disabled value="">...</option>
                                @foreach ($exercices as $exercice)
                                <option value="{{$exercice->id}}" {{($exercice->id == \Carbon\Carbon::now()->year) ?
                                    'selected' : "" }}>{{$exercice->id}}</option>
                                @endforeach

                            </select>
                            @error('exercice')
                            <div class="invalid-feedback">{{$errors->first('exercice')}}</div>
                            @enderror
                        </div>

                    </div>


                    <div class="table-responsive">
                        <table class="table" id="invoice_details">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th colspan="4">Désignation</th>
                                    {{-- <th>{{ __('Frontend/frontend.unit') }}</th>
                                    <th>{{ __('Frontend/frontend.quantity') }}</th> --}}
                                    {{-- <th>Tarif</th> --}}
                                    <th>Total</th>
                                </tr>
                            </thead>
                            {{-- <tbody> --}}
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="cloning_row" id="0">
                                    <td><strong>#</strong></td>
                                    <td colspan="4">
                                        <input type="text" id="prestation" class="form-control shadow"
                                            readonly="readonly">
                                    </td>
                                    <td>
                                        <input type="text" {{-- step="0.01" name="sub_total" --}} id="montant"
                                            name="montant" class="row_sub_total form-control shadow" {{-- readonly --}}>
                                        @error('montant')<span class="help-block text-danger">{{ $message
                                            }}</span>@enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2" class="text-end"><strong>Total a payé</strong></td>
                                    <td><input type="text" id="total" class="sub_total form-control shadow"
                                            readonly="readonly"></td>
                                </tr>

                        </table>
                    </div>

                    <div class="text-center pt-3  my-5">
                        <button type="submit" class="btn btn-dark shadow">Enregistré</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{ csrf_field() }}
<script>
    $(document).ready(function(){
/*         $('#prestation_id').val(null).change();
        $('#entreprise_id').val(null).change();
        if(($("#entreprise_id").val()==null ) || ($("#prestation_id").val()==null)){
            $('#row_sub_total').val("");
            $('#total').val("");
        } */
/*     console.log($('#entreprise_id').val()); */
    $('#mission_id').click(function (e) {

            var mission_id = $("#mission_id").val();

            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{ route('facture.calculPrix') }}",
            method:"POST",
            data:{mission_id:mission_id, _token:_token },
            success:function(result)
                {


                $('#montant').val(result.total);
                $('#total').val(result.total);
                $('#prestation').val(result.designation);
                console.log(result.zyada);

                }

            })

    })
    $('#montant').keyup(function(){
        $('#total').val($('#montant').val());
    })


});
</script>

@endsection
