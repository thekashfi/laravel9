@extends('layout')

@section('content')
    <div class="pt-100"></div>

    <div class="container">
        <h3 class="mb-15">پرداخت های من</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-secondary fw-light border-bottom"></th>
                    <th scope="col" class="text-secondary fw-light border-bottom">نام قرارداد</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">قیمت</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">تاریخ</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">وضعیت تراکنش</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">شماره پیگیری</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->contract_name }}</td>
                        <td>{{ number_format($order->amount, null, '.', ',') }}</td>
                        <td dir="ltr" class="text-end">{{ $order->created_at->toJalali()->format('Y-n-j H:i') }}</td>
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
                    </tr>
                @empty
                    <p class="text-center mb-3">
                        {{ auth()->user()->name }} عزیز، شما هنوز قراردادی ندارید.
                    </p>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
