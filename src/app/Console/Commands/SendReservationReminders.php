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
                Mail::to($user->email)->send(new ReservationReminder($reservation));
            }
        }

        $this->info('Reservation reminders sent successfully!');

    }
}

