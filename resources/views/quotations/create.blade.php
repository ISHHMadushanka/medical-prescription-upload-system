@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Prepare Quotations:</h2>
        @if ($prescription)
            <p>Prescription ID: {{ $prescription->id }}</p>
            <p>Note: {{ $prescription->note }}</p>
            <p>Delivery Address: {{ $prescription->delivery_address }}</p>
            <p>Delivery Time: {{ $prescription->delivery_time }}</p>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('quotations.store', $prescription->id) }}" method="POST">
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Drug</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(old('drug', ['']) as $key => $value)
                                    <tr>
                                        <td><input type="text" name="drug[]" class="form-control" value="{{ old('drug.' . $key) }}"></td>
                                        <td><input type="text" name="quantity[]" class="form-control" value="{{ old('quantity.' . $key) }}"></td>
                                        <td><input type="text" name="amount[]" class="form-control" value="{{ old('amount.' . $key) }}"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('prescriptions.show', $prescription->id) }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        @else
            <p>Prescription not found.</p>
        @endif
    </div>
@endsection
