<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Helpers;

class TeamsController extends Controller
{
    protected $superAdminId;
    protected $noEditPermission;
    protected $noDeletePermission;
    protected $blankTarget;

    public function __construct()
    {
        $this->noEditPermission = config('global-variable.no_edit_permission');
        $this->noDeletePermission = config('global-variable.no_delete_permission');
        $this->superAdminId = config('global-variable.super_admin');
        $this->blankTarget = config('global-variable.BLANK_TARGET');

        $this->middleware('permission:team-lists|team-add|team-view|team-edit|team-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:team-lists', ['only' => ['index']]);
        $this->middleware('permission:team-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:team-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:team-view', ['only' => ['show']]);
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $teams = ($user->isSuperAdmin($this->superAdminId))
            ? Team::latest()->get()
            : Team::ownedBy($user->id)->latest()->get();

        if ($request->ajax()) {
            return DataTables::of($teams)
                ->addColumn('tid', function ($team) use ($user) {
                    Helpers::assignTeamAdminRoleIfDeleted($team->team_admin, $team->id, $user->id);
                    return $team->id ?? 'Not Provided';
                })
                ->addColumn('name', function ($team) {
                    $user = auth()->user();
                    if ($user->can('team-view')) {
                        return '<a class="show-team-details" href="javascript:void(0)" data-id="' . Helpers::encryptId($team->id) . '" target="' . $this->blankTarget . '">' . ucfirst($team->name) . '</a>';
                    }
                    return ucfirst($team->name ?? 'Not Provided');
                })
                ->addColumn('count', function ($team) {
                    return $team->validMemberCount();
                })
                ->rawColumns(['name'])
                ->make(true);
        }

        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'team_admin' => 'required|exists:users,id',
        ]);

        Team::create($validated);

        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }

    public function show($id)
    {
        $team = Team::findOrFail(Helpers::decryptId($id));
        return view('admin.teams.show', compact('team'));
    }

    public function edit($id)
    {
        $team = Team::findOrFail(Helpers::decryptId($id));
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail(Helpers::decryptId($id));

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'team_admin' => 'required|exists:users,id',
        ]);

        $team->update($validated);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail(Helpers::decryptId($id));
        $team->delete();

        return response()->json(['success' => true]);
    }
}
