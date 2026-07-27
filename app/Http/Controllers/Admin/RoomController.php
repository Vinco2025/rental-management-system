<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType')->latest()->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_number'  => 'required|unique:rooms|max:50',
            'floor'        => 'required|integer|min:1',
            'room_type_id' => 'required|exists:room_types,id',
            'monthly_rate' => 'required|numeric|min:0',
            'max_occupants'=> 'required|integer|min:1',
            'status'       => 'required|in:vacant,occupied,under_maintenance,reserved',
            'amenities'    => 'nullable|array',
            'notes'        => 'nullable|string',
        ]);

        $data['amenities'] = json_encode($request->input('amenities', []));

        Room::create($request->all());
        return redirect()->route('admin.rooms.index')
                        ->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'room_number'  => 'required|max:50|unique:rooms,room_number,' . $room->id,
            'floor'        => 'required|integer|min:1',
            'room_type_id' => 'required|exists:room_types,id',
            'monthly_rate' => 'required|numeric|min:0',
            'max_occupants'=> 'required|integer|min:1',
            'status'       => 'required|in:vacant,occupied,under_maintenance,reserved',
            'amenities'    => 'nullable|array',
            'notes'        => 'nullable|string',
        ]);

        $data['amenities'] = json_encode($request->input('amenities', []));

        $room->update($request->all());
        return redirect()->route('admin.rooms.index')
                        ->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')
                        ->with('success', 'Room deleted.');
    }
}