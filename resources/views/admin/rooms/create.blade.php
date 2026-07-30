@extends('layouts.admin')

@section('content')
<div style="padding: 32px;">

    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.rooms.index') }}" style="font-size: 12px; color: #C4A08A; text-decoration: none;">← Rooms</a>
        <h1 style="font-size: 20px; font-weight: 500; color: #3D2314; margin-top: 4px;">Add new room</h1>
        <p style="font-size: 13px; color: #7A5542; margin-top: 2px;">Fill in the details below to register a new room.</p>
    </div>

    @if($errors->any())
        <div style="background: #FCEBEB; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #A32D2D; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf

        {{-- Basic info --}}
        <div style="background: #fff; border-radius: 12px; border: 0.5px solid #E8DDD4; margin-bottom: 16px; overflow: hidden;">
            <div style="padding: 14px 20px; border-bottom: 0.5px solid #F5EDE6; background: #FDF8F4;">
                <p style="font-size: 11px; font-weight: 500; color: #7A5542; text-transform: uppercase; letter-spacing: 0.06em;">Basic information</p>
            </div>
            <div style="padding: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">

                <div>
                    <label style="font-size: 12px; color: #7A5542; display: block; margin-bottom: 5px;">Room number <span style="color: #993C1D;">*</span></label>
                    <input type="text" name="room_number" value="{{ old('room_number') }}" placeholder="e.g. 101"
                        style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 8px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box;">
                    @error('room_number') <p style="font-size: 11px; color: #993C1D; margin-top: 4px;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label style="font-size: 12px; color: #7A5542; display: block; margin-bottom: 5px;">Floor <span style="color: #993C1D;">*</span></label>
                    <input type="number" name="floor" value="{{ old('floor') }}" placeholder="e.g. 1" min="1"
                        style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 8px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box;">
                    @error('floor') <p style="font-size: 11px; color: #993C1D; margin-top: 4px;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label style="font-size: 12px; color: #7A5542; display: block; margin-bottom: 5px;">Room type <span style="color: #993C1D;">*</span></label>
                    <select name="room_type_id"
                            style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 8px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box;">
                        <option value="">— Select a type —</option>
                        @foreach($roomTypes as $type)
                            <option value="{{ $type->id }}" {{ old('room_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('room_type_id') <p style="font-size: 11px; color: #993C1D; margin-top: 4px;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label style="font-size: 12px; color: #7A5542; display: block; margin-bottom: 5px;">Monthly rate (₱) <span style="color: #993C1D;">*</span></label>
                    <input type="number" name="monthly_rate" value="{{ old('monthly_rate') }}" placeholder="0.00" min="0" step="0.01"
                        style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 8px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box;">
                    @error('monthly_rate') <p style="font-size: 11px; color: #993C1D; margin-top: 4px;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label style="font-size: 12px; color: #7A5542; display: block; margin-bottom: 5px;">Max occupants <span style="color: #993C1D;">*</span></label>
                    <input type="number" name="max_occupants" value="{{ old('max_occupants') }}" placeholder="e.g. 2" min="1"
                        style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 8px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box;">
                    @error('max_occupants') <p style="font-size: 11px; color: #993C1D; margin-top: 4px;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label style="font-size: 12px; color: #7A5542; display: block; margin-bottom: 5px;">Status <span style="color: #993C1D;">*</span></label>
                    <select name="status"
                            style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 8px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box;">
                        @foreach(['available', 'occupied', 'under_maintenance', 'reserved'] as $s)
                            <option value="{{ $s }}" {{ old('status', 'available') === $s ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $s)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <p style="font-size: 11px; color: #993C1D; margin-top: 4px;">{{ $message }}</p> @enderror
                </div>

            </div>
        </div>

        {{-- Amenities --}}
        <div style="background: #fff; border-radius: 12px; border: 0.5px solid #E8DDD4; margin-bottom: 16px; overflow: hidden;">
            <div style="padding: 14px 20px; border-bottom: 0.5px solid #F5EDE6; background: #FDF8F4;">
                <p style="font-size: 11px; font-weight: 500; color: #7A5542; text-transform: uppercase; letter-spacing: 0.06em;">Amenities</p>
            </div>
            <div style="padding: 20px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                @php
                    $amenityList = ['Air Conditioning', 'Private Bathroom', 'Wi-Fi', 'Cable TV', 'Ref / Mini Fridge', 'Wardrobe', 'Study Desk', 'Water Heater', 'Balcony', 'Kitchen Access', 'Washing Machine Access', 'CCTV'];
                    $oldAmenities = old('amenities', []);
                @endphp
                @foreach($amenityList as $amenity)
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="amenities[]" value="{{ $amenity }}"
                            {{ in_array($amenity, $oldAmenities) ? 'checked' : '' }}
                            style="accent-color: #C2622A; width: 14px; height: 14px;">
                        <span style="font-size: 13px; color: #3D2314;">{{ $amenity }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Notes --}}
        <div style="background: #fff; border-radius: 12px; border: 0.5px solid #E8DDD4; margin-bottom: 24px; overflow: hidden;">
            <div style="padding: 14px 20px; border-bottom: 0.5px solid #F5EDE6; background: #FDF8F4;">
                <p style="font-size: 11px; font-weight: 500; color: #7A5542; text-transform: uppercase; letter-spacing: 0.06em;">Additional notes</p>
            </div>
            <div style="padding: 20px;">
                <textarea name="notes" rows="4" placeholder="Any special notes about this room (optional)..."
                        style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 10px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box; resize: none;">{{ old('notes') }}</textarea>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px;">
            <a href="{{ route('admin.rooms.index') }}"
            style="font-size: 13px; color: #7A5542; text-decoration: none;">Cancel</a>
            <button type="submit"
                    style="background: #C2622A; color: #fff; font-size: 13px; font-weight: 500; padding: 9px 20px; border-radius: 8px; border: none; cursor: pointer;">
                Save room
            </button>
        </div>

    </form>
</div>
@endsection