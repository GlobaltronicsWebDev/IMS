<?php

namespace App\Http\Controllers\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 1:
                return redirect()->back();
                break;

            case 3:
                return redirect()->back();
                break;

            default:
                $categories = Category::all();
                $brands = Brand::all();
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
                return view('users.products.index', compact('products','categories','brands'));
                break;
        }
    }

    public function inventoryPDF(){
        $role = Auth::user()->role_as;
        switch ($role) {
            case 1:
                return redirect()->back();
                break;

            case 3:
                return redirect()->back();
                break;

            default:
                $products = Product::all();
                $pdf = PDF::loadView('users.products.inventoryPDF', compact('products'))->setPaper('legal', 'landscape');
                return $pdf->download('Inventory.pdf');
                break;
        }
    }
}
