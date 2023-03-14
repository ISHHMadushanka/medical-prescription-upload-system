@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My Quotations</div>
                    <div class="card-body">
                        @if($quotations)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Prescription ID</th>
                                        <th>Drug</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotations as $quotation)
                                        <tr>
                                            <td>{{ $quotation->prescription_id }}</td>
                                            <td>{{ $quotation->drug }}</td>
                                            <td>{{ $quotation->quantity }}</td>
                                            <td>{{ $quotation->amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>You have no quotations.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
