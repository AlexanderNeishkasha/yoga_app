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
use Illuminate\Support\Facades\Auth;

class MarksService
{
    public function getAllMarksFromDates($startDate, $endDate)
    {
        $user = Auth::user();
        $marks = Marks::forUser($user->id)->whereBetween('date', [$startDate, $endDate])->get();
        $period = CarbonPeriod::create($startDate, $endDate);
        $notFoundedMarks = [];
        foreach ($period as $date) {
            if (!$marks->contains('date', $date->format('Y-m-d'))) {
                array_push($notFoundedMarks, ['date' => $date->format('Y-m-d'), 'user_id' => $user->id]);
            }
        }
        Marks::insert($notFoundedMarks);
        $insertedDates = array_map(function ($item) {
            return $item['date'];
        }, $notFoundedMarks);
        $insertedMarks = Marks::forUser($user->id)->whereIn('date', $insertedDates)->get();
        $allMarks = collect($marks->toArray())->merge($insertedMarks->toArray());
        return $allMarks;
    }
}
