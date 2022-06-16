@extends('main')
@section('title')
Liste des Créances
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

    .red {
        background: red !important;
        font-weight: bold;
    }

    .orange {
        background: orange !important;
        font-weight: bold;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

@endsection
@section('content')

{{-- <h2 class="my-4 text-center">Liste des Créances</h2> --}}
<h2 class="my-4 text-center">{{-- Liste des tâches --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / Liste des
        Créances
    </li>
</ol>

<div class="card mb-4 shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <div><i class="fas fa-file-invoice-dollar"></i>
            Liste des Créances</div>

        {{-- <a href="{{route('paiement.create')}}" id="cree" class="btn btn-dark ">Crée un Paiement</a> --}}

    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>N° de Facture</th>
                    <th>Raison Social</th>
                    <th>Mission Ref</th>
                    <th>Montant</th>
                    <th>Date de Facturation</th>
                    <th>Retard en jours</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>N° de Facture</th>
                    <th>Raison Social</th>
                    <th>Mission Ref</th>
                    <th>Montant</th>
                    <th>Date de Facturation</th>
                    <th>Retard en jours</th>
                </tr>
            </tfoot>
            <tbody>

                @foreach ($facts as $facts)
                @php
                $diff=Carbon\Carbon::parse($facts->date_facturation)->diffInDays(Carbon\Carbon::now())
                @endphp
                <tr class="">
                    <td class="text-center"><strong>{{$loop->iteration}}</strong></td>
                    <td><strong><a href="{{-- {{route('devis.edit',$facture->id)}} --}}" class="link-dark"
                                style="text-underline-position: none">{{$facts->num_fact}}</a></strong>
                    </td>
                    <td>{{ $facts->mission->entreprise->raison_social }}</td>
                    <td>{{ $facts->mission->num_missions }}</td>
                    <td>{{ number_format($facts->montant, 2, ',', ' '); }} DA</td>
                    <td>{{Carbon\Carbon::parse($facts->date_facturation)->format('d-m-Y')}}</td>
                    <td class="text-center @if($diff>30)
                         red
                         @elseif ($diff>15)
                        orange
                        @endif">{{$diff }}
                        jour(s)

                    </td>

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
