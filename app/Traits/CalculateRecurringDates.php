<?php

namespace App\Traits;

use Carbon\Carbon;

trait CalculateRecurringDates
{
    private function calculateNextDate($frequency, $paymentDay = null, $paymentMonth = null)
    {
        $now = Carbon::now();

        return match ($frequency) {
            'daily' => $now->addDay(),
            'weekly' => $now->addWeek(),
            'monthly' => $this->getNextOccurrence($now, $paymentDay ?? $now->day, $now->month, 'month'),
            'yearly' => $this->getNextOccurrence($now, $paymentDay ?? $now->day, $paymentMonth ?? $now->month, 'year'),
        };
    }

    private function getNextOccurrence(Carbon $now, int $day, int $month, string $period): Carbon
{
    $nextDate = $now->copy()->setMonth($month)->setDay($day);
    
    if ($nextDate->lte($now)) {
        $nextDate = $period === 'month' ? $nextDate->addMonth() : $nextDate->addYear();
    }
    
    return $nextDate;
}
}
