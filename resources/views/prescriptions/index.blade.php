@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Prescriptions</h1>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Note</th>
                <th>Delivery Address</th>
                <th>Delivery Time</th>
                <th>Images</th>
            </tr>
        </thead>
        <tbody>
            {{-- @if ($prescriptions->images) --}}
            @foreach($prescriptions as $prescription)
                <tr>
                    {{-- <td>{{ $prescription->id }}</td> --}}
                    <td>{{ $prescription->user_id }}</td>
                    <td>{{ $prescription->note }}</td>
                    <td>{{ $prescription->delivery_address }}</td>
                    <td>{{ $prescription->delivery_time }}</td>
                    <td>
                        {{-- @foreach(optional($prescription->images)->toArray() ?? [] as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Prescription Image">
                    @endforeach --}}

                    @foreach(json_decode($prescription->images) ?? [] as $image)
                    <img src="{{ asset('/storage/app/public/prescriptions/' . $image) }}" alt="Prescription Image">
                @endforeach
                    </td>
                </tr>
            @endforeach
        {{-- @endif --}}
        </tbody>
    </table>
</div>
@endsection
