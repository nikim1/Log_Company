@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="py-4" style="background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%); min-height: 100vh;">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold mb-1">Табло за управление</h2>
                    </div>
                    <div class="text-muted">
                        <i class="bi bi-calendar3"></i> {{ date('d.m.Y', strtotime(now())) }}
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->hasRole('admin'))
        @include('dashboards.admin')
        @elseif(Auth::user()->hasRole('client'))
        @include('dashboards.client')
        @elseif(Auth::user()->hasRole('courier'))
        @include('dashboards.courier')
        @elseif(Auth::user()->hasRole('office'))
        @include('dashboards.office-worker')
        @else
        <p>Нямате достъп</p>
        @endif
    </div>
</div>
@endsection