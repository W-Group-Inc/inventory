<?php

namespace App\Http\Controllers;
use App\PhysicalInventory;
use App\Department;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class PhysicalInventoryController extends Controller
{
    //

    public function index()
    {
        $departments = Department::get();
        $counts = PhysicalInventory::with('department','user')->get();
        return view('physicalinventory',
        
        array(
        'subheader' => '',
        'header' => "Phisical Inventory",
        'counts' => $counts,
        'departments' => $departments,
        )
        );
        
    }
    public function create(Request $request)
    {
        // dd($request->all());

        $count = new PhysicalInventory;
        $count->department_id = $request->department;
        $count->user_id = auth()->user()->id;
        $count->date_coducted = $request->date_conducted;
        $count->remarks = $request->remarks;
        if($request->hasFile('file'))
        {
            $attachment = $request->file('file');
            $original_name = $attachment->getClientOriginalName();
            $name = time().'_'.$attachment->getClientOriginalName();
            $attachment->move(public_path().'/file/', $name);
            $file_name = '/file/'.$name;
            $count->attachment = $file_name;
            $count->name = $name;
            $count->save();

            // $transaction->notify(new SignedContractNotification(url($file_name)));
            Alert::success('Successfully uploaded.')->persistent('Dismiss');
            return back();
            
        }
    }
}
