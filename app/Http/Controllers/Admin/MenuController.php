<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class MenuController extends Controller
{
    private $menu;
    private $permission;
    private $role;

    function __construct(Menu $menu, Role $role, Permission $permission) {

        $this->menu = $menu;
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index() {
        $menus = $this->menu->get();
        $permissions = $this->permission->all();
        $roles = $this->role->all();

        return view('admin.menu.index', compact('menus', 'roles', 'permissions'));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required',
        ]);

        if(!$request->url && !$request->route) {
            return redirect()->back()->withError('Please specify a route name or external URL!');
        }

        if($request->route && !\Route::has($request->route)) {
            return redirect()->back()->withError('Specified route name does not exist!');
        }

        $requestData = $request->except('_token', 'roles');
        $requestData['is_parent'] = !$request->parent_id  ? true : false;
        $requestData['is_external'] = $request->url  ? true : false;

        $menu = $this->menu->create($requestData);

        if($request->has('roles')) {
            foreach($request->roles as $role) {
                $menu->menu_roles()->create([
                    'role_id' => $role
                ]);
            }
        }

        if($request->has('permissions')) {
            foreach($request->permissions as $permission) {
                $menu->menu_permissions()->create([
                    'permission_id' => $permission
                ]);
            }
        }

        return redirect()->back()->withMessage('Menu added successfully');
    }


    public function edit(Menu $menu) {

        $menus = $this->menu->get();
        $permissions = $this->permission->all();
        $roles = $this->role->all();

        return view('admin.menu.edit', compact('menu', 'menus', 'roles', 'permissions'));
    }


    public function update(Request $request, Menu $menu) {

        $this->validate($request, [
            'title' => 'required',
        ]);

        if(!$request->url && !$request->route) {
            return redirect()->back()->withError('Please specify a route name or external URL!');
        }

        if($request->route && !\Route::has($request->route)) {
            return redirect()->back()->withError('Specified route name does not exist!');
        }

        $requestData = $request->except('_token', 'roles', 'permission', 'parent_order', 'child_order');

        // Menu swapping
        if($menu->is_parent) {
            if($request->has('parent_order')) {
                $requestData['parent_order'] = $request->parent_order - 1;
            } else {
                $requestData['parent_order'] =  $menu->where('is_parent', 1)->count() + 1;
            }
        } else {
            if($request->has('child_order')) {
                $requestData['child_order'] = $request->child_order - 1;
            } else {
                $requestData['child_order'] = $menu->parent()->children()->count() + 1;
            }

        }



        // $requestData['is_parent'] = !$request->parent_id  ? true : false;
        // $requestData['is_external'] = $request->url  ? true : false;

        $menu = $menu->update($requestData);

        // if($request->has('roles')) {
        //     foreach($request->roles as $role) {
        //         $menu->menu_roles()->create([
        //             'role_id' => $role
        //         ]);
        //     }
        // }

        // if($request->has('permissions')) {
        //     foreach($request->permissions as $permission) {
        //         $menu->menu_permissions()->create([
        //             'permission_id' => $permission
        //         ]);
        //     }
        // }

        return redirect()->route('admin.menus.index')->withMessage('Menu updated successfully');
    }


    public function delete() {

    }
}
