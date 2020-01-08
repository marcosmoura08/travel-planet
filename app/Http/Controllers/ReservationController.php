<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use App\Models\Hotel;
use App\Models\Room;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $user_id = \Auth::user()->id;
      
      $reservations = Reservation::with('room', 'room.hotel')
        ->where('user_id', $user_id)
        ->orderBy('arrival', 'asc')
        ->get();

      return view('dashboard.reservations')->with('reservations', $reservations);
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hotel_id)
    {
      $hotelInfo = Hotel::with('rooms')->get()->find($hotel_id);
      return view('dashboard.reservationCreate', compact('hotelInfo'));
    }

    /**
     * Store a newly created reservation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      $user_id = \Auth::user()->id;

      $request->request->add(['user_id' => $user_id]);

      $validator = $request->validate([
        'num_of_guests' => 'required|numeric|min:1|max:6',
        'arrival'     => 'required',
        'departure'  => 'required'
      ]);

      Reservation::create($request->all());

      return redirect('dashboard/reservations')->with('success', 'Reservation created!');
    }

    /**
     * Display the specified reservation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
      $reservation = Reservation::with('room', 'room.hotel')->get()->find($reservation->id);
      $hotel_id = $reservation->room->hotel_id;
      $hotelInfo = Hotel::with('rooms')->get()->find($hotel_id);

      return view('dashboard.reservationSingle', compact('reservation', 'hotelInfo'));
    }

    /**
     * Show the form for editing the specified reservation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
      $reservation = Reservation::with('room', 'room.hotel')->get()->find($reservation->id);
      $hotel_id = $reservation->room->hotel_id;
      $hotelInfo = Hotel::with('rooms')->get()->find($hotel_id);

      return view('dashboard.reservationEdit', compact('reservation', 'hotelInfo'));
    }

    /**
     * Update the specified reservation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
      $user_id = \Auth::user()->id;
      $reservation->user_id = $user_id;
      $reservation->num_of_guests = $request->num_of_guests;
      $reservation->arrival = $request->arrival;
      $reservation->departure = $request->departure;
      $reservation->room_id = $request->room_id;

      $validator = $request->validate([
        'num_of_guests' => 'required|numeric|min:1|max:6',
        'arrival'     => 'required',
        'departure'  => 'required'
      ]);
      
      $reservation->save();
      return redirect('dashboard/reservations')->with('success', 'Successfully updated your reservation!');
    }

    /**
     * Remove the specified reservation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
      $reservation = Reservation::find($reservation->id);
      $reservation->delete(); 

      return redirect('dashboard/reservations')->with('success', 'Successfully deleted your reservation!');
    }
}