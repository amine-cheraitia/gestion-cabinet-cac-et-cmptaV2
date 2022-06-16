@extends('main')
@section('title')
Planning des Paiements et Facturation
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

    .rouge {
        background: rgb(167, 112, 112) !important;
    }

    .fa-check {
        color: green;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

@endsection
@section('content')
<h2 class="my-4 text-center">Planning des Paiements et Facturation</h2>
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
        <div><i class="fas fa-file-invoice-dollar"></i>
            Planning des Paiements et Facturation</div>
        {{-- //todo: boutton d'ajout --}}
        <a href="{{route('paiement.create')}}" id="cree" class="btn btn-dark ">Crée un Paiement</a>

    </div>
    <div class="card-body text-center">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    {{-- <th>#</th> --}}
                    <th>Mission Réf</th>
                    {{-- <th>Nbr Facture</th> --}}
                    <th>Total payée</th>
                    <th>Total mission</th>

                    <th>différence</th>

                    <th>Date première tr</th>
                    <th>Première tr</th>
                    <th>Date Deuxieme tr</th>
                    <th>Deuxième tr</th>
                    <th>Date Troisième tr</th>
                    <th>Troisième tr</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    {{-- <th>#</th> --}}
                    <th>Mission Réf</th>
                    {{-- <th>Nbr Facture</th> --}}
                    <th>Total payée</th>
                    <th>Total mission</th>
                    <th>différence</th>
                    <th>date premiére tranche</th>
                    <th>Montant première tranche</th>
                    <th>date prévu pour deuxieme tranche</th>
                    <th>Montant deuxième tranche</th>
                    <th>date prévu pour troisième tranche</th>
                    <th>Montant troisième tranche</th>
                </tr>
            </tfoot>
            <tbody>

                @foreach ($planningPaiements as $paiement)
                <tr class="">
                    {{-- <td class="text-center"><strong>{{$loop->iteration}}</strong></td> --}}
                    <td><strong><a href="{{-- {{route('devis.edit',$facture->id)}} --}}" class="link-dark"
                                style="text-underline-position: none">{{$paiement->num_missions}}</a></strong></td>
                    {{-- <td>{{$creance->nbr}}</td> --}}
                    <td>{{ number_format($paiement->totalfacture, 2, ',', ' '); }}</td>
                    <td>{{ number_format($paiement->totalmission, 2, ',', ' '); }}</td>
                    <td>{{$paiement->nbr." ". number_format($paiement->dif, 2, ',', ' '); }}</td>
                    @if(($paiement->nbr == 0) AND ($paiement->start<Carbon\Carbon::now())) <td
                        class="rouge font-weight-bold">
                        {{Carbon\Carbon::parse($paiement->start)->format('d-m-Y')}} <i class="fas fa-presentation "></i>
                        </td>
                        <td class="rouge">{{number_format($paiement->ApayePremiereTranche, 2, ',',' '); }}</td>
                        @else
                        <td>
                            {{Carbon\Carbon::parse($paiement->start)->format('d-m-Y')}} <i class="fas fa-check"></i>
                        </td>
                        <td>{{number_format($paiement->ApayePremiereTranche, 2, ',',' '); }}</td>
                        @endif
                        {{-- <td @if($paiement->nbr == 0) class="rouge" @endif>{{
                            number_format($paiement->ApayePremiereTranche, 2, ',',
                            ' '); }}</td> --}}
                        @if( ($paiement->nbr < 2) AND ($paiement->deuxiemeTranche<Carbon\Carbon::now())) <td
                                class="rouge font-weight-bold">
                                {{Carbon\Carbon::parse($paiement->deuxiemeTranche)->format('d-m-Y')}} <i
                                    class="fas fa-presentation "></i></td>
                                <td class="rouge">{{
                                    number_format($paiement->ApayeDeuxiemeTranche,
                                    2,
                                    ',', ' '); }}</td>
                                @else
                                <td>
                                    {{Carbon\Carbon::parse($paiement->deuxiemeTranche)->format('d-m-Y')}} <i
                                        class="fas fa-check"></i></td>
                                <td>{{
                                    number_format($paiement->ApayeDeuxiemeTranche,
                                    2,
                                    ',', ' '); }}</td>
                                @endif
                                {{-- --}}
                                @if( ($paiement->nbr <=2) AND ($paiement->derniéreTranche<Carbon\Carbon::now())) <td
                                        class="rouge font-weight-bold">
                                        {{Carbon\Carbon::parse($paiement->derniéreTranche)->format('d-m-Y')}} <i
                                            class="fas fa-presentation "></i></td>
                                        <td class="rouge">{{
                                            number_format($paiement->ApayeDerniereTranche,
                                            2,
                                            ',', ' '); }}</td>
                                        @else
                                        <td>
                                            {{Carbon\Carbon::parse($paiement->derniéreTranche)->format('d-m-Y')}} <i
                                                class="fas fa-check"></i></td>
                                        <td>{{
                                            number_format($paiement->ApayeDerniereTranche,
                                            2,
                                            ',', ' '); }}</td>
                                        @endif
                                        {{-- <td @if($paiement->nbr < 2) class="rouge" @endif>{{
                                                number_format($paiement->ApayeDeuxiemeTranche,
                                                2,
                                                ',', ' '); }}</td> --}}

                                        {{-- <td class="text-center">{{ $paiement->fact_avoir_id ?
                                            $facture->factureAvoir->num_fact
                                            :
                                            "-"}}
                                        </td> --}}
                                        {{-- <td>{{ number_format($paiement->montant, 2, ',', ' '); }} DA</td> --}}

                                        {{-- <td>{{$entreprise->num_registre_commerce}}</td>
                                        <td>{{$entreprise->num_id_fiscale}}</td>
                                        <td>{{$entreprise->num_art_imposition}}</td> --}}


                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>



<script>
    /*     $('#cree').click(function (e) {
         e.preventDefault();

        $('#editModal').modal('show')
    }); */
</script>
@endsection