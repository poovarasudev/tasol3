<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    public $baseViewDirectory = 'teams.';

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->baseViewDirectory . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeamRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(TeamRequest $request)
    {
        Team::create($request->only(['name', 'description']));
        return redirect('/teams')->with('status', 'Team Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $teamId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($teamId)
    {
        $team = Team::whereNotIn('name', CONSTANT_TEAMS)->findOrFail($teamId);
        return view($this->baseViewDirectory . 'edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeamRequest $request
     * @param $teamId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(TeamRequest $request, $teamId)
    {
        $team = Team::whereNotIn('name', CONSTANT_TEAMS)->findOrFail($teamId);
        $team->update($request->only(['name', 'description']));
        return redirect('/teams')->with('status', 'Team Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $teamId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($teamId)
    {
        try {
            $team = Team::with('users')->findOrFail($teamId);
            if (isEmptyArray($team->users)) {
                $team->delete();
                return response()->json(['action' => 'success', 'message' => 'Team Deleted Successfully!']);
            } else {
                return response()->json(['action' => 'error', 'message' => 'Unable to delete team, Some users are attached to this team!'], 500);
            }
        } catch (\Throwable $exception) {
            return response()->json(['action' => 'error', 'message' => 'Unable to delete Team'], 500);
        }
    }

    /**
     * Get Teams.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getTeams()
    {
        return DataTables::of(Team::all())
            ->addColumn('action', function ($team) {
                $buttons = '';
                if (!in_array($team->name, CONSTANT_TEAMS)) {
                    if (auth()->user()->can('teams.edit')) {
                        $buttons .= editButton(route("teams.edit", $team->id));
                    }
                    if (auth()->user()->can('teams.delete')) {
                        $buttons .= deleteButton(route("teams.delete", $team->id), $team->name);
                    }
                } else {
                    $buttons = '-';
                }
                return '<div class="form-inline justify-content-center">' . $buttons . '</div>';
            })
            ->make('true');
    }
}
