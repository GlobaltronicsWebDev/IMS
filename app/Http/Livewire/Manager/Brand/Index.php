<?php

namespace App\Http\Livewire\Manager\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name,$brand_id, $category_id;

    //validation
    public function rules()
    {
        return [
            'name' => 'required|string',
            'category_id' => 'required|integer',
        ];
    }

    //reset input fields
    public function resetInput()
    {
        $this->name = NULL;
        $this->brand_id = NULL;
        $this->category_id = NULL;

    }

    //store function
    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,

            'category_id' => $this->category_id
        ]);
        session()->flash('message','Brand Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    //fetch data for edit function
    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;

        $this->category_id = $brand->category_id;

    }

    //update function
    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,

            'category_id' => $this->category_id
        ]);
        session()->flash('message','Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    //fetch brand ID for deletion
    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    //delete function
    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message','Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    //read function
    public function render()
    {
        if(!Auth::user()->role_as == '3'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        elseif(!Auth::user()->role_as == '1'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        else{
            $categories = Category::all();
            $brands = Brand::orderBy('id','DESC')->paginate(10);
            return view('livewire.manager.brand.index', ['brands' => $brands, 'categories' => $categories])
                ->extends('layouts.manager')
                ->section('content');
        }

    }
}
