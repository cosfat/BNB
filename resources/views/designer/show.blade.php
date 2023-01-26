@extends('layouts.app')

@section('template_title')
    {{ $designer->name ?? 'Show Designer' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Designer</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('designers.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $designer->name }}
                        </div>
                        <div class="form-group">
                            <strong>House Id:</strong>
                            {{ $designer->house_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $designer->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $designer->price }}
                        </div>
                        <div class="form-group">
                            <strong>Taksit:</strong>
                            {{ $designer->taksit }}
                        </div>
                        <div class="form-group">
                            <strong>Kargo:</strong>
                            {{ $designer->kargo }}
                        </div>
                        <div class="form-group">
                            <strong>Verilis:</strong>
                            {{ $designer->verilis }}
                        </div>
                        <div class="form-group">
                            <strong>Teslimat:</strong>
                            {{ $designer->teslimat }}
                        </div>
                        <div class="form-group">
                            <strong>Detay:</strong>
                            {{ $designer->detay }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
