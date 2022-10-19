@extends('layout')

@section('content')
    <div class="pt-100"></div>

    <div class="container">
        <h3 class="mb-15">فاکتور ها</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-secondary fw-light border-bottom">شماره فاکتور</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">مبلغ</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">تاریخ</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">وضعیت تراکنش</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">شماره پیگیری</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">مشاهده قراردادها</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ number_format($order->amount) }} تومان</td>
                        <td dir="ltr" class="text-end">{{ $order->created_at->toJalali()->format('Y/n/j H:i') }}</td>
                        <td class="align-middle">
                            <span class="@if($order->is_paid == 2) text-warning @elseif($order->is_paid == 1 ) text-success @else text-danger @endif">
                                @if($order->is_paid == 2)
                                        در انتظار پرداخت
                                @elseif($order->is_paid == 1 )
                                    پرداخت شده
                                @else
                                    پرداخت ناموفق
                                @endif
                            </span>
                        </td>
                        <td>
                            {{ $order->trans1 }}
                        </td>
                        <td>
                        @if($order->is_paid == 1 )
                                <a href="{{ route('payments' , ['id' => $order->id]) }}">مشاهده</a>
                        @else
                            --
                        @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <p class="text-center m-3 text-danger">
                                سفارش برای درخواست شما یافت نشد!
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3 mb-3" style="direction: ltr;">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
