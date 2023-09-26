<?php

namespace App\Http\Controllers;
use App\Category;
use App\AssetType;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function categories()
    {
        $categories = Category::get();
        $asset_types = AssetType::get();
        return view('categories',
        
        array(
        'subheader' => '',
        'header' => "Category",
        'categories' => $categories,
        'asset_types' => $asset_types
        )
    );
    }

    public function newCategory(Request $request)
    {
        $this->validate($request, [
            'code' => 'unique:categories|required',
            'category_name' => 'required',
        ]);
        // dd($request->all());
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->code = $request->code;
        $category->asset_type_id = $request->asset_type;
        $category->status = "Active";
        $category->save();
        $request->session()->flash('status','Successfully created');
        return back();
    }

    public function deactivateCategory(Request $request)
    {
        $category = Category::where('id',$request->id)->first();
        $category->status = "Inactive";
        $category->save();

        return $request;
    }
    public function activateCategory(Request $request)
    {
        $brand = Category::where('id',$request->id)->first();
        $brand->status = "Active";
        $brand->save();

        return $request;
        // return $brand;
    }
}
