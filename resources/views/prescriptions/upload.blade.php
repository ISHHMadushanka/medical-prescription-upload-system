@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Prescription</div>

                    <div class="card-body">
                        @if ($errors->any())

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>

                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('prescriptions.index') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div> <br>

                            <div class="form-group">
                                <label for="delivery_address">Delivery Address</label>
                                <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3"></textarea>
                            </div> <br>

                            <div class="form-group">
                                <label for="delivery_time">Delivery Time</label>
                                <select class="form-control" id="delivery_time" name="delivery_time">
                                    <option value="">Select a delivery time</option>
                                    <option value="10:00-12:00">10:00-12:00</option>
                                    <option value="12:00-14:00">12:00-14:00</option>
                                    <option value="14:00-16:00">14:00-16:00</option>
                                    <option value="16:00-18:00">16:00-18:00</option>
                                    <option value="18:00-20:00">18:00-20:00</option>
                                </select>
                                @error('delivery_time')
                                <div class="text-danger">{{ $message }}</div>

                                @enderror
                            </div> <br>

                            <div class="form-group">
                                <label for="images">Images</label>
                                <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                            </div> <br>

                            <button type="submit" class="btn btn-primary">Upload Prescription</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
