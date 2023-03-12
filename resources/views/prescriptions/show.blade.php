@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $prescription->note }}</div>
                    <div class="card-body">
                        <h5 class="card-title">Delivery Address: {{ $prescription->delivery_address }}</h5>
                        <p class="card-text">Delivery Time: {{ $prescription->delivery_time }}</p>
                        <hr>
                        <h5 class="card-title">Prescription Images:</h5>
                        <div class="row">
                            @foreach($prescription->images as $image)
                                <div class="col-md-3">
                                    <img src="{{ asset('storage/prescriptions/'.$image) }}" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <a href="{{ route('quotations.create', ['prescription_id' => $prescription_id]) }}">Prepare Quotation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
