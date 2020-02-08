<?php

namespace App\Http\Controllers\Admin\Departments;

use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
use App\Http\Requests\UserUnitRequest;
use App\Http\Controllers\Controller;
use App\Models\DepartmentUnit;
use App\Models\UserUnit;
use App\Models\Tickets\TicketVendor;

use App\User;

class UnitController extends Controller
{
    private $unit;
    private $userUnit;
    private $vendor;

    function __construct(DepartmentUnit $unit, UserUnit $userUnit, TicketVendor $vendor) {
        $this->unit = $unit;
        $this->userUnit = $userUnit;
        $this->vendor = $vendor;
    }

    public function index() {
        $units = $this->unit->orderBy('name')->paginate(15);
        $users = $this->vendor->paginate(15); //[FIX LATER!] retrieve only the ones not yet assigned to a unit
        $vendors = $this->vendor->all();

        return view('admin.units.list', compact('units', 'users', 'vendors'));
    }

    public function store(UnitRequest $request) {

        $unit = $this->unit->create($request->all());

        if(!$unit) {
            return response(['status' => false, 'Error creating unit']);
        }

        return response(['status' => true, 'message' => "Unit created successfully!"]);
    }

    public function assignUsers(UserUnitRequest $request) {

        foreach($request->staff_ids as $id) {

            //Check if user has earlier been assigned to this unit
            $this->userUnit->where('user_id', $id)->delete();

            //Reassign to unit.
            $unit = $this->userUnit->create([
                'user_id' => $id,
                'unit_id' => $request->unit_id,
            ]);
        }

        return response(['status' => true, 'message' => "Assignment has been successfully processed!"]);
    }


    public function show(Request $request, DepartmentUnit $unit) {
        $user = $request->user();

        $staff = $unit->staff();
        $departments = \App\Models\Department::all();

        $vendors = $this->vendor->whereNotIn('id', $staff->pluck('id')->toArray())->get();

        if($request->has('remove')) {
            $this->removeVendor($unit, $request->user_id);
        }

        if($request->has('filter')) {
            $staff = $this->vendor->filterData($staff, $request);
        } else {
            $staff = $staff->orderBy('name');
        }

        $staff = $staff->paginate(15);

        return view('admin.units.show', compact('unit', 'staff', 'departments', 'vendors'));
    }


    public function update(UnitRequest $request, DepartmentUnit $unit) {

        $update = $unit->update($request->all());

        if(!$update) {
            return response(['status' => false, 'Error updating unit']);
        }

        return response(['status' => true, 'message' => "Unit updated successfully!"]);
    }

    public function delete(DepartmentUnit $unit) {

        $unit->categories()->delete(); //Delete related categories
        $unit->delete();

        return redirect()->back()->withMessage('Unit deleted successfully!')->withAlertClass('alert-success');
     }


    public function removeVendor($unit, $user_id) {

        $userUnit = $this->userUnit->where(['user_id' => $user_id, 'unit_id' => $unit->id]);

        if($userUnit->count() < 1) {
            return redirect()->back()->withMessage('Vendor can only be removed if in more than one unit')->withAlertClass('alert-danger');
        }

        $userUnit->delete();
        return redirect()->back()->withMessage('Vendor removed successfully!')->withAlertClass('alert-success');
    }

}
