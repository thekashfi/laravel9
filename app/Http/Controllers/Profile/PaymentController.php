<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
    public function buy(Request $request, $contract_slug)
    {
        $contract = Contract::whereSlug($contract_slug)->firstOrFail();
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->uuid = \Illuminate\Support\Str::uuid();
            $order->user_id = auth()->id();
            $order->contract_id = $contract->id;
            $order->contract_name = $contract->name;
            $order->amount = $contract->price;
            $order->ip = $request->ip();
            $order->is_paid = 2;
            $order->save();
            $invoice = new Invoice;
            $invoice->amount($contract->price);
            $invoice->detail('Title', $contract->name);
            return Payment::callbackUrl(route('callback', $order->uuid))->purchase($invoice, function ($driver, $transactionId) use ($order) {
                $order->trans1 = $transactionId;
                $order->save();
                DB::commit();
            })->pay()->render();
        } catch (\Exception $exception) {
            return redirect()->route('contract', $contract_slug)->withErrors([
                "لطفا مجددا تلاش نمایید!"
            ]);
        }
    }

    public function callback(Request $request, $uuid)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        try {
            if ($order->is_paid == 2) {
                DB::beginTransaction();
                $receipt = Payment::amount($order->amount)->transactionId($request->Authority)->verify();
                $order->trans1 = intval($order->trans1);
                $order->trans2 = $receipt->getReferenceId();
                $order->result = "پرداخت تکمیل و با موفقیت انجام شده است";
                $order->is_paid = 1;
                $order->save();
                DB::commit();
                return redirect()->route('payments')->with('flash', 'پرداخت با موفقیت انجام شد.');
            }
            return redirect()->route('payments')->withErrors('فاکتور مد نظر قبلا پرداخت شده است!');
        } catch (InvalidPaymentException|\Exception $exception) {
            DB::rollBack();
            $order->result = ($order->result != null ? $order->result . PHP_EOL : '') . $exception->getMessage();
            $order->is_paid = 0;
            $order->save();
            return redirect()->route('payments')->withErrors($exception->getMessage());
        }
    }
}
