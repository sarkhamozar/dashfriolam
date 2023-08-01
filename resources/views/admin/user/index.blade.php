@extends('layouts.app')

@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Clientes</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Listado</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12 mx-auto" style="text-align: right;">
                <a href="{{ Asset($link.'add') }}" >
                    <button type="button" class="btn btn-success px-3 radius-10">Agregar Cliente</button>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table mb-0" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>QR</th>
                                        <th>Nombre</th>
                                        <th>Contacto</th>
                                        <th>Clientes</th>
                                        <th>Servicios realizados</th>
                                        <th>Status</th>
                                        <th style="text-align: right">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                        <tr>
                                            <td width="5%">
                                                <a href="{{ Asset($link.$row->id.'/viewqr') }}">
                                                    <img src="data:image/png;base64,{{ $row->qr_code }}" style="width:50px;height: 50px;max-width:none !important;">
                                                </a> 
                                            </td> 
                                            <td>{{ $row->name }}</td>
                                            <td>
                                                {{$row->email}}
                                                <p>{{ $row->phone }}</p>
                                            </td>
                                            <td>
                                                <?php
                                                    echo count(json_decode($row->subusers));
                                                ?>
                                            </td>
                                            <td>
                                               <span class="btn btn-sm m-b-15 ml-2 mr-2 btn-warning">0</span>
                                            </td>
                                            <td>
                                                @if($row->status == 0)
                                                <button type="button" class="btn btn-sm m-b-15 ml-2 mr-2 btn-info" onclick="confirmAlert('{{ Asset($link.'status/'.$row->id) }}')">Active</button>
                                                @else
                                                <button type="button" class="btn btn-sm m-b-15 ml-2 mr-2 btn-danger" onclick="confirmAlert('{{ Asset($link.'status/'.$row->id) }}')">Disabled</button>
                                                @endif
                                            </td>
                                            <td style="text-align: right">
                                                
                                                <button class="btn btn-primary dropdown-toggle" 
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                
                                                <ul class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px auto auto 0px; transform: translate(0px, 38px);" data-popper-placement="bottom-start">
                                                    <!-- QR -->
                                                    <li>
                                                        <a href="{{ Asset($link.$row->id.'/viewqr') }}" class="dropdown-item">
                                                        ver QR
                                                        </a> 
                                                    </li>
                                                    <!-- QR -->
                                                    <li>
                                                        <a href="{{ Asset($link.$row->id.'/edit') }}" class="dropdown-item">
                                                            Editar
                                                        </a>
                                                    </li>
                                                    <!-- Delete -->
                                                    <li>
                                                        <a href="javascript::void()" class="dropdown-item" onclick="deleteConfirm('{{ Asset($link."delete/".$row->id) }}')">
                                                            Eliminar
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- PAGINACION -->
         <div class="row">
            <div class="col-xl-12 mx-auto" style="text-align: right;">
                {!! $data->links() !!}
            </div>
        </div>
        <!-- PAGINACION -->
    </div>
</div>
@endsection