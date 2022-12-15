@extends('layouts.app')

@section('template_title')
    {{ $reservation->name ?? 'Show Reservation' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Reservation</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('reservations.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $reservation->name }}
                        </div>
                        <div class="form-group">
                            <strong>Start:</strong>
                            {{ $reservation->start }}
                        </div>
                        <div class="form-group">
                            <strong>Finish:</strong>
                            {{ $reservation->finish }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $reservation->price }}
                        </div>
                        <div class="form-group">
                            <strong>Info:</strong>
                            {{ $reservation->info }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
