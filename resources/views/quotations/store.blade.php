@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            Quotation saved successfully!
        </div>
        <a href="{{ route('prescriptions.show', $prescription->id) }}" class="btn btn-primary">Back to Prescription</a>
    </div>
@endsection
