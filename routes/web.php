<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\LeaseContractController;
use App\Models\LeaseContract;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.rooms.index'));
    Route::resource('room-types', RoomTypeController::class);
    Route::patch('room-status/{room}', [RoomController::class, 'updateStatus'])->name('rooms.updateStatus');
    Route::resource('rooms', RoomController::class);
    Route::resource('tenants', TenantController::class);
    Route::resource('lease-contracts', LeaseContractController::class);
    Route::get('bills', [App\Http\Controllers\Admin\BillController::class, 'index'])->name('bills.index');
    Route::get('bills/generate', [App\Http\Controllers\Admin\BillController::class, 'create'])->name('bills.create');
    Route::post('bills/generate', [App\Http\Controllers\Admin\BillController::class, 'generate'])->name('bills.generate');
    Route::get('bills/{bill}', [App\Http\Controllers\Admin\BillController::class, 'show'])->name('bills.show');
    Route::get('bills/{bill}/edit', [App\Http\Controllers\Admin\BillController::class, 'edit'])->name('bills.edit');
    Route::put('bills/{bill}', [App\Http\Controllers\Admin\BillController::class, 'update'])->name('bills.update');
    Route::delete('bills/{bill}', [App\Http\Controllers\Admin\BillController::class, 'destroy'])->name('bills.destroy');
    Route::get('bills/{bill}/payments/create', [App\Http\Controllers\Admin\PaymentController::class, 'create'])->name('payments.create');
    Route::post('bills/{bill}/payments', [App\Http\Controllers\Admin\PaymentController::class, 'store'])->name('payments.store');
    Route::delete('bills/{bill}/payments/{payment}', [App\Http\Controllers\Admin\PaymentController::class, 'destroy'])->name('payments.destroy');
    Route::get('maintenance', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'index'])->name('maintenance.index');
    Route::get('maintenance/create', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'create'])->name('maintenance.create');
    Route::post('maintenance', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'store'])->name('maintenance.store');
    Route::get('maintenance/{maintenance}', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'show'])->name('maintenance.show');
    Route::get('maintenance/{maintenance}/edit', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'edit'])->name('maintenance.edit');
    Route::put('maintenance/{maintenance}', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'update'])->name('maintenance.update');
    Route::delete('maintenance/{maintenance}', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'destroy'])->name('maintenance.destroy');
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/reports/export', [App\Http\Controllers\Admin\ReportController::class, 'export'])->name('admin.reports.export');
});

Route::prefix('tenant')->name('tenant.')->middleware(['auth'])->group(function () {
    Route::get('maintenance', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'index'])->name('maintenance.index');
    Route::get('maintenance/create', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'create'])->name('maintenance.create');
    Route::post('maintenance', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'store'])->name('maintenance.store');
    Route::get('maintenance/{maintenance}', [App\Http\Controllers\Admin\MaintenanceRequestController::class, 'show'])->name('maintenance.show');
}); 

require __DIR__.'/auth.php';
