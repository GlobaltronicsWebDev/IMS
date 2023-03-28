<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Borrower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class BorrowerController extends Controller
{

    public function index(Borrower $borrowers, Request $request)
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
            $borrowers = Borrower::where([
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
                return view('admin.borrowers.index', compact('borrowers'));
                break;
        }
    }


    public function create()
    {
        return view('admin.borrowers.create');
    }

    public function store(Request $request, Borrower $borrowers, Product $product)
    {
        $request->validate([
            'location' => 'required',
            'checkoutdate' => 'required',
            'client' => 'required',
            'brnumber' => 'required',
            'dateofreturn' => 'required',
            'sku' => 'required',
            'productcode' => 'required',
            'model' => 'required',
            'quantity' => 'required',
            'uom' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',

        ]);


       // $order_id = $order->id;


        $return_slip = new Borrower();
        $nospaceprodcode=str_replace(' ','',$request->productcode);
        $nospacesku = str_replace(' ','',$request->sku);
        $nospacemodel = str_replace(' ','',$request->model);
        //$return_slip->order_id = $order->id;
        $return_slip->location = $request->location;
        $return_slip->checkoutdate = $request->checkoutdate;
        $return_slip->client = $request->client;
        $return_slip->brnumber = $request->brnumber;
        $return_slip->dateofreturn = $request->dateofreturn;
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
                return redirect('/admin/borrowers')->with('message', 'Stockout Created Successfully');
            } elseif($request->quantity >= $product->quantity) {
                return redirect('/admin/borrowers')->with('error', 'Invalid quantity! Not enough stock available.');
            }else{
                return redirect('/admin/borrowers')->with('error', 'Error!');
            }
        } else {
            return redirect('/admin/borrowers')->with('error', 'No item exists! Please check item information.');
        }








    }

    // PDF Generation
    public function borrowersPDF()
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
                $borrowers = Borrower::all();
                $pdf = PDF::loadView('admin.borrowers.borrowersPDF', compact('borrowers'))->setPaper('legal', 'landscape');
                return $pdf->download('borrowers.pdf');
                break;
        }
    }

    // Delete
    public function destroy($id)
    {
        $borrowers = Borrower::findOrFail($id);

        if($borrowers){
            $borrowers->delete();
            return redirect('/admin/borrowers')->with('warning', 'Return item deleted!');

        } else {
            return redirect('/admin/borrowers')->with('error', 'Can\'t delete non-existing item!');

        }


    }

    // Get Item ID for Editing
    public function edit(int $id)
    {

        $return_slip = Borrower::findOrFail($id);
        return view('admin.borrowers.edit', compact('return_slip'));
    }

    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'location' => 'required',
            'checkoutdate' => 'required',
            'client' => 'required',
            'brnumber' => 'required',
            'dateofreturn' => 'required',
            'sku' => 'required',
            'productcode' => 'required',
            'model' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
        ]);

        $return_slip = Borrower::find($id);

        $nospaceprodcode=str_replace(' ','',$request->productcode);
        $nospacesku = str_replace(' ','',$request->sku);
        $nospacemodel = str_replace(' ','',$request->model);

        $return_slip->location = $request->location;
        $return_slip->checkoutdate = $request->checkoutdate;
        $return_slip->client = $request->client;
        $return_slip->brnumber = $request->brnumber;
        $return_slip->dateofreturn = $request->dateofreturn;

        $return_slip->sku = $nospacesku;
        $return_slip->productcode = $nospaceprodcode;
        $return_slip->model = $nospacemodel;
        $return_slip->itemdescription = $request->itemdescription;
        $return_slip->serialnumber = $request->serialnumber;

        $return_slip->save();

        return redirect('/admin/borrowers')->with('message', 'Stockout Updated Successfully');
    }


    public function generateForm(Request $request, Borrower $Borrower)
    {
        $validated = $request->input('brnumber');

        if (Borrower::query()->where('brnumber', 'LIKE', "%{$validated}%")->exists()) {

            $borrowers = Borrower::query()->where('brnumber', 'LIKE', "%{$validated}%")->get();

            $pdf = PDF::loadView('admin.borrowers.form', compact('borrowers'))->setPaper('A4', 'portrait');
            return $pdf->download('borrowers_slip.pdf');
        } else
            return redirect('/admin/borrowers')->with('error', 'No BR record found!');
    }


}
