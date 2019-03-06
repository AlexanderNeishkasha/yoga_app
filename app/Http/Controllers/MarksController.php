<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetMarks;
use App\Http\Requests\Statistic;
use App\Http\Requests\UpdateMarks;
use App\Models\Marks;
use App\Models\Notification;
use App\Services\MarksService;
use Illuminate\Support\Facades\Auth;

class MarksController extends Controller
{
    protected $marksService;

    public function __construct(MarksService $marksService)
    {
        $this->marksService = $marksService;
    }

    public function get(GetMarks $request)
    {
        $marks = Marks::firstOrCreate(['user_id' => Auth::id(), 'date' => $request->date]);
        return response()->json([
            'success' => true,
            'data' => ['marks' => $marks]
        ]);
    }

    public function updateOrCreate(UpdateMarks $request)
    {
        $user_id = Auth::id();
        $marksData = array_merge($request->all(), ['user_id' => $user_id]);
        $success = (bool) Marks::updateOrCreate(['user_id' => $user_id, 'date' => $request->date], $marksData);
        return response()->json([
            'success' => $success,
            'message' => $success ? __('marks.success') : __('marks.error'),
            'notify' => Notification::query()->inRandomOrder()->first()->message
        ]);
    }

    public function statistic(Statistic $request)
    {
        $marks = $this->marksService->getAllMarksFromDates($request->start_date, $request->end_date);
        return response()->json(['success' => true, 'data' => ['marks' => $marks]]);
    }
}
