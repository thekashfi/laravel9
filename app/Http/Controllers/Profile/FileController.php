<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class FileController extends Controller
{
    public function download($uuid , $id)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        Gate::authorize('use-order', $order); // check if order belongs to user && paid
        $item = $order->items()->where('item_type' , File::class)->findOrFail($id);

        if (! $item->item->exists() or $item->item->file == null)
            return redirect()->route('payments')->withErrors('مشکلی در دانلود فایل به وجود آمده است، لطفا با پشتیبانی تماس حاصل کنید!');

        $item->item->file = str_replace('/storage/' , '/app/' , $item->item->file);

        if (! file_exists(storage_path($item->item->file)))
            return redirect()->route('payments')->withErrors('مشکلی در دانلود فایل به وجود آمده است، لطفا با پشتیبانی تماس حاصل کنید!');

        return response()->download(storage_path($item->item->file));
    }
}
