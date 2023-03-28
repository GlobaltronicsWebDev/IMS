<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Borrower;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class BorrowerController extends Controller
{

    public function index(Borrower $borrowers, Request $request)
    {
        if(!Auth::user()->role_as == '3'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        elseif(Auth::user()->role_as == '1'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        else{
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
            return view('manager.borrowers.index', compact('borrowers'));
        }

    }


    public function create()
    {
        return view('manager.borrowers.create');
    }

    public function store(Request $request, Borrower $borrowers, Product $product)
    {

       // $order = Order::create([
       //     'user_id' => auth()->user()->id
       // ]);

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
                return redirect('/manager/borrowers')->with('message', 'Stockout Created Successfully');
            } elseif($request->quantity >= $product->quantity) {
                return redirect('/manager/borrowers')->with('error', 'Invalid quantity! Not enough stock available.');
            }else{
                return redirect('/manager/borrowers')->with('error', 'Error!');
            }
        } else {
            return redirect('/manager/borrowers')->with('error', 'No item exists! Please check item information.');
        }








    }

    // PDF Generation
    public function borrowersPDF()
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
                $borrowers = Borrower::all();
                $pdf = PDF::loadView('manager.borrowers.borrowersPDF', compact('borrowers'))->setPaper('legal', 'landscape');
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
            return redirect('/manager/borrowers')->with('warning', 'Return item deleted!');
        } else {
            return redirect('/manager/borrowers')->with('error', 'Can\'t delete non-existing item!');
        }

    }

    // Get Item ID for Editing
    public function edit(int $id)
    {

        $return_slip = Borrower::findOrFail($id);
        return view('manager.borrowers.edit', compact('return_slip'));
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

        return redirect('/manager/borrowers')->with('message', 'Stockout Updated Successfully');
    }


    public function generateForm(Request $request, Borrower $Borrower)
    {
        $validated = $request->input('brnumber');

        if (Borrower::query()->where('brnumber', 'LIKE', "%{$validated}%")->exists()) {

            $borrowers = Borrower::query()->where('brnumber', 'LIKE', "%{$validated}%")->get();

            $pdf = PDF::loadView('manager.borrowers.form', compact('borrowers'))->setPaper('A4', 'portrait');
            return $pdf->download('borrowers_slip.pdf');
        } else
            return redirect('/manager/borrowers')->with('error', 'No BR record found!');
    }


}
