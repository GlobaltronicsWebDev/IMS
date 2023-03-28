<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Exports\ordersExport;
use Illuminate\Support\Carbon;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use function PHPUnit\Framework\isTrue;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $location, $checkoutdate, $client, $stonumber, $srfnumber, $sku, $productcode, $model, $quantity,
    $uom, $itemdescription, $serialnumber;

    public function render(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::where([
            //['location', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('location', 'LIKE', '%' . $term . '%')
                    ->orWhere('brand', 'LIKE', '%' . $term . '%')
                    ->orWhere('model', 'LIKE', '%' . $term . '%')
                    ->orWhere('sku', 'LIKE', '%' . $term . '%')
                    ->orWhere('description', 'LIKE', '%' . $term . '%')
                    ->orWhere('productcode', 'LIKE', '%' . $term . '%')
                    ->orWhere('uom', 'LIKE', '%' . $term . '%')
                    ->orWhere('status', 'LIKE', '%' . $term . '%')

                    ->get();
                }
            }]
        ])->paginate(10);

        return view('livewire.admin.products.index',['products' => $products, 'categories' => $categories, 'brands' => $brands]);
    }

    //reset input fields
    public function resetInput()
    {
        $this->location = NULL;
        $this->checkoutdate = NULL;
        $this->client = NULL;
        $this->stonumber = NULL;
        $this->srfnumber = NULL;
        $this->sku = NULL;
        $this->productcode = NULL;
        $this->model = NULL;
        $this->quantity = NULL;
        $this->uom = NULL;
        $this->itemdescription = NULL;
        $this->serialnumber = NULL;
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function rules()
    {
        return [
            'location' => 'required|string',
            'checkoutdate' => 'required|string',
            'client' => 'required|string',
            'stonumber' => 'required|string',
            'srfnumber' => 'required|string',
            'addmore.*.sku' => 'required|string',
            'addmore.*.productcode' => 'required|string',
            'addmore.*.model' => 'required|string',
            'addmore.*.quantity' => 'required|string',
            'addmore.*.uom' => 'required|string',
            'addmore.*.itemdescription' => 'required|string',
            'addmore.*.serialnumber' => 'required|string',
        ];
    }

     //store function
     public function storeOrder(Request $request, OrderItem $order_items)
     {
        // Create Order
        $order = Order::create([
            'user_id' => auth()->user()->id
        ]);

        foreach ($request->addmore as $key => $value) {
            //OrderItem::insert(['order_id'=>$order->id]);
            //OrderItem::create( ['order_id'=>$order->id],[$value]);
            // OrderItem::create($value);
            $order_id = $order->id;
            OrderItem::create([
                    'order_id' => $this->$order_id,
                    'location' => $this->$request->location,
                    'checkoutdate' => $this->$request->checkoutdate,
                    'client' => $this->$request->client,
                    'stonumber' => $this->$request->stonumber,
                    'srfnumber' => $this->$request->srfnumber,
                    'sku' => $this->$value['sku'],
                    'productcode' => $this->$value['productcode'],
                    'model' => $this->$value['model'],
                    'uom' => $this->$value['uom'],
                    'itemdescription' => $this->$value['itemdescription'],
                    'serialnumber' => $this->$value['serialnumber'],
                    'quantity' => $this->$value['quantity']
                ]);
            session()->flash('message','Product Added Successfully');
            $this->dispatchBrowserEvent('close-modal');
            $this->resetInput();
        }
     }
}
