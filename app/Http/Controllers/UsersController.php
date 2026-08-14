<?php

namespace App\Http\Controllers;

use App\Models\Committe;
use App\Models\Day;
use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Game;
use App\Models\News;
use App\Models\Partner;
use App\Models\PlayerSuspended;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\TopScore;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllUsers(UserService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }
        $users = $service->getAllUsers();

        return response()->json($users);
    }

    public function getUsers(UserService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }
        $users = $service->getAllUsers();

        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function getSingleUser($id, UserService $service)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }
        $user = $service->getSingleUser($id);

        return response()->json($user);
    }

    public function deleteSingleUser($id)
    {
        if (!Gate::allows('is-admin')) {
            Auth::logout();
            return redirect('/');
        }

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('errors', 'user not found');
        }

        $hasCreatedContent =
            News::where('userID', $id)->exists()
            || Event::where('userID', $id)->exists()
            || Document::where('userID', $id)->exists()
            || Gallery::where('userID', $id)->exists()
            || Partner::where('userID', $id)->exists()
            || Committe::where('userID', $id)->exists()
            || Season::where('userID', $id)->exists()
            || Day::where('userID', $id)->exists()
            || TeamCategory::where('userID', $id)->exists()
            || Team::where('userID', $id)->exists()
            || Game::where('userID', $id)->exists()
            || TopScore::where('userID', $id)->exists()
            || PlayerSuspended::where('userID', $id)->exists();

        if ($hasCreatedContent) {
            return redirect('/users')->with(
                'errors',
                'Cannot delete this user because they created records. Reassign or remove those records first (Creator Report).'
            );
        }

        $user->delete();

        return redirect('/users')
            ->with('message', 'user deleted successfully');
    }
}
