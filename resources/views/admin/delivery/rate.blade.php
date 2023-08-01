@extends('layouts.app')

@section('title') Calificaciones del Repartidor @endsection

@section('icon') mdi-chart-line @endsection


@section('wrapper')
<div class="page-wrapper">
<section class="pull-up">
    <div class="container">
        <div class="row ">
            <div class="col-lg-6">
                <div class="card-body">
                   @if(count($rate_data) > 0)
                       @foreach($rate_data as $rate)
                           <div style="background:#fff;" class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                               <div class="col p-4 d-flex flex-column position-static">
                                   <strong class="d-inline-block mb-2 text-primary">Order ID #{{$rate->id}}</strong>
                                   <h3 class="mb-0">{{$rate->comment_staff}}</h3>
                                   <div class="mb-1 text-muted">{{$rate->created_at}}</div>
                                   <p class="card-text mb-auto">Usuario: {{$rate->user}}</p>
                                   <p class="card-text mb-auto">
                                    Sanitizo el producto: @if($rate->sanit_process == 1) SI @else NO @endif
                                   </p>
                                   <p class="card-text mb-auto">
                                    Llego bien el producto: @if($rate->status_prod == 1) SI @else NO @endif
                                   </p>
                                   <p class="card-text mb-auto">
                                    @if($rate->star == 1)
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    @elseif($rate->star == 2)
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    @elseif($rate->star == 3)
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    @elseif($rate->star == 4)
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star"></span>
                                    @elseif($rate->star == 5)
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                        <span class="fa fa-star" style="color: orange"></span>
                                    @else
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    @endif


                                   </p>
                               </div>
                           </div>
                       @endforeach
                   @else
                       <div style="background:#fff;" class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                           <div class="col p-4 d-flex flex-column position-static">
                               <strong class="d-inline-block mb-2 text-primary">Upps!!</strong>
                                <h3 class="mb-0">No existen Comentarios para este repartidor</h3>
                           </div>
                       </div>
                       <a href="../" class="btn btn-success btn-cta">Volver</a>
                   @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-body">
                    <div style="background:#fff;" class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">Staff ID #{{$data->id}}</strong>
                            <h3 class="mb-0">{{$data->name}}</h3>
                            <div class="mb-1 text-muted">Tel: {{$data->phone}}</div>
                            <p class="card-text mb-auto">RFC: {{$data->rfc}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection

