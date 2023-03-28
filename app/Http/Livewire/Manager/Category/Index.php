<?php

namespace App\Http\Livewire\Manager\Category;

use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id, $name;

     //validation
     public function rules()
     {
         return [
             'name' => 'required|string',
         ];
     }

      //reset input fields
    public function resetInput()
    {
        $this->name = NULL;
        $this->category_id = NULL;
    }

    //store function
    public function storeCategory()
    {
        $validatedData = $this->validate();
        Category::create([
            'name' => $this->name,
        ]);
        session()->flash('message','Category Added Successfully');
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
    public function editCategory(int $category_id)
    {
        $this->category_id = $category_id;
        $category = Category::findOrFail($category_id);
        $this->name = $category->name;
    }

    //update function
    public function updateCategory()
    {
        $validatedData = $this->validate();
        Category::findOrFail($this->category_id)->update([
            'name' => $this->name,
        ]);
        session()->flash('message','Category Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $category = Category::find($this->category_id);
        $category->delete();
        session()->flash('message','Category Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('livewire.manager.category.index',['categories' => $categories]);
    }
}
