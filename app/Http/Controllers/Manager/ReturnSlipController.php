<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\ReturnSlip;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ReturnSlipController extends Controller
{


    public function index(ReturnSlip $return_slips, Request $request)
    {
        if(!Auth::user()->role_as == '3'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        elseif(Auth::user()->role_as == '1'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        else{
            $return_slips = ReturnSlip::where([
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
            return view('manager.returns.index', compact('return_slips'));
        }

    }


    public function create()
    {
        return view('manager.returns.create');
    }

    public function store(Request $request, ReturnSlip $return_slips, Product $product)
    {

       // $order = Order::create([
       //     'user_id' => auth()->user()->id
       // ]);

        $request->validate([
            'location' => 'required',
            'checkoutdate' => 'required',
            'client' => 'required',
            'drnumber' => 'required',
            'rsnumber' => 'required',
            'sku' => 'required',
            'productcode' => 'required',
            'model' => 'required',
            'quantity' => 'required',
            'uom' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',

        ]);


       // $order_id = $order->id;


        $return_slip = new ReturnSlip();
        $nospaceprodcode=str_replace(' ','',$request->productcode);
        $nospacesku = str_replace(' ','',$request->sku);
        $nospacemodel = str_replace(' ','',$request->model);
        //$return_slip->order_id = $order->id;
        $return_slip->location = $request->location;
        $return_slip->checkoutdate = $request->checkoutdate;
        $return_slip->client = $request->client;
        $return_slip->drnumber = $request->drnumber;
        $return_slip->rsnumber = $request->rsnumber;
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
                return redirect('/manager/returns')->with('message', 'Stockout Created Successfully');
            } elseif($request->quantity >= $product->quantity) {
                return redirect('/manager/returns')->with('error', 'Invalid quantity! Not enough stock available.');
            }else{
                return redirect('/manager/returns')->with('error', 'Error!');
            }
        } else {
            return redirect('/manager/returns')->with('error', 'No item exists! Please check item information.');
        }








    }

    // PDF Generation
    public function returnsPDF()
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 0:
                return redirect()->back();
                break;

            case 1:
                return redirect()->back();
                break;

            default:
                $return_slips = ReturnSlip::all();
                $pdf = PDF::loadView('manager.returns.returnsPDF', compact('return_slips'))->setPaper('legal', 'landscape');
                return $pdf->download('returns.pdf');
                break;
        }

    }

    // Delete
    public function destroy($id)
    {
        $return_slips = ReturnSlip::findOrFail($id);
        if($return_slips){
            $return_slips->delete();
            return redirect('/manager/returns')->with('warning', 'Return item deleted!');
        } else{
            return redirect('/manager/returns')->with('error', 'Can\'t delete non-existing item!');

        }
    }

    // Get Item ID for Editing
    public function edit(int $id)
    {

        $return_slip = ReturnSlip::findOrFail($id);
        return view('manager.returns.edit', compact('return_slip'));
    }

    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'location' => 'required',
            'checkoutdate' => 'required',
            'client' => 'required',
            'drnumber' => 'required',
            'rsnumber' => 'required',
            'sku' => 'required',
            'productcode' => 'required',
            'model' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
        ]);


        $nospaceprodcode=str_replace(' ','',$request->productcode);
        $nospacesku = str_replace(' ','',$request->sku);
        $nospacemodel = str_replace(' ','',$request->model);

        $return_slip = ReturnSlip::find($id);
        $return_slip->location = $request->location;
        $return_slip->checkoutdate = $request->checkoutdate;
        $return_slip->client = $request->client;
        $return_slip->drnumber = $request->drnumber;
        $return_slip->rsnumber = $request->rsnumber;

        $return_slip->sku = $nospacesku;
        $return_slip->productcode = $nospaceprodcode;
        $return_slip->model = $nospacemodel;
        $return_slip->itemdescription = $request->itemdescription;
        $return_slip->serialnumber = $request->serialnumber;
        $return_slip->save();

        return redirect('/manager/returns')->with('message', 'Stockout Updated Successfully');
    }


    public function generateForm(Request $request, ReturnSlip $ReturnSlip)
    {
        $validated = $request->input('drnumber');

        if (ReturnSlip::query()->where('drnumber', 'LIKE', "%{$validated}%")->exists()) {

            $return_slips = ReturnSlip::query()->where('drnumber', 'LIKE', "%{$validated}%")->get();

            $pdf = PDF::loadView('manager.returns.form', compact('return_slips'))->setPaper('A4', 'portrait');
            return $pdf->download('drform.pdf');
        } else
            return redirect('/manager/returns')->with('error', 'No DR record found!');
    }


}
