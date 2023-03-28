<?php

namespace App\Http\Controllers\User;

use App\Models\PurchaseReturn;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    public function index(PurchaseReturn $purchase_returns, Request $request)
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
                return view('users.purchasereturns.index', compact('purchase_returns'));
                break;
        }
    }

    // PDF Generation
    public function returnsPDF()
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
                $purchase_returns = PurchaseReturn::all();
                $pdf = PDF::loadView('users.purchasereturns.purchasereturnsPDF', compact('purchase_returns'))->setPaper('legal', 'landscape');
                return $pdf->download('Purchase-Returns.pdf');
                break;
        }
    }
}
