<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Fillable;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Mpdf\Mpdf;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class AdminController extends Controller
{
    public function orders(Request $request)
    {
        $orders = Order::query()->latest()->when($request->has('q') and $request->q != null, function ($query) use ($request) {
            /* @var \Illuminate\Database\Eloquent\Builder $query */
            $query->where('trans1', 'like', '%'.$request->q.'%')
                ->orWhere('id', trim($request->q, '#'))
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('phone', 'like', '%'.$request->q.'%');
                });
        })->paginate(20);

        return view('admin.orders_index', compact('orders'));
    }

    public function order(Request $request, $uuid)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        $items = $order->items;
        return view('admin.order', compact('items' , 'order'));
    }

    public function admin_print(Request $request, $id)
    {
        $order = OrderItem::where('item_type' , Contract::class)->findOrFail($id);
        return view('admin.print', compact('order'));
    }
}
