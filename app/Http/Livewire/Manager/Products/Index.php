<?php

namespace App\Http\Livewire\Manager\Products;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id, $location, $brand, $model, $sku, $description, $quantity, $productcode, $uom, $status, $category_name;

    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.manager.products.index', ['products' => $products, 'categories' => $categories, 'brands' => $brands]);
    }

    public function inventoryPDF(){
        $products = Product::all();
        $pdf = PDF::loadView('livewire.manager.products.inventoryPDF', compact('products'))->setPaper('legal', 'landscape');
        return $pdf->download('Inventory.pdf');
    }

    // validation
    public function rules()
    {
        return [
            'category_id' => 'required|integer',
            'location' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'sku' => 'required|string',
            'productcode' => 'required|string',
            'uom' => 'required|string',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'status' => 'sometimes:required|integer',

        ];
    }

    //reset input fields
    public function resetInput()
    {
        $this->location = NULL;
        $this->brand = NULL;
        $this->model = NULL;
        $this->sku = NULL;
        $this->productcode = NULL;
        $this->uom = NULL;
        $this->description = NULL;
        $this->quantity = NULL;
        $this->status = NULL;

        $this->category_id = NULL;
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    //store function
    public function storeInventory()
    {
        $nospaceprodcode=str_replace(' ','',$this->productcode);
        $nospacesku = str_replace(' ','',$this->sku);
        $nospacemodel = str_replace(' ','',$this->model);
        Product::create([
            'category_id' => $this->category_id,
            'location' => $this->location,
            'brand' => $this->brand,
            'model' => $nospacemodel,
            'sku' => $nospacesku,
            'productcode' => $nospaceprodcode,
            'uom' => $this->uom,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'status' => $this->status,

        ]);
        session()->flash('message', 'Product Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    //fetch product ID for deletion
    public function deleteProduct($product_id)
    {
        $this->product_id = $product_id;
    }

    //delete function
    public function destroyProduct()
    {
        Product::findOrFail($this->product_id)->delete();
        session()->flash('message', 'Item Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    //fetch data for edit function
    public function editProduct(int $product_id)
    {

        $this->product_id = $product_id;
        $product = Product::findOrFail($product_id);
        $this->category_id = $product->category_id;
        $this->location = $product->location;
        $this->model = $product->model;
        $this->sku = $product->sku;
        $this->productcode = $product->productcode;
        $this->uom = $product->uom;
        $this->brand = $product->brand;
        $this->description = $product->description;
        $this->quantity = $product->quantity;
        $this->status = $product->status;

    }

    //update function
    public function updateProduct()
    {
        $nospaceprodcode=str_replace(' ','',$this->productcode);
        $nospacesku = str_replace(' ','',$this->sku);
        $nospacemodel = str_replace(' ','',$this->model);
        Product::findOrFail($this->product_id)->update([
            'category_id' => $this->category_id,
            'location' => $this->location,
            'brand' => $this->brand,
            'model' => $nospacemodel,
            'sku' => $nospacesku,
            'productcode' => $nospaceprodcode,
            'uom' => $this->uom,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'status' => $this->status,


        ]);
        session()->flash('message', 'Item Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
}
