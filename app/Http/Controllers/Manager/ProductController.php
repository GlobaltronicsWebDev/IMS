<?php

namespace App\Http\Controllers\Manager;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index( Request $request)
    {
        if(!Auth::user()->role_as == '3'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        elseif(Auth::user()->role_as =='1'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        } else{
            $products = Product::where([
                //['location', '!=', Null],
                [function ($query) use ($request) {
                    if (($term = $request->term)) {
                        $query->orWhere('location', 'LIKE', '%' . $term . '%')
                        ->orWhere('model', 'LIKE', '%' . $term . '%')
                        ->orWhere('sku', 'LIKE', '%' . $term . '%')
                        ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                        ->orWhere('uom', 'LIKE', '%' . $term . '%')

                        ->get();
                    }
                }]
            ])->paginate(10);
            return view('manager.products.index', compact('products'));
        }

    }

    public function inventoryPDF(){
        $role = Auth::user()->role_as;
        switch ($role) {
            case 0:
                return redirect()->back();
                break;

            case 1:
                return redirect()->back();
                break;

            default:
                $products = Product::all();
                $pdf = PDF::loadView('livewire.manager.products.inventoryPDF', compact('products'))->setPaper('legal', 'landscape');
                return $pdf->download('Inventory.pdf');
                break;
        }
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('manager.products.create', compact('categories','brands'));
    }

    //store function
    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        //create data
       $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'location' => $validatedData['location'],
            'brand' => $validatedData['brand'],
            'model' => $validatedData['model'],
            'sku' => $validatedData['sku'],
            'productcode' => $validatedData['productcode'],
            'uom' => $validatedData['uom'],

            'description' => $validatedData['description'],
            'quantity' => $validatedData['quantity'],
        ]);

        return redirect('/manager/products')->with('message', 'Product Added Successfully');
    }

    public function edit(int $product_id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id);
        return view('manager.products.edit', compact('categories','brands','product'));
    }

    //Updated data
    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])
                        ->products()->where('id',$product_id)->first();
        if($product)
        {
            $product->update([
            'category_id' => $validatedData['category_id'],
            'location' => $validatedData['location'],
            'brand' => $validatedData['brand'],
            'model' => $validatedData['model'],
            'sku' => $validatedData['sku'],
            'productcode' => $validatedData['productcode'],
            'uom' => $validatedData['uom'],
            'description' => $validatedData['description'],
            'quantity' => $validatedData['quantity'],
            ]);
            return redirect('/manager/products')->with('message', 'Product Updated Successfully');
        }
        else
        {
            return redirect('manager/products')->with('message','No Such Product Id Found');
        }
    }

    public function destroy(int $product_id)
    {
       $product = Product::findOrFail($product_id);

       $product->delete();
       return redirect()->back()->with('message','Product Deleted!');
    }

}
