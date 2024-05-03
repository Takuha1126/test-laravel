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
        // 現在の日付と時刻を取得
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now();

        // 当日の予約で、かつ予約時間が現在時刻より15分前の予約を取得
        $expiredReservations = Reservation::whereDate('date', $currentDate)
                                          ->where('reservation_time', '<', $currentTime->subMinutes(15))
                                          ->get();

        foreach ($expiredReservations as $reservation) {
            // 各予約を削除
            $reservation->delete();
        }

        $this->info('Expired reservations for today deleted successfully.');
    }
}
