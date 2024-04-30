<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Reservation;
use App\Mail\ReservationReminder;

class SendReservationReminders extends Command
{
    protected $signature = 'send:reservation-reminders';
    protected $description = 'Send reservation reminders';

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
    $reservations = $user->reservations()->whereDate('date', now())->get();
    foreach ($reservations as $reservation) {
        try {
            Mail::to($user->email)->send(new ReservationReminder($reservation));
        } catch (\Exception $e) {
            \Log::error("Reservation reminder to {$user->email} failed: " . $e->getMessage());
        }
    }
}

        $this->info('Reservation reminders sent successfully!');

    }
}

