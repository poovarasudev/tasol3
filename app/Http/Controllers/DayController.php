<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\Facades\DataTables;

class DayController extends Controller
{
    public $baseViewDirectory = 'admin.days.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view($this->baseViewDirectory . 'index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $teamId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $dayId)
    {
        try {
            $key = $request->get('key');
            $day = Day::findOrFail($dayId);
            $day->update([$key => (!$day->{$key})]);
            return response()->json(['action' => 'success', 'message' => 'Details Updated Successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['action' => 'error', 'message' => 'Unable to update the details'], 500);
        }
    }

    /**
     * Get Days.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDays()
    {
        return DataTables::of(Day::all())
            ->editColumn('breakfast', function ($day) {
                return self::getFoodColumns($day->id, 'breakfast', $day->breakfast);
            })
            ->editColumn('lunch', function ($day) {
                return self::getFoodColumns($day->id, 'lunch', $day->lunch);
            })
            ->make('true');
    }

    public static function getFoodColumns($id, $type, $yesOrNo) {
        $buttons = $yesOrNo ? '<button class="btn badge-success btn-sm">Yes</button>' : '<button class="btn badge-danger btn-sm">No</button>';
        if (auth()->user()->can('days.update')) {
            $alertText = !$yesOrNo ? 'Activate' : 'Deactivate';
            $buttons .= '<a type="button" class="btn mb-2 btn-outline-link" href="javascript:void(0);" onclick="updateDayDetail(\'' . route('days.update', $id) . '\', \'' . $type . '\', \'' . $alertText . '\')">
                    <span class="fe fe-edit-2 fe-16"></span></a>';
        }

        return new HtmlString($buttons);
    }
}
