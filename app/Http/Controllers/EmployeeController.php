<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Alert;
use App\EmployeeInventories;
use App\Employee;
use App\User;
use App\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function employees()
    {
        $employeeInventories = EmployeeInventories::with('inventoryData.category')->get();
        $employees = Employee::with('dep')->get();
        $departments = Department::orderBy('name','asc')->get();
       
       
        return view('employees',
        
        array(
        'subheader' => '',
        'header' => "Employees",
        'employees' => $employees,
        'employeeInventories' => $employeeInventories,
        'departments' => $departments
        )
        );
    }
    
    public function new_employee (Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'emp_code' => 'required|unique:employees',
            'department' => 'required',
            'position' => 'required',
            'emp_type' => 'required',
        ]);

        $employee = new Employee;
        $employee->emp_code = $request->emp_code;
        $employee->name = $request->name;
        $employee->department = $request->department;
        $employee->position = $request->position;
        $employee->emp_type = $request->emp_type;
        $employee->status = "Active";
        $employee->save();
        
        $request->session()->flash('status','Successfully Created');
        return back();
    }
}
