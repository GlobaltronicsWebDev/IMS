<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryFormRequest;


class CategoryController extends Controller
{
    //


 public function index()
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
                return view('admin.category.index');
                break;
        }

    }

    public function create()
    {
    return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validateData = $request->validated();
        $category = new Category;
        $category->name = $validateData['name'];
        $category->save();

        return redirect('admin/category')->with('message','Category Added Successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {
        $validateData = $request->validated();

        $category = Category::findOrFail($category);

        $category->name = $validateData['name'];

        $category->update();

        return redirect('admin/category')->with('message','Category Updated Successfully!');
    }


}
