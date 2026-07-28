@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-3xl mx-auto px-4 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-3">
                <a href="{{ route('admin.tenants.index') }}" class="hover:text-indigo-600 transition-colors">Tenants</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-600">Add New Tenant</span>
            </nav>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Add New Tenant</h1>
            <p class="text-slate-500 mt-1 text-sm">A login account will be automatically created for this tenant.</p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <p class="text-red-700 font-semibold text-sm mb-2">Please fix the following errors:</p>
                <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.tenants.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Login Account --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Login Account</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Used by the tenant to log in. Password is auto-generated.</p>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Juan Dela Cruz"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('name') border-red-400 bg-red-50 @enderror">
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="e.g. juan@email.com"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('email') border-red-400 bg-red-50 @enderror">
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Basic Info --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Personal Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('first_name') border-red-400 bg-red-50 @enderror">
                        @error('first_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('last_name') border-red-400 bg-red-50 @enderror">
                        @error('last_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Phone <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="e.g. 09171234567"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('phone') border-red-400 bg-red-50 @enderror">
                        @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Birthdate <span class="text-red-500">*</span></label>
                        <input type="date" name="birthdate" value="{{ old('birthdate') }}"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('birthdate') border-red-400 bg-red-50 @enderror">
                        @error('birthdate') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Gender <span class="text-red-500">*</span></label>
                        <select name="gender"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('gender') border-red-400 bg-red-50 @enderror">
                            <option value="">— Select —</option>
                            @foreach (['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $val => $label)
                                <option value="{{ $val }}" {{ old('gender') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('gender') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Move-in Date <span class="text-red-500">*</span></label>
                        <input type="date" name="move_in_date" value="{{ old('move_in_date') }}"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('move_in_date') border-red-400 bg-red-50 @enderror">
                        @error('move_in_date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Permanent Address <span class="text-red-500">*</span></label>
                        <textarea name="address" rows="2" placeholder="Street, Barangay, City, Province"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition resize-none @error('address') border-red-400 bg-red-50 @enderror">{{ old('address') }}</textarea>
                        @error('address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Status <span class="text-red-500">*</span></label>
                        <select name="status"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition">
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Emergency Contact --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Emergency Contact</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Contact Name <span class="text-red-500">*</span></label>
                        <input type="text" name="emergency_name" value="{{ old('emergency_name') }}"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('emergency_name') border-red-400 bg-red-50 @enderror">
                        @error('emergency_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Contact Phone <span class="text-red-500">*</span></label>
                        <input type="text" name="emergency_phone" value="{{ old('emergency_phone') }}"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('emergency_phone') border-red-400 bg-red-50 @enderror">
                        @error('emergency_phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Relationship <span class="text-red-500">*</span></label>
                        <input type="text" name="emergency_relationship" value="{{ old('emergency_relationship') }}" placeholder="e.g. Parent, Sibling, Spouse"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('emergency_relationship') border-red-400 bg-red-50 @enderror">
                        @error('emergency_relationship') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- ID Document --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">ID Document</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">ID Type <span class="text-red-500">*</span></label>
                        <select name="id_type"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('id_type') border-red-400 bg-red-50 @enderror">
                            <option value="">— Select ID Type —</option>
                            @foreach (['National ID', 'Passport', 'Driver\'s License', 'SSS ID', 'PhilHealth ID', 'Voter\'s ID', 'Barangay ID', 'School ID'] as $idType)
                                <option value="{{ $idType }}" {{ old('id_type') === $idType ? 'selected' : '' }}>{{ $idType }}</option>
                            @endforeach
                        </select>
                        @error('id_type') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">ID Number <span class="text-red-500">*</span></label>
                        <input type="text" name="id_number" value="{{ old('id_number') }}"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('id_number') border-red-400 bg-red-50 @enderror">
                        @error('id_number') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Additional Notes</h2>
                </div>
                <div class="p-6">
                    <textarea name="notes" rows="3" placeholder="Optional notes about this tenant..."
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition resize-none">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.tenants.index') }}"
                class="px-5 py-2.5 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 transition shadow-sm">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition shadow-sm">
                    Save Tenant
                </button>
            </div>

        </form>
    </div>
</div>
@endsection