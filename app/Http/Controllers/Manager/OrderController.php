<?php

namespace App\Http\Controllers\Manager;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public $searchTerm = "";

    public function index(OrderItem $order_items, Request $request)
    {
        if(!Auth::user()->role_as == '3'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        elseif(Auth::user()->role_as == '1'){
            return redirect()->back()->with('error', 'Access denied! You are not a manager');
        }
        else{
            $order_items = OrderItem::where([
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
            return view('manager.orders.index', compact('order_items'));
        }

    }


    public function create()
    {
        return view('manager.orders.create');
    }

    public function store(Request $request, OrderItem $order_items, Product $product)
    {

        $order = Order::create([
            'user_id' => auth()->user()->id
        ]);

        $request->validate([
            'location' => 'required',
            'checkoutdate' => 'required',
            'client' => 'required',
            'drnumber' => 'required',
            'srnumber' => 'required',
            'ponumber' => 'required',
            'sku' => 'required',
            'productcode' => 'required',
            'model' => 'required',
            'quantity' => 'required',
            'uom' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',

        ]);


        $order_id = $order->id;

        $nospaceprodcode = str_replace(' ', '', $request->productcode);
        $nospacesku = str_replace(' ', '', $request->sku);
        $nospacemodel = str_replace(' ', '', $request->model);

        $order_item = new OrderItem();
        $order_item->order_id = $order->id;
        $order_item->location = $request->location;
        $order_item->checkoutdate = $request->checkoutdate;
        $order_item->client = $request->client;
        $order_item->drnumber = $request->drnumber;
        $order_item->srnumber = $request->srnumber;
        $order_item->ponumber = $request->ponumber;
        $order_item->sku = $nospacesku;
        $order_item->productcode = $nospaceprodcode;
        $order_item->model = $nospacemodel;
        $order_item->uom = $request->uom;
        $order_item->itemdescription = $request->itemdescription;
        $order_item->quantity = $request->quantity;
        $order_item->serialnumber = $request->serialnumber;



        $product = Product::where('location', $request->location)->where('model', $nospacemodel)->where('sku', $nospacesku)->where('productcode', $nospaceprodcode)->where('uom', $request->uom)->first();





        if ($product) {
            if ($request->quantity <= $product->quantity) {
                $order_item->save();
                return redirect('/manager/orders')->with('message', 'Stockout Created Successfully');
            } elseif ($request->quantity >= $product->quantity) {
                return redirect('/manager/orders')->with('error', 'Invalid quantity! Not enough stock available.');
            } else {
                return redirect('/manager/orders')->with('error', 'Error!');
            }
        } else {
            return redirect('/manager/orders')->with('error', 'No item exists! Please check item information.');
        }
    }

    // PDF Generation
    public function ordersPDF()
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
                $order_items = OrderItem::all();
                $pdf = PDF::loadView('manager.orders.ordersPDF', compact('order_items'))->setPaper('legal', 'landscape');
                return $pdf->download('checkouts.pdf');
                break;
        }
    }

    // Delete
    public function destroy($id)
    {
        $order_items = OrderItem::findOrFail($id);
        if($order_items){
            $order_items->delete();
            return redirect('/manager/orders')->with('warning', 'Order item deleted!');
        } else{
            return redirect('/manager/orders')->with('error', 'Can\'t delete non-existing item!');

        }
    }

    // Get Item ID for Editing
    public function edit(int $id)
    {

        $order_item = OrderItem::findOrFail($id);
        return view('manager.orders.edit', compact('order_item'));
    }

    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'location' => 'required',
            'checkoutdate' => 'required',
            'client' => 'required',
            'drnumber' => 'required',
            'srnumber' => 'required',
            'ponumber' => 'required',
            'sku' => 'required',
            'productcode' => 'required',
            'model' => 'required',
            'itemdescription' => 'required',
            'serialnumber' => 'required',
        ]);

        $nospaceprodcode = str_replace(' ', '', $request->productcode);
        $nospacesku = str_replace(' ', '', $request->sku);
        $nospacemodel = str_replace(' ', '', $request->model);

        $order_item = OrderItem::find($id);
        $order_item->location = $request->location;
        $order_item->checkoutdate = $request->checkoutdate;
        $order_item->client = $request->client;
        $order_item->drnumber = $request->drnumber;
        $order_item->srnumber = $request->srnumber;
        $order_item->ponumber = $request->ponumber;

        $order_item->sku = $nospacesku;
        $order_item->productcode = $nospaceprodcode;
        $order_item->model = $nospacemodel;
        $order_item->itemdescription = $request->itemdescription;
        $order_item->serialnumber = $request->serialnumber;

        $order_item->save();

        return redirect('/manager/orders')->with('message', 'Stockout Updated Successfully');
    }


    public function generateForm(Request $request, OrderItem $orderItem)
    {
        $validated = $request->input('drnumber');

        if (OrderItem::query()->where('drnumber', 'LIKE', "%{$validated}%")->exists()) {

            $order_items = OrderItem::query()->where('drnumber', 'LIKE', "%{$validated}%")->get();

            $pdf = PDF::loadView('manager.orders.form', compact('order_items'))->setPaper('A4', 'portrait');
            return $pdf->download('delivery_receipt.pdf');
        } else
            return redirect('/manager/orders')->with('error', 'No DR record found!');
    }
}
