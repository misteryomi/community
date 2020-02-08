<?php

namespace App\Http\Controllers\Admin\Departments;

use App\Http\Requests\DepartmentRequest;
use App\Http\Controllers\Controller;
use App\Models\Department;

class DepartmentController extends Controller
{
    private $department;

    function __construct(Department $department) {
        $this->department = $department;
    }

    public function index() {
        $departments = $this->department->orderBy('name')->paginate(15);
        $vendors = \App\Models\Tickets\TicketVendor::all();

        return view('admin.departments.list', compact('departments', 'vendors'));
    }

    public function store(DepartmentRequest $request) {

        $department = $this->department->create($request->except('_token'));

        if(!$department) {
            return redirect()->back()->withMessage('Error creating Department')->withAlertClass('alert-danger');
        }

        return redirect()->back()->withMessage('Department created successfully!')->withAlertClass('alert-success');
    }


    public function update() {

    }

    public function delete() {

    }
}
