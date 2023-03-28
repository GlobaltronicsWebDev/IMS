<?php

namespace App\Http\Controllers\User;

use App\Models\ReturnSlip;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class ReturnSlipController extends Controller
{

    public function index(ReturnSlip $return_slips, Request $request)
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
                return view('users.returns.index', compact('return_slips'));
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
                $return_slips = ReturnSlip::all();
                $pdf = PDF::loadView('users.returns.returnsPDF', compact('return_slips'))->setPaper('legal', 'landscape');
                return $pdf->download('Returns.pdf');
                break;
        }
    }
}
