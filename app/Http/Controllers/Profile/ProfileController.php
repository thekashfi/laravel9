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

    public function boughtItem()
    {
        $orders = Order::with('contract')->whereUserId(auth()->id())->whereIsPaid(1)->latest()->get();

        return view('payments', compact('orders'));
    }

    public function orders()
    {
        $orders = Order::with('contract')->whereUserId(auth()->id())->latest()->get();

        return view('payments_history', compact('orders'));
    }
}
