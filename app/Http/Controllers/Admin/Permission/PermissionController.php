<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    private $user;
    private $role;
    private $permission;

    function __construct(User $user, Role $role, Permission $permission) {

        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(function($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function index() {
        $roles = $this->role->all();
        $permissions = $this->permission->paginate('15');

        return view('admin.permissions.permissions', compact('roles', 'permissions'));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|unique:permissions',
        ]);

        $permission = $this->permission->create([
                            'name' => Str::slug($request->name, '-'),
                            'guard_name' => 'web',
                        ]);

        if($request->has('roles')) {
            $permission->syncRoles($request->roles);
        }



        return redirect()->back()->withMessage('Permission added successfully');
    }

}
