<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use App\Services\MarksService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    protected $marksService;

    public function __construct(MarksService $marksService)
    {
        $this->marksService = $marksService;
    }

    public function get(Request $request)
    {
        $marks = Marks::firstOrCreate($request->only('date'));
        return response()->json([
            'success' => true,
            'data' => ['marks' => $marks]
        ]);
    }

    public function updateOrCreate(Request $request)
    {
        $success = (bool) Marks::updateOrCreate($request->only('date'), $request->all());
        return response()->json([
            'success' => $success,
            'message' => $success ? __('marks.success') : __('marks.error')
        ]);
    }

    public function statistic(Request $request)
    {
        $marks = $this->marksService->getAllMarksFromDates($request->start_date, $request->end_date);
        return response()->json(['success' => true, 'data' => ['marks' => $marks]]);
    }
}
