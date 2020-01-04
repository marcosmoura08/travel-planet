@extends('index')
@section('title', 'Reservations')
@section('content')
<div class="container mt-5">
    <h2>Your Reservations</h2>
    <table class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th scope="col">Hotel</th>
                <th scope="col">Arrival</th>
                <th scope="col">Departure</th>
                <th scope="col">Type</th>
                <th scope="col">Guests</th>
                <th scope="col">Price</th>
                <th scope="col">Manage</th>
            </tr>
        </thead>
        <tbody>
            @if (count($reservations) > 0)
                @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->room->hotel['name'] }}</td>
                    <td>{{ $reservation->arrival }}</td>
                    <td>{{ $reservation->departure }}</td>
                    <td>{{ $reservation->room['type'] }}</td>
                    <td>{{ $reservation->num_of_guests }}</td>
                    <td>${{ $reservation->room['price'] }}</td>
                    <td>
                        <a href="/dashboard/reservations/{{ $reservation->id }}/edit" class="btn btn-sm btn-success">Edit</a>
                    </td>
                            
                </tr>
                @endforeach
                @else
                <tr class="text-center">
                    <td colspan="7">You have no reservations</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if(!empty(Session::get('success')))
    <div class="alert alert-success"> {{ Session::get('success') }}</div>
    @endif
    @if(!empty(Session::get('error')))
    <div class="alert alert-danger"> {{ Session::get('error') }}</div>
    @endif
</div>
@endsection