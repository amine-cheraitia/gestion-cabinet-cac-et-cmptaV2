@extends('main')
@section('content')
<style>
    /*     div {
        color: #e7bd31;
    } */
</style>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tableau de bord</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tableau de bord</li>
    </ol>

    <div class="row">
        <div class="col-xl-4 col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <i style="font-size: 35px" class="fas fa-file-invoice"></i>
                    <div>Nombre de créance En cours <br>
                        <div class="text-center fs-8 w-100">{{$facts}}</div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('paiement.creances')}}">Voir plus</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4">
            <div class="card text-dark bg-warning mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    {{-- <i style="font-size: 35px" class="fas fa-file-invoice"></i> --}}
                    <i style="font-size: 35px" class="fas fa-file-invoice-dollar"></i>
                    <div>Facture(s) en retard de paiement <br>
                        <div class="text-center fs-8 w-100">{{$factEnAttentePaiement}}</div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-dark stretched-link" href="{{route('facture.list')}}">Voir plus</a>
                    <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>

        </div>

        <div class="col-xl-4 col-md-4">
            <div class="card text-dark bg-danger mb-4">
                <div class="card-body d-flex justify-content-between align-items-center text-dark">
                    <i style="font-size: 35px" class="fas fa-exclamation-triangle"></i>

                    <div>Facture(s) hors délais<br>
                        <div class="text-center fs-8 w-100">{{$factRetard}}</div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-dark stretched-link " href="{{route('paiement.creances')}}">Voir plus</a>
                    <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
            {{-- --}}
            {{-- <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Warning card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div> --}}
        </div>
        {{--
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Success Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
{{-- <script src="{{asset('assets/charts/chart-bar-Chiffre-dAffaire.js')}}" defer></script>
<script src="{{asset('assets/charts/chart-pie-missions.js')}}" defer></script> --}}
@endsection
