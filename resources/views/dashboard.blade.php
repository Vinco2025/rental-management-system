<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h2 class="text-[22px] font-bold text-[#3D2314]">{{ __('Dashboard') }}</h2>
                <p class="text-[13px] text-[#7A5542] mt-1">Welcome back to your rental operations overview.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1100px] mx-auto px-5">

            {{-- Stats row --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
                <div class="bg-white border border-[#E8DDD4] rounded-2xl p-[18px] shadow-[0_8px_24px_rgba(61,35,20,0.06)]">
                    <p class="text-[12px] text-[#7A5542] mb-2">Total Rooms</p>
                    <p class="text-[26px] font-bold text-[#3D2314]">128</p>
                </div>
                <div class="bg-white border border-[#E8DDD4] rounded-2xl p-[18px] shadow-[0_8px_24px_rgba(61,35,20,0.06)]">
                    <p class="text-[12px] text-[#7A5542] mb-2">Occupied</p>
                    <p class="text-[26px] font-bold text-[#3D2314]">86</p>
                </div>
                <div class="bg-white border border-[#E8DDD4] rounded-2xl p-[18px] shadow-[0_8px_24px_rgba(61,35,20,0.06)]">
                    <p class="text-[12px] text-[#7A5542] mb-2">Active Tenants</p>
                    <p class="text-[26px] font-bold text-[#3D2314]">74</p>
                </div>
                <div class="bg-white border border-[#E8DDD4] rounded-2xl p-[18px] shadow-[0_8px_24px_rgba(61,35,20,0.06)]">
                    <p class="text-[12px] text-[#7A5542] mb-2">Pending Contracts</p>
                    <p class="text-[26px] font-bold text-[#3D2314]">12</p>
                </div>
            </div>

            {{-- Main grid --}}
            <div class="grid grid-cols-1 md:grid-cols-[1.15fr_0.85fr] gap-4">

                {{-- Today's summary --}}
                <div class="bg-white border border-[#E8DDD4] rounded-[18px] p-[22px] shadow-[0_10px_28px_rgba(61,35,20,0.06)]">
                    <div class="flex items-center justify-between gap-3 flex-wrap mb-[18px]">
                        <div>
                            <p class="text-[11px] font-bold text-[#C4A08A] tracking-[0.2em] uppercase mb-1.5">Overview</p>
                            <h3 class="text-[20px] font-bold text-[#3D2314]">Today's summary</h3>
                        </div>
                        <span class="text-[12px] font-bold text-[#C2622A] bg-[#F8ECE4] px-2.5 py-1.5 rounded-full">Live</span>
                    </div>

                    <div class="grid gap-3">
                        <div class="bg-[#FDF8F4] border border-[#E8DDD4] rounded-xl p-3.5">
                            <p class="text-[12px] text-[#7A5542] mb-1.5">Status</p>
                            <p class="text-[15px] font-bold text-[#3D2314]">{{ __("You're logged in!") }}</p>
                        </div>
                        <div class="bg-[#FDF8F4] border border-[#E8DDD4] rounded-xl p-3.5">
                            <p class="text-[12px] text-[#7A5542] mb-1.5">Operations</p>
                            <p class="text-[15px] font-semibold text-[#3D2314]">Rooms, leases, tenants, and billing are ready for updates.</p>
                        </div>
                    </div>
                </div>

                {{-- Quick actions --}}
                <div class="bg-gradient-to-b from-[#F9EEE4] to-[#FFF8F3] border border-[#E8DDD4] rounded-[18px] p-[22px] shadow-[0_10px_28px_rgba(61,35,20,0.06)]">
                    <p class="text-[11px] font-bold text-[#C4A08A] tracking-[0.2em] uppercase mb-3">Quick actions</p>
                    <div class="grid gap-3">
                        <a href="{{ route('admin.rooms.index') }}"
                        class="block px-3.5 py-3 bg-white border border-[#E8DDD4] rounded-[10px] text-[13px] font-bold text-[#3D2314] hover:bg-[#FDF8F4] hover:border-[#C2622A] transition-colors">
                            <i class="ti ti-door mr-2 text-[#C2622A]"></i>Manage Rooms
                        </a>
                        <a href="{{ route('admin.tenants.index') }}"
                        class="block px-3.5 py-3 bg-white border border-[#E8DDD4] rounded-[10px] text-[13px] font-bold text-[#3D2314] hover:bg-[#FDF8F4] hover:border-[#C2622A] transition-colors">
                            <i class="ti ti-users mr-2 text-[#C2622A]"></i>Manage Tenants
                        </a>
                        <a href="{{ route('admin.lease-contracts.index') }}"
                        class="block px-3.5 py-3 bg-white border border-[#E8DDD4] rounded-[10px] text-[13px] font-bold text-[#3D2314] hover:bg-[#FDF8F4] hover:border-[#C2622A] transition-colors">
                            <i class="ti ti-file-text mr-2 text-[#C2622A]"></i>Lease Contracts
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>