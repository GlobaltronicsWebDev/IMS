<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    //


 public function index()
    {
        if(!Auth::user()->role_as == '3'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        elseif(Auth::user()->role_as == '1'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        else
        return view('manager.category.index');
    }

    public function create()
    {
    return view('manager.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validateData = $request->validated();

        $category = new Category;
        $category->name = $validateData['name'];
        $category->save();

        return redirect('manager/category')->with('message','Category Added Successfully!');
    }

    public function edit(Category $category)
    {
        return view('manager.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {
        $validateData = $request->validated();

        $category = Category::findOrFail($category);

        $category->name = $validateData['name'];

        $category->update();

        return redirect('manager/category')->with('message','Category Updated Successfully!');
    }


}
