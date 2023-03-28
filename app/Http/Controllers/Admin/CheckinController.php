<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Checkin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CheckinController extends Controller
{
    //

    public function index(Checkin $checkins, Request $request)
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:

                $categories = Category::all();
                $brands = Brand::all();

                $checkins = Checkin::where([
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
                return view('admin.checkin.index', compact('checkins','categories','brands'));
                break;
        }

    }


    public function create(Category $categories, Brand $brands)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.checkin.create',compact('categories','brands'));
    }

    public function edit(int $id){

        $checkin = Checkin::findOrFail($id);
        return view('admin.checkin.edit', compact('checkin'));
    }

    public function store(Request $request, Product $product){

        $request->validate([
            'location' => 'required',
            'checkindate' => 'required',
            'category_id' => 'required',
            'ponumber' => 'required',
            'strnumber' => 'required',
            'brand' => 'required',
            'productcode' => 'required',
            'sku' => 'required',
            'model' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
            'quantity' => 'required',
            'uom' => 'required',
            'status' => 'required',
            'remarks' => 'required',

        ]);
        $nospaceprodcode=str_replace(' ','',$request->productcode);
        $nospacesku = str_replace(' ','',$request->sku);
        $nospacemodel = str_replace(' ','',$request->model);

       $checkin = new Checkin();
        $checkin->location = $request->location;
        $checkin->checkindate = $request->checkindate;
        $checkin->category_id = $request->category_id;
        $checkin->ponumber = $request->ponumber;
        $checkin->strnumber = $request->strnumber;
        $checkin->brand = $request->brand;
        $checkin->productcode = $nospaceprodcode;
        $checkin->sku = $nospacesku;
        $checkin->model = $nospacemodel;
        $checkin->itemdescription = $request->itemdescription;
        $checkin->serialnumber = $request->serialnumber;
        $checkin->quantity = $request->quantity;
        $checkin->uom = $request->uom;
        $checkin->status = $request->status;
        $checkin->remarks = $request->remarks;
//Product::query()->where('sku', 'LIKE', "%$request->sku%")->exists()

$product = Product::where('location', $request->location)->where('category_id', $request->category_id)->where('brand', $request->brand)->where('model', $nospacemodel)->where('sku', $nospacesku)->where('productcode', $nospaceprodcode)->where('uom', $request->uom)->first();

    if($product){
        if($request->quantity >= 1){
            $checkin->save();
            return redirect('/admin/checkins')->with('message', 'Item Checked-in!');
        } else{
            return redirect('/admin/checkins')->with('error', 'Invalid quantity!');

    }

    } else {
        return redirect('/admin/checkins')->with('error', 'No item exists! Please check the item information.');

    }

    //OrderItem::query()->where('stonumber', 'LIKE', "%{$validated}%")->exists()

        //Checkin::create($request->post());


    }

    public function update(Request $request, $id){
        $request->validate([
            'location' => 'required',
            'checkindate' => 'required',
            'category_id' => 'required',
            'brand' => 'required',
            'productcode' => 'required',
            'ponumber' => 'required',
            'strnumber' => 'required',

            'sku' => 'required',
            'model' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
            'quantity' => 'required',
            'uom' => 'required',
            'status' => 'required',
            'remarks' => 'required',

        ],[

        ]);

        $checkin = Checkin::find($id);

        $nospaceprodcode=str_replace(' ','',$request->productcode);
        $nospacesku = str_replace(' ','',$request->sku);
        $nospacemodel = str_replace(' ','',$request->model);

        $checkin->location = $request->location;
        $checkin->checkindate = $request->checkindate;
        $checkin->category_id = $request->category_id;
        $checkin->ponumber = $request->ponumber;
        $checkin->strnumber = $request->strnumber;

        $checkin->brand = $request->brand;
        $checkin->productcode = $nospaceprodcode;
        $checkin->sku = $nospacesku;
        $checkin->model = $nospacemodel;
        $checkin->itemdescription = $request->itemdescription;
        $checkin->serialnumber = $request->serialnumber;
        $checkin->quantity = $request->quantity;
        $checkin->uom = $request->uom;
        $checkin->status = $request->status;
        $checkin->remarks = $request->remarks;

        $checkin->save();

        return redirect('/admin/checkins')->with('message', 'Item updated!');

    }

    public function destroy($id){

        $checkin = Checkin::findOrFail($id);

        if($checkin){
            $checkin->delete();
            return redirect('/admin/checkins')->with('warning', 'Check-in item deleted!');

        } else{
            return redirect('/admin/checkins')->with('error', 'Can\'t delete non-existing item!');

        }

    }


    public function checkinsPDF(){
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
                $checkins = Checkin::all();
                $pdf = PDF::loadView('admin.checkin.checkinsPDF', compact('checkins'))->setPaper('legal','landscape');
                return $pdf->download('checkins.pdf');
                break;
        }


    }



}
