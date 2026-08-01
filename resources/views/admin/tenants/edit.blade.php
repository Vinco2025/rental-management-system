@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-7">
        <nav class="flex items-center gap-2 text-sm text-[#C4A08A] mb-3">
            <a href="{{ route('admin.tenants.index') }}" class="hover:text-[#C2622A] transition-colors">Tenants</a>
            <i class="ti ti-chevron-right text-xs"></i>
            <a href="{{ route('admin.tenants.show', $tenant) }}" class="hover:text-[#C2622A] transition-colors">{{ $tenant->full_name }}</a>
            <i class="ti ti-chevron-right text-xs"></i>
            <span class="text-[#7A5542]">Edit</span>
        </nav>
        <h1 class="text-2xl font-bold text-[#3D2314]">Edit Tenant</h1>
        <p class="text-[#7A5542] text-sm mt-1">Update profile for {{ $tenant->full_name }}.</p>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
            <p class="text-red-700 font-semibold text-sm mb-2"><i class="ti ti-alert-circle mr-1"></i>Please fix the following errors:</p>
            <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tenants.update', $tenant) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Personal Information --}}
        <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
                <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">Personal Information</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">First Name <span class="text-red-500">*</span></label>
                    <input type="text" name="first_name" value="{{ old('first_name', $tenant->first_name) }}"
                        class="{{ $errors->has('first_name') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('first_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" name="last_name" value="{{ old('last_name', $tenant->last_name) }}"
                        class="{{ $errors->has('last_name') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('last_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Phone <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" value="{{ old('phone', $tenant->phone) }}"
                        class="{{ $errors->has('phone') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Birthdate <span class="text-red-500">*</span></label>
                    <input type="date" name="birthdate" value="{{ old('birthdate', $tenant->birthdate->format('Y-m-d')) }}"
                        class="{{ $errors->has('birthdate') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('birthdate') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Gender <span class="text-red-500">*</span></label>
                    <select name="gender" class='w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition'>
                        @foreach (['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $val => $label)
                            <option value="{{ $val }}" {{ old('gender', $tenant->gender) === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Move-in Date <span class="text-red-500">*</span></label>
                    <input type="date" name="move_in_date" value="{{ old('move_in_date', $tenant->move_in_date->format('Y-m-d')) }}"
                        class="{{ $errors->has('move_in_date') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('move_in_date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Permanent Address <span class="text-red-500">*</span></label>
                    <textarea name="address" rows="2"
                        class="{{ $errors->has('address') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }} resize-none">{{ old('address', $tenant->address) }}</textarea>
                    @error('address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Status <span class="text-red-500">*</span></label>
                    <select name="status" class='w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition'>
                        <option value="active" {{ old('status', $tenant->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $tenant->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Emergency Contact --}}
        <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
                <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">Emergency Contact</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Contact Name <span class="text-red-500">*</span></label>
                    <input type="text" name="emergency_name" value="{{ old('emergency_name', $tenant->emergency_name) }}"
                        class="{{ $errors->has('emergency_name') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('emergency_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Contact Phone <span class="text-red-500">*</span></label>
                    <input type="text" name="emergency_phone" value="{{ old('emergency_phone', $tenant->emergency_phone) }}"
                        class="{{ $errors->has('emergency_phone') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('emergency_phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Relationship <span class="text-red-500">*</span></label>
                    <input type="text" name="emergency_relationship" value="{{ old('emergency_relationship', $tenant->emergency_relationship) }}" placeholder="e.g. Parent, Sibling, Spouse"
                        class="{{ $errors->has('emergency_relationship') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('emergency_relationship') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ID Document --}}
        <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
                <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">ID Document</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">ID Type <span class="text-red-500">*</span></label>
                    <select name="id_type" class="{{ $errors->has('id_type') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                        <option value="">— Select ID Type —</option>
                        @foreach (['National ID', 'Passport', "Driver's License", 'SSS ID', 'PhilHealth ID', "Voter's ID", 'Barangay ID', 'School ID'] as $idType)
                            <option value="{{ $idType }}" {{ old('id_type', $tenant->id_type) === $idType ? 'selected' : '' }}>{{ $idType }}</option>
                        @endforeach
                    </select>
                    @error('id_type') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">ID Number <span class="text-red-500">*</span></label>
                    <input type="text" name="id_number" value="{{ old('id_number', $tenant->id_number) }}"
                        class="{{ $errors->has('id_number') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:outline-none transition' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('id_number') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Notes --}}
        <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
                <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">Additional Notes</h2>
            </div>
            <div class="p-6">
                <textarea name="notes" rows="3"
                    class='w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition resize-none'>{{ old('notes', $tenant->notes) }}</textarea>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between pt-1">
            {{-- Delete (outside edit form) --}}
        </div>

    </form>

    {{-- Delete form outside edit form --}}
    <div class="flex items-center justify-between mt-0">
        <form action="{{ route('admin.tenants.destroy', $tenant) }}" method="POST"
            onsubmit="return confirm('Delete {{ $tenant->full_name }}? This will also delete their login account.')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-5 py-2.5 rounded-xl text-sm font-medium text-red-600 bg-white border border-red-200 hover:bg-red-50 transition-colors">
                <i class="ti ti-trash mr-1"></i>Delete Tenant
            </button>
        </form>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.tenants.show', $tenant) }}"
            class="px-5 py-2.5 rounded-xl text-sm font-medium text-[#7A5542] bg-white border border-[#E8DDD4] hover:bg-[#FDF8F4] transition-colors">
                Cancel
            </a>
            <button form="{{ 'tenant-edit-form' }}" type="submit"
                    onclick="document.querySelector('form[action*=\'tenants\'][method=\'POST\']:not([onsubmit])').submit()"
                    class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white bg-[#C2622A] hover:bg-[#A8521F] transition-colors shadow-sm">
                Save Changes
            </button>
        </div>
    </div>

</div>
@endsection