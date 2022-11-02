<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\File;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
    public function buyContract(Request $request, $contract_slug){
        $contract = Contract::whereSlug($contract_slug)->firstOrFail();
        $item = new OrderItem();
        $item->item_id = $contract->id;
        $item->item_type = Contract::class;
        $item->item_name = $contract->name;
        $price = $contract->price ;
        return $this->buy($request, $price , [$item] , route('contract', $contract_slug));
    }
    public function buyFile(Request $request, $file_slug){
        $file = File::whereSlug($file_slug)->firstOrFail();
        $item = new OrderItem();
        $item->item_id = $file->id;
        $item->item_type = File::class;
        $item->item_name = $file->name;
        $price = $file->price ;
        return $this->buy($request, $price , [$item] , route('file', $file_slug));
    }

    public function buyPackage(Request $request, $package_slug){
        $package = Package::whereSlug($package_slug)->firstOrFail();
        $items = [] ;
        foreach($package->contracts as $contract){
            $item = new OrderItem();
            $item->item_id = $contract->id;
            $item->item_type = Contract::class;
            $item->item_name = $contract->name;
            $items[] = $item;
        }
        foreach($package->files as $file){
            $item = new OrderItem();
            $item->item_id = $file->id;
            $item->item_type = File::class;
            $item->item_name = $file->name;
            $items[] = $item;
        }
        $price = $package->price ;
        return $this->buy($request, $price , $items , route('package', $package_slug));
    }

    private function buy(Request $request, $amount , array  $Order_items , $rollbackUri)
    {
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->uuid = \Illuminate\Support\Str::uuid();
            $order->user_id = $request->user()->id;
            $order->amount = $amount;
            $order->ip = $request->ip();
            $order->is_paid = 2;
            $order->save();
            foreach ( $Order_items as $item){
                $item->user_id = $order->user_id;
                $item->order_id = $order->id;
                $item->save();
            }
            if ( $request->user()->is_admin ){
                $order->result = "خرید رایگان برای مدیریت وبسایت.";
                $order->is_paid = 1;
                $order->save();
                DB::commit();
                return redirect()->route('payments')->with('flash', 'پرداخت با موفقیت انجام شد.');
            }
            if ( $order->amount == 0 ){
                $order->result = "خرید سرویس رایگان.";
                $order->is_paid = 1;
                $order->save();
                DB::commit();
                return redirect()->route('payments')->with('flash', 'پرداخت با موفقیت انجام شد.');
            }
            $invoice = new Invoice;
            $invoice->amount($order->amount);
            return Payment::callbackUrl(route('callback', $order->uuid))->purchase($invoice, function ($driver, $transactionId) use ($order) {
                $order->trans1 = intval($transactionId);
                $order->save();
                DB::commit();
            })->pay()->render();
        } catch (\Exception $exception) {
            return redirect($rollbackUri)->withErrors([
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
            return redirect()->route('payments_history')->withErrors($exception->getMessage());
        }
    }
}
