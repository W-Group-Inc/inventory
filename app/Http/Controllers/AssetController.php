<?php

namespace App\Http\Controllers;
use App\Inventory;
use App\Category;
use PDF;
use App\Notifications\SignedContractNotification;
use App\Notifications\ReturnItemNotification;
use App\EmployeeInventories;
use App\Transaction;
use App\AssetCode;
use App\AssetType;
use App\ReturnInventories;
use App\ReturnInventoryData;
use App\ReturnItem;
use App\Department;
use App\Employee;
use App\InventoryTransaction;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class AssetController extends Controller
{
    //
    public function assets()
    {
        $inventories = Inventory::with('category')->get();
        $categories = Category::where('status','=',"Active")->get();
        $asset_types = AssetType::where('status','=',null)->get();
        return view('inventories',
        array(
            'subheader' => '',
            'header' => "Assets",
            'inventories' => $inventories,
            'categories' => $categories,
            'asset_types' => $asset_types,
            )
        );
    }
    public function availableAssets()
    {
        $inventories = Inventory::with('category')->where('status','Active')->get();

        $employees = Employee::with('dep')->get();
        $departments = Department::get();
        // dd($departments);
        return view('available_inventories',

        array(
            'subheader' => '',
            'header' => "Available Assets",
            'inventories' => $inventories,
            'employees' => $employees,
            'departments' => $departments
            )
        );

    }
    public function newAssets(Request $request)
    {
        // dd($request->all());
        $def = "N/A";
        if(($request->category == 2) || ($request->category == 4))
        {

        }
        else
        {

            $this->validate($request, [
                'category' => 'required',
                'brand' => 'required',
                'model' => 'required',
                'description' => 'required',
                // 'date_purchased' => 'required',
            ]);
        }
        $oldest_data = Inventory::where('category_id',$request->category)->orderBy('id','desc')->first();
        $inventory_code = 0;
        if($oldest_data == null)
        {
            $inventory_code = $inventory_code + 1;
        }
        else
        {
            $inventory_code =  $oldest_data->equipment_code + 1 ;
        }

        $attachment = $request->file('file');
        $original_name = $attachment->getClientOriginalName();
        $name = time().'_'.$attachment->getClientOriginalName();
        $attachment->move(public_path().'/images/', $name);
        $file_name = '/images/'.$name;



        $invetory = new Inventory;
        $invetory->image = $file_name;
        $invetory->category_id = $request->category;
        $invetory->po_number = $request->po_number;
        $invetory->equipment_code = $inventory_code;
        $invetory->brand = $request->brand;
        $invetory->model = $request->model;
        $invetory->serial_number = $request->serial_number;
        $invetory->engine_number = $request->engine_number;
        $invetory->plate_number = $request->plate_number;
        $invetory->chasis_number = $request->chasis_number;
        $invetory->supplier = $request->supplier;
        $invetory->date_purchase = $request->date_purchased;
        $invetory->description = $request->description;
        $invetory->amount = $request->amount;
        $invetory->status = "Active";
        $invetory->save();


        $request->session()->flash('status','Successfully Created');
        return back();

    }
    public function assignAssets(Request $request)
    {
        // dd($request->all());
        foreach($request->asset as $asset)
        {
            $data = Inventory::where('id',$asset)->first();
            $data->status = "Deployed";
            $data->save();
            if($request->department != null)
            {
                $asset_code = AssetCode::where('department','=',$request->department)->first();
                $asset_codes = AssetCode::where('department','=',$request->department)->orderBy('id','desc')->first();
                $code = 0;
                if($asset_code == null)
                {
                    if($asset_codes == null)
                    {
                        $code = $code + 1;
                    }
                    else
                    {
                        $code =  $asset_codes->code + 1;
                    }
                    $newCode = new AssetCode;
                    $newCode->code = $code;
                    $newCode->employee_id = $request->employee;
                    $newCode->department = $request->department;
                    $newCode->encode_by = auth()->user()->id;
                    $newCode->save();
                }
            }
            else
            {
                $asset_code = AssetCode::where('employee_id',$request->employee)->where('department','=',null)->first();
                $asset_codes = AssetCode::where('department','=',null)->orderBy('id','desc')->first();
                $code = 0;
                if($asset_code == null)
                {
                    if($asset_codes == null)
                    {
                        $code = $code + 1;
                    }
                    else
                    {
                        $code =  $asset_codes->code + 1;
                    }
                    $newCode = new AssetCode;
                    $newCode->code = $code;
                    $newCode->employee_id = $request->employee;
                    $newCode->encode_by = auth()->user()->id;
                    $newCode->save();
                }
            }

            $employeeInventory = new EmployeeInventories;
            $employeeInventory->inventory_id = $asset;
            $employeeInventory->emp_code = $request->employee;
            $employeeInventory->status = "Active";
            $employeeInventory->department = $request->department;
            $employeeInventory->date_assigned = date('Y-m-d');
            $employeeInventory->assigned_by = auth()->user()->id;
            $employeeInventory->save();
        }


        $request->session()->flash('status','Successfully Assigned');
        return back();
    }
    public function viewAccountabilityPdf(Request $request,$id)
    {
        $transaction = Transaction::with('inventories.inventoriesData.category')->where('id',$id)->first();

        $pdf = PDF::loadView('asset_pdf',array(
         'transaction' =>$transaction

        ));
        return $pdf->stream('accountability.pdf');
    }
    public function returnItemPdf(Request $request,$id)
    {
        $transaction = ReturnItem::with('items.employee_inventory_d.inventoryData.category')->where('id',$id)->first();
        // dd($transaction->items[0]->employee_inventory_d->inventoryData->category);
        $pdf = PDF::loadView('returnItemPDF',array(
         'transaction' =>$transaction

        ));
        return $pdf->stream('returnItems.pdf');
    }
    public function printInventory(Request $request,$id)
    {
        $inventory = Inventory::with('category')->where('id',$id)->first();
        // dd($transaction->items[0]->employee_inventory_d->inventoryData->category);
        $pdf = PDF::loadView('printInventory',array(
         'inventory' =>$inventory

        ));
        return $pdf->stream('PrintInventory.pdf');
    }
    public function for_repair()
    {
        return view('for_repair',
            array(
            'subheader' => '',
            'header' => "For Repairs",
            )
        );
    }
    public function accountabilities()
    {

        $employeeInventories = EmployeeInventories::with('inventoryData.category','transactions')->whereHas('transactions')->where('status','Active')->get();
        return view('accountabilities',
            array(
            'subheader' => '',
            'header' => "Accountabilities",
            'employeeInventories' => $employeeInventories,
            )
        );
    }
    public function deployedAssets()
    {
        return view('deployed_assets',
            array(
            'subheader' => '',
            'header' => "Deployed Assets",
            )
        );
    }
    public function transactions()
    {


        $employees = Employee::with('dep')->get();
            $assetCodes = AssetCode::get();
            $assetCodesDepartment = AssetCode::where('department','!=',null)->get();
            $employeeInventories = EmployeeInventories::with('inventoryData.category','EmployeeInventories.inventoryData.category')->where('status','Active')->where('generated',null)->where('department',null)->get();
            $employeeInventoriesDepartment = EmployeeInventories::with('inventoryData.category','EmployeeInventoriesDepartment.inventoryData.category')->where('status','Active')->where('generated',null)->where('department','!=',null)->get();
            $transactions = Transaction::orderBy('id','desc')->get();
            // dd($transactions);
            return view('transactions',
            array(
            'subheader' => '',
            'header' => "Transactions",
            'employeeInventories' => $employeeInventories,
            'employees' => $employees,
            'transactions' => $transactions,
            'assetCodes' => $assetCodes,
            'employeeInventoriesDepartment' => $employeeInventoriesDepartment,
            'assetCodesDepartment' => $assetCodesDepartment,
            )
        );
    }
    public function returnItem (Request $request)
    {
        // dd($request->all());
        $employeeInventory = EmployeeInventories::where('id',$request->idAccountability)->first();
        $employeeInventory->date_returned = date('Y-m-d');
        $employeeInventory->remarks = $request->description;
        $employeeInventory->returned_status = $request->status;
        if($request->status == "Active")
        {
            $employeeInventory->returned_status = "Good Condition";
        }

        $employeeInventory->returned_to = auth()->user()->id;
        $employeeInventory->status = "Returned";
        $employeeInventory->save();

        $returnInventory = new ReturnInventories;
        $returnInventory->employee_inventory_id = $request->idAccountability;
        $returnInventory->inventory_id = $employeeInventory->inventory_id;
        $returnInventory->encode_by = auth()->user()->id;
        $returnInventory->name = $request->name;
        $returnInventory->position = $request->position;
        $returnInventory->department = $request->department;
        $returnInventory->emp_code = $request->emp_code;
        $returnInventory->email = $request->email;
        $returnInventory->save();

        $inventory = Inventory::where('id',$employeeInventory->inventory_id)->first();
        $inventory->status = $request->status;
        $inventory->save();

        Alert::success('Successfully returned.')->persistent('Dismiss');
        return back();

    }
    public function generateData (Request $request)
    {
        // dd($request->all());
        if($request->department_data != null)
        {
            $employeeInventories = EmployeeInventories::where('emp_code',$request->employee_codes)->where('status','Active')->where('department','!=',null)->where('generated',null)->get();
        }
        else
        {
            $employeeInventories = EmployeeInventories::where('emp_code',$request->employee_codes)->where('status','Active')->where('department','=',null)->where('generated',null)->get();
        }

        $transaction = new Transaction;
        $transaction->emp_code = $request->employee_codes;
        $transaction->asset_code = $request->employee_code;
        $transaction->name = $request->name;
        $transaction->department = $request->department;
        $transaction->email = $request->email_address;
        $transaction->position = $request->position;
        $transaction->status = "For Upload";
        $transaction->save();

        foreach($employeeInventories as $int)
        {
            $int->generated = 1;
            $int->save();
            $inventorytransaction = new InventoryTransaction;
            $inventorytransaction->transaction_id = $transaction->id;
            $inventorytransaction->inventory_id = $int->inventory_id;
            $inventorytransaction->save();
        }

        Alert::success('Successfully generated.')->persistent('Dismiss');
        return back();
        // dd($request->all());
    }
    public function viewAccountabilitiesData(Request $request)
    {

        $employees = Employee::with('dep')->get();
        $employeesCollect = $employees;
        // dd($employeesCollect);
        $employee = $employeesCollect->where('emp_code',$request->emp_id)->first();
        // dd($employee);
        $employeeInventories = EmployeeInventories::with('inventoryData.category','transactions')->where('emp_code',$request->emp_id)->get();
        $categories = Category::where('status','Active')->get();

        // dd($employees);
        return view('viewAccountabilitiesData',
        array(
            'employeeInventories' => $employeeInventories,
            'employee' => $employee,
            )
        );

    }
    public function uploadSignedContract(Request $request)
    {

        $transaction = Transaction::where('id',$request->transaction)->first();
        $transaction->uploaded_by = auth()->user()->id;
        if($request->hasFile('upload_pdf'))
        {
            $attachment = $request->file('upload_pdf');
            $original_name = $attachment->getClientOriginalName();
            $name = time().'_'.$attachment->getClientOriginalName();
            $attachment->move(public_path().'/transac/', $name);
            $file_name = '/transac/'.$name;
            $transaction->pdf = $file_name;
            $transaction->status = "Uploaded";
            $transaction->save();

            // $transaction->notify(new SignedContractNotification(url($file_name)));
            Alert::success('Successfully uploaded.')->persistent('Dismiss');
            return back();

        }
    }
    public function return_items()
    {

        $items = ReturnInventories::with('depp','return_inventories.inventory_data.category','inventory_data','return_inventories.employee_inventories')->where('generated',null)->get();

        $transactions = ReturnItem::orderBy('id','desc')->get();
        return view('return_items',
            array(
            'subheader' => '',
            'items' => $items,
            'transactions' => $transactions,
            'header' => "Returns",
            )
        );
    }
    public function generate_data_return(Request $request)
    {
        $employeeInventories = ReturnInventories::where('emp_code',$request->employee_code)->where('generated',null)->get();

        $transaction = new ReturnItem;
        $transaction->emp_code = $request->employee_code;
        $transaction->name = $request->name;
        $transaction->department = $request->department;
        $transaction->email = $request->email;
        $transaction->position = $request->position;
        $transaction->status = "For Upload";
        $transaction->save();

        foreach($employeeInventories as $int)
        {
            $int->generated = 1;
            $int->date_generated = date('Y-m-d');
            $int->generated_by = auth()->user()->id;
            $int->save();
            $inventorytransaction = new ReturnInventoryData;
            $inventorytransaction->transaction_id = $transaction->id;
            $inventorytransaction->employee_inventory = $int->employee_inventory_id;
            $inventorytransaction->save();
        }
        Alert::success('Successfully generated.')->persistent('Dismiss');
        return back();
    }
    public function upload_pdf_return(Request $request)
    {
        $transaction = ReturnItem::where('id',$request->transaction)->first();
        $transaction->uploaded_by = auth()->user()->id;
        if($request->hasFile('upload_pdf'))
        {
            $attachment = $request->file('upload_pdf');
            $original_name = $attachment->getClientOriginalName();
            $name = time().'_'.$attachment->getClientOriginalName();
            $attachment->move(public_path().'/transac/', $name);
            $file_name = '/transac/'.$name;
            $transaction->pdf = $file_name;
            $transaction->status = "Uploaded";
            $transaction->save();

            // $transaction->notify(new ReturnItemNotification(url($file_name)));
            Alert::success('Successfully uploaded.')->persistent('Dismiss');
            return back();

        }
    }

    public function reports(Request $request)
    {
            $dep = null;
            if($request->department != null)
            {
                $dep = $request->department;

                $inventories = Inventory::with(['category','employee_inventory.employee_info.dep'])
                ->whereHas('employee_inventory.employee_info.dep', function ($query) use ($dep) {
                    $query->where('id', $dep);
                })
                ->get();
        }
            else

            {
                $inventories = Inventory::with(['category','employee_inventory.employee_info.dep'])
            ->get();
          }

        $departments = Department::get();
        return view('report',
        array(
            'subheader' => '',
            'header' => "Reports",
            'inventories' => $inventories,
            'departments' => $departments,
            'depa' => $dep,
            )
        );
    }
    public function printreports(Request $request)
    {
            $dep = null;

            $depart =  null;
            if($request->department != null)
            {
                $dep = $request->department;

                $inventories = Inventory::with(['category','employee_inventory.employee_info.dep'])
                ->whereHas('employee_inventory.employee_info.dep', function ($query) use ($dep) {
                    $query->where('id', $dep);
                })
                ->get();
        }
            else

            {
                $inventories = Inventory::with(['category','employee_inventory.employee_info.dep'])
            ->get();

          }

          $pdf = PDF::loadView('inventories-print',array(
            'inventories' =>$inventories,
            'department'  => $depart

           ))->setPaper('', 'landscape');;
           return $pdf->stream('Inventory.pdf');
    }
}
