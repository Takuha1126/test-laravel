<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;



class DeleteExpiredReservations extends Command
{
    protected $signature = 'reservations:delete-expired';
    protected $description = 'Delete expired reservations';

    public function handle()
    {
        
        $currentTime = Carbon::now();


        $expiredReservations = Reservation::where('reservation_time', '<', $currentTime->subMinutes(15))
                                           ->get();

        foreach ($expiredReservations as $reservation) {
            $reservation->delete();
        }

        $this->info('Expired reservations deleted successfully.');
    }
}

