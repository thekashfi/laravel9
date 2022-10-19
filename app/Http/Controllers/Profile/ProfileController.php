<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Fillable;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Mpdf\Mpdf;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class ProfileController extends Controller
{

    public function boughtItem(Request $request)
    {
        $orderItems = $request->user()->items()->latest()
            ->when($request->id != null , function ($query) use($request){
                $query->where('order_id' , $request->id);
            })
            ->when($request->contract != null , function ($query) use($request){
                $query->where('item_id' , $request->contract)
                    ->where('item_type' , Contract::class);
            })
            ->paginate();
        return view('payments', compact('orderItems'));
    }

    public function orders(Request $request)
    {
        $orders =  $request->user()->orders()->latest()->when($request->id != null , function ($query) use($request){
            $query->where('id' , $request->id);
        })->paginate();
        return view('payments_history', compact('orders'));
    }
}
