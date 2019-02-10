<?php
/**
 * Created by PhpStorm.
 * User: yanster
 * Date: 10/02/19
 * Time: 16:50
 */

namespace App\Services;

use App\Models\Marks;
use Carbon\CarbonPeriod;

class MarksService
{
    public function getAllMarksFromDates($startDate, $endDate)
    {
        $marks = Marks::whereBetween('date', [$startDate, $endDate])->get();
        $period = CarbonPeriod::create($startDate, $endDate);
        $notFoundedMarks = [];
        foreach ($period as $date) {
            if (!$marks->contains('date', $date->format('Y-m-d'))) {
                array_push($notFoundedMarks, ['date' => $date->format('Y-m-d')]);
            }
        }
        Marks::insert($notFoundedMarks);
        $insertedMarks = Marks::whereIn('date', $notFoundedMarks)->get();
        $marks->merge($insertedMarks);
        return $marks;
    }
}
