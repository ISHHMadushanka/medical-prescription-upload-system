@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Accept/Reject Quotation</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('quotations.acceptReject', ['id' => $quotation->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label for="status">Select Status:</label>
                                <select name="status" class="form-control">
                                    <option value="accepted">Accept</option>
                                    <option value="rejected">Reject</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
