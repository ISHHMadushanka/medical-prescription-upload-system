@extends('layouts.app')

@section('content')
    <h1>Add Quotation for Prescription #{{ $prescription->id }}</h1>

    <form action="{{ route('quotations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="note">Note:</label>
            <textarea name="note" id="note" class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Quotation</button>
    </form>
@endsection
