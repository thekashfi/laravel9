@extends('layout')

@section('content')
    <div class="pt-100"></div>

    <div class="container">
        <h3 class="mb-15">قرارداد های من</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-secondary fw-light border-bottom">عنوان قرارداد</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">نوع قرارداد</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">دانلود</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">شماره فاکتور</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">تاریخ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orderItems as $item)
                    <tr>
                        <td>
                            @if ( $item->item_type == \App\Models\Contract::class )
                                <a href="{{ route('contract',[ $item->item->slug]) }}">
                                    {{ $item->item->name }}
                                </a>
                            @else
                                <a href="{{ route('file',[ $item->item->slug]) }}">
                                    {{ $item->item_name }}
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ( $item->item_type == \App\Models\Contract::class )
                                متن قرارداد
                            @else
                                فایل قرارداد
                            @endif
                        </td>
                        <td>
                            @if ( $item->item_type == \App\Models\Contract::class )
                                @if( !empty($item->item_text))
                                    <a href="{{ route('downloadContract',[ $item->order->uuid ,  $item->id]) }}" class="btn btn-sm btn-success">
                                        دانلود
                                    </a>
                                    <a href="{{ route('form',[ $item->order->uuid ,  $item->id]) }}" class="btn btn-sm btn-warning">
                                        ویرایش و دانلود مجدد
                                    </a>
                                @else
                                    <a href="{{ route('form',[ $item->order->uuid ,  $item->id]) }}" class="btn btn-sm btn-success">
                                        تکمیل و دانلود قرارداد
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('downloadContract',[ $item->order->uuid ,  $item->id]) }}" class="btn btn-sm btn-success">
                                    دانلود فایل
                                </a>
                            @endif
                        </td>
                        <td dir="ltr" class="text-end">
                            <a href="{{ route('payments_history' , ['id' => $item->order_id]) }}">#{{ $item->order_id }}</a>
                        </td>
                        <td dir="ltr" class="text-end">{{ $item->created_at->toJalali()->format('Y/n/j H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <p class="text-center m-3 text-danger">
                                قراردادی برای درخواست شما یافت نشد!
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3 mb-3" style="direction: ltr;">
            {{ $orderItems->links() }}
        </div>
    </div>
@endsection
