<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Category;
use App\Models\Brand;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    public function index(Checkin $checkins, Request $request)
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
                return view('users.checkins.index', compact('checkins','categories','brands'));
                break;
        }

    }

    public function checkinsPDF(){
        $role = Auth::user()->role_as;
        switch ($role) {
            case 1:
                return redirect()->back();
                break;

            case 3:
                return redirect()->back();
                break;

            default:
                $checkins = Checkin::all();
                $pdf = PDF::loadView('users.checkins.checkinsPDF', compact('checkins'))->setPaper('legal','landscape');
                return $pdf->download('Checkins.pdf');
                break;
        }

    }
}
