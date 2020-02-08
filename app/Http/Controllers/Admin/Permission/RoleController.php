<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
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
        $roles = $this->role->paginate(15);
        $permissions = $this->permission->all();

        $this->user->assignRole('super-admin');

        return view('admin.permissions.roles', compact('roles', 'permissions'));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|unique:roles',
        ]);

        $role = $this->role->create([
                    'name' => Str::slug($request->name, '-'),
                    'guard_name' => 'web',
                ]);

        if($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->back()->withMessage('Permission added successfully');
    }

}
