<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Eager load user and car for admin panel
        $bookings = Booking::with(['user', 'car'])->get()->map(function($b) {
            return [
                'id' => $b->id,
                'user_name' => $b->user->name ?? '',
                'car_name' => $b->car->name ?? '',
                'pickup_date' => $b->pickup_date,
                'return_date' => $b->return_date,
                'total' => $b->total,
                'status' => $b->status,
            ];
        });
        return response()->json($bookings);
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'car']);
        return response()->json($booking);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'total' => 'required|numeric',
            'status' => 'required|string|max:50',
        ]);

        $booking = Booking::create($validated);
        return response()->json($booking, 201);
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'car_id' => 'sometimes|exists:cars,id',
            'pickup_date' => 'sometimes|date',
            'return_date' => 'sometimes|date|after_or_equal:pickup_date',
            'total' => 'sometimes|numeric',
            'status' => 'sometimes|string|max:50',
        ]);

        $booking->update($validated);
        return response()->json($booking);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(null, 204);
    }
}
