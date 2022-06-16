@extends('main')
@section('title')
Missions
{{$mission->num_missions}}
@endsection
@section('style')

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

<h2 class="my-4 text-center">{{-- Détail de la mission {{$mission->num_missions}} --}}</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a class="text-dark" href="{{route('/')}}">Tableau de bord</a> / <a
            class="text-dark" href="{{route('mission.list')}}">Liste des
            missions</a> / Détail de la mission {{$mission->num_missions}}</li>
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

{{-- @php
Carbon\Carbon::setLocale('fr');
@endphp --}}
<div class="card mb-4 shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <div><i class="fas fa-file-alt"></i> <strong>
                {{$mission->title}}</strong></div>



    </div>
    <div class="card-body p-4">
        <div class="row ">
            <figure>
                <blockquote class="blockquote">
                    <div class=" d-flex justify-content-between row">
                        <div class="col-sm-12 col-md-6 text-left text-sm-center col-xs-text-left">Raison social du
                            Client:
                            <strong>{{$mission->entreprise->raison_social}}</strong>
                        </div>
                        <div class="col-sm-12 col-md-6 text-md-right text-sm-center col-xs-text-left">
                            Prestation:
                            <strong>{{$mission->prestation->designation}}</strong>
                        </div>
                    </div>
                </blockquote>
                <figcaption class="blockquote-footer text-center my-2">
                    Debut de la mission <cite
                        title="Source Title"><strong>{{Carbon\Carbon::parse($mission->start)->isoFormat('LL')}}</strong></cite>
                    , Fin de la mission <cite
                        title="Source Title"><strong>{{Carbon\Carbon::parse($mission->end)->isoFormat('LL')/*
                            ->format('d-M-Y' )*/}}</strong></cite>
                </figcaption>
            </figure>

        </div>
        <hr>
        <div class="row my-3">
            <div class=" d-flex justify-content-between row my-2">
                <div class="col-sm-12 col-md-6 text-left text-sm-center"><strong>Statut:</strong>
                    {!!$mission->status_int!!}
                </div>
                <div class="col-sm-12 col-md-6 text-right text-sm-center col-xs-text-center">
                    <strong>Montant: <i> {{ number_format($mission->total, 2, ',', ' ') }} DA</i></strong>
                </div>
            </div>


        </div>

        <div class="row my-3">
            <div id="btn" class="d-flex flex text-center justify-content-center">

                @if ($mission->mandat)
                <a target="_blank" href="{{route('mandat.pdf',$mission->id)}}" class="btn btn-outline-primary"><i
                        style="font-size: 15px;" class="fas fa-print"></i> Imprimer le Mandat</a>&nbsp;
                @else
                <a href="{{route('mandat.generate',$mission->id)}}" class="btn btn-primary"><i
                        class="fas fa-cogs"></i></i>
                    Générer le
                    Mandat</a> &nbsp;
                @endif

                @if ($mission->convention)

                <a target="_blank" href="{{route('convention.pdf',$mission->id)}}" class="btn btn-outline-dark"><i
                        style="font-size: 15px;" class="fas fa-print"></i> Imprimer la convention </a>
                @else

                <a href="{{route('convention.generate',$mission->id)}}" class="btn btn-dark"><i class="fas fa-cogs"></i>
                    Générer la convention</a>
                @endif

            </div>


        </div>
    </div>
</div>

@endsection
