<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
            <div>
                <h2 style="font-size: 22px; font-weight: 700; color: #3D2314; margin: 0;">
                    {{ __('Dashboard') }}
                </h2>
                <p style="font-size: 13px; color: #7A5542; margin: 4px 0 0;">Welcome back to your rental operations overview.</p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 32px 0;">
        <div style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">
            <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; margin-bottom: 20px;">
                <div style="padding: 18px; background: #fff; border: 0.5px solid #E8DDD4; border-radius: 16px; box-shadow: 0 8px 24px rgba(61, 35, 20, 0.06);">
                    <p style="font-size: 12px; color: #7A5542; margin: 0 0 8px;">Total Rooms</p>
                    <h3 style="font-size: 26px; color: #3D2314; margin: 0;">128</h3>
                </div>
                <div style="padding: 18px; background: #fff; border: 0.5px solid #E8DDD4; border-radius: 16px; box-shadow: 0 8px 24px rgba(61, 35, 20, 0.06);">
                    <p style="font-size: 12px; color: #7A5542; margin: 0 0 8px;">Occupied</p>
                    <h3 style="font-size: 26px; color: #3D2314; margin: 0;">86</h3>
                </div>
                <div style="padding: 18px; background: #fff; border: 0.5px solid #E8DDD4; border-radius: 16px; box-shadow: 0 8px 24px rgba(61, 35, 20, 0.06);">
                    <p style="font-size: 12px; color: #7A5542; margin: 0 0 8px;">Active Tenants</p>
                    <h3 style="font-size: 26px; color: #3D2314; margin: 0;">74</h3>
                </div>
                <div style="padding: 18px; background: #fff; border: 0.5px solid #E8DDD4; border-radius: 16px; box-shadow: 0 8px 24px rgba(61, 35, 20, 0.06);">
                    <p style="font-size: 12px; color: #7A5542; margin: 0 0 8px;">Pending Contracts</p>
                    <h3 style="font-size: 26px; color: #3D2314; margin: 0;">12</h3>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 16px;">
                <div style="background: #fff; border: 0.5px solid #E8DDD4; border-radius: 18px; padding: 22px; box-shadow: 0 10px 28px rgba(61, 35, 20, 0.06);">
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 18px; flex-wrap: wrap;">
                        <div>
                            <p style="font-size: 11px; letter-spacing: 0.2em; text-transform: uppercase; color: #C4A08A; margin: 0 0 6px; font-weight: 700;">Overview</p>
                            <h3 style="font-size: 20px; color: #3D2314; margin: 0;">Today’s summary</h3>
                        </div>
                        <span style="padding: 6px 10px; border-radius: 999px; background: #F8ECE4; color: #C2622A; font-size: 12px; font-weight: 700;">Live</span>
                    </div>

                    <div style="display: grid; gap: 12px;">
                        <div style="padding: 14px; border-radius: 12px; background: #FDF8F4; border: 0.5px solid #E8DDD4;">
                            <p style="font-size: 12px; color: #7A5542; margin: 0 0 6px;">Status</p>
                            <p style="font-size: 15px; color: #3D2314; font-weight: 700; margin: 0;">{{ __('You\'re logged in!') }}</p>
                        </div>
                        <div style="padding: 14px; border-radius: 12px; background: #FDF8F4; border: 0.5px solid #E8DDD4;">
                            <p style="font-size: 12px; color: #7A5542; margin: 0 0 6px;">Operations</p>
                            <p style="font-size: 15px; color: #3D2314; font-weight: 600; margin: 0;">Rooms, leases, tenants, and billing are ready for updates.</p>
                        </div>
                    </div>
                </div>

                <div style="background: linear-gradient(180deg, #F9EEE4, #FFF8F3); border: 0.5px solid #E8DDD4; border-radius: 18px; padding: 22px; box-shadow: 0 10px 28px rgba(61, 35, 20, 0.06);">
                    <p style="font-size: 11px; letter-spacing: 0.2em; text-transform: uppercase; color: #C4A08A; margin: 0 0 10px; font-weight: 700;">Quick actions</p>
                    <div style="display: grid; gap: 12px;">
                        <a href="{{ route('admin.rooms.index') }}" style="display: block; padding: 12px 14px; border-radius: 10px; background: #fff; color: #3D2314; text-decoration: none; font-size: 13px; font-weight: 700; border: 0.5px solid #E8DDD4;">Manage Rooms</a>
                        <a href="{{ route('admin.tenants.index') }}" style="display: block; padding: 12px 14px; border-radius: 10px; background: #fff; color: #3D2314; text-decoration: none; font-size: 13px; font-weight: 700; border: 0.5px solid #E8DDD4;">Manage Tenants</a>
                        <a href="{{ route('admin.lease-contracts.index') }}" style="display: block; padding: 12px 14px; border-radius: 10px; background: #fff; color: #3D2314; text-decoration: none; font-size: 13px; font-weight: 700; border: 0.5px solid #E8DDD4;">Lease Contracts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
