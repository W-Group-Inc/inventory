<?php

namespace App\Http\Controllers;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //

    public function departments (Request $request)
    {
        $departments = Department::where('status','=',null)->get();
        return view('departments',
        array(
            'subheader' => '',
            'header' => "Departments",
            'departments' => $departments,
            )
        );
    }
    public function editDepartment (Request $request)
    {
        $department = Department::findOrfail($request->department_id);
        $department->code = $request->code;
        $department->name = $request->department;
        $department->save();

     
        $request->session()->flash('status','Successfully Updated');
        return back();
    }
    public function newDepartment (Request $request)
    {
        $department = new Department;
        $department->code = $request->code;
        $department->name = $request->department_name;
        $department->save();

     
        $request->session()->flash('status','Successfully Created');
        return back();
    }
}
