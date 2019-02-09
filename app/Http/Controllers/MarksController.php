<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MarksController extends Controller
{
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
}
