<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PurchaseReturn;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PurchaseReturnController extends Controller
{
    public function index(PurchaseReturn $purchase_returns, Request $request)
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
            $purchase_returns = PurchaseReturn::where([
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
                return view('admin.purchasereturns.index', compact('purchase_returns'));
                break;
        }
    }


    public function create()
    {
        return view('admin.purchasereturns.create');
    }

    public function store(Request $request, PurchaseReturn $purchase_returns, Product $product)
    {

       // $order = Order::create([
       //     'user_id' => auth()->user()->id
       // ]);

        $request->validate([
            'location' => 'required',
            'checkoutdate' => 'required',
            'client' => 'required',
            'drnumber' => 'required',
            'prsnumber' => 'required',
            'sku' => 'required',
            'productcode' => 'required',
            'model' => 'required',
            'quantity' => 'required',
            'uom' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',

        ]);


       // $order_id = $order->id;

       $nospaceprodcode=str_replace(' ','',$request->productcode);
       $nospacesku = str_replace(' ','',$request->sku);
       $nospacemodel = str_replace(' ','',$request->model);
        $return_slip = new PurchaseReturn();
        //$return_slip->order_id = $order->id;
        $return_slip->location = $request->location;
        $return_slip->checkoutdate = $request->checkoutdate;
        $return_slip->client = $request->client;
        $return_slip->drnumber = $request->drnumber;
        $return_slip->prsnumber = $request->prsnumber;
        $return_slip->sku = $nospacesku;
        $return_slip->productcode = $nospaceprodcode;
        $return_slip->model = $nospacemodel;
        $return_slip->uom = $request->uom;
        $return_slip->itemdescription = $request->itemdescription;
        $return_slip->quantity = $request->quantity;
        $return_slip->serialnumber = $request->serialnumber;



        $product = Product::where('location', $request->location)->where('model', $nospacemodel)->where('sku', $nospacesku)->where('productcode', $nospaceprodcode)->where('uom', $request->uom)->first();





        if ($product) {
            if ($request->quantity <= $product->quantity) {
                $return_slip->save();
                return redirect('/admin/purchasereturns')->with('message', 'Stockout Created Successfully');
            } elseif($request->quantity >= $product->quantity) {
                return redirect('/admin/purchasereturns')->with('error', 'Invalid quantity! Not enough stock available.');
            }else{
                return redirect('/admin/purchasereturns')->with('error', 'Error!');
            }
        } else {
            return redirect('/admin/purchasereturns')->with('error', 'No item exists! Please check item information.');
        }








    }

    // PDF Generation
    public function returnsPDF()
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
                $purchase_returns = PurchaseReturn::all();
                $pdf = PDF::loadView('admin.purchasereturns.purchasereturnsPDF', compact('purchase_returns'))->setPaper('legal', 'landscape');
                return $pdf->download('purchasereturns.pdf');
                break;
        }

    }

    // Delete
    public function destroy($id)
    {
        $purchase_returns = PurchaseReturn::findOrFail($id);


        if ($purchase_returns){
            $purchase_returns->delete();
            return redirect('/admin/purchasereturns')->with('warning', 'Return item deleted!');
        } else{
            return redirect('/admin/purchasereturns')->with('error', 'Can\'t delete non-existing item!');
        }

    }

    // Get Item ID for Editing
    public function edit(int $id)
    {

        $return_slip = PurchaseReturn::findOrFail($id);
        return view('admin.purchasereturns.edit', compact('return_slip'));
    }

    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'location' => 'required',
            'checkoutdate' => 'required',
            'client' => 'required',
            'drnumber' => 'required',
            'prsnumber' => 'required',
            'sku' => 'required',
            'productcode' => 'required',
            'model' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
        ]);


        $nospaceprodcode=str_replace(' ','',$request->productcode);
        $nospacesku = str_replace(' ','',$request->sku);
        $nospacemodel = str_replace(' ','',$request->model);

        $return_slip = PurchaseReturn::find($id);
        $return_slip->location = $request->location;
        $return_slip->checkoutdate = $request->checkoutdate;
        $return_slip->client = $request->client;
        $return_slip->drnumber = $request->drnumber;
        $return_slip->prsnumber = $request->prsnumber;

        $return_slip->sku = $nospacesku;
        $return_slip->productcode = $nospaceprodcode;
        $return_slip->model = $nospacemodel;
        $return_slip->itemdescription = $request->itemdescription;
        $return_slip->serialnumber = $request->serialnumber;

        $return_slip->save();

        return redirect('/admin/purchasereturns')->with('message', 'Stockout Updated Successfully');
    }


    public function generateForm(Request $request, PurchaseReturn $PurchaseReturn)
    {
        $validated = $request->input('drnumber');

        if (PurchaseReturn::query()->where('drnumber', 'LIKE', "%{$validated}%")->exists()) {

            $purchase_returns = PurchaseReturn::query()->where('drnumber', 'LIKE', "%{$validated}%")->get();

            $pdf = PDF::loadView('admin.purchasereturns.form', compact('purchase_returns'))->setPaper('A4', 'portrait');
            return $pdf->download('purchase_return_slip.pdf');
        } else
            return redirect('/admin/purchasereturns')->with('error', 'No DR record found!');
    }

}
