<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EcoProject;
use App\Models\EcoEvent;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $data = [
            'user'           => $user,
            'roles'          => $user->getRoleNames(),
            'permissions'    => $user->getAllPermissions()->pluck('name'),
            'projectsCount'  => EcoProject::count(),
            'eventsCount'    => EcoEvent::count(),
        ];

        return view('dashboard', $data);
    }

    public function adminPanel()
    {
        $users       = User::with('roles')->get();
        $roles       = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('admin.panel', compact('users', 'roles', 'permissions'));
    }

    public function analytics()
    {
        $projectsCount = EcoProject::count();
        $eventsCount   = EcoEvent::count();
        $usersCount    = User::count();

        return view('admin.analytics', compact('projectsCount', 'eventsCount', 'usersCount'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Өз аккаунтыңызды жоя алмайсыз!');
        }

        $user->delete();

        return back()->with('success', '"' . $user->name . '" пайдаланушысы жойылды.');
    }

    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Өз ролінізді өзгерте алмайсыз!');
        }

        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return back()->with('success', '"' . $user->name . '" пайдаланушысының ролі "' . $request->role . '" болып өзгертілді.');
    }
}

