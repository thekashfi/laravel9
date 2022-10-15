@extends('admin.layout')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between pb-0">
            <h6 class="d-inline-block">سفارش ها</h6>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class=""></th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام قرار داد</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">شماره تماس</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">قیمت</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاریخ</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">وضعیت تراکنش</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">شماره پیگیری</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    #{{ $order->id }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.print' , $order->uuid) }}" target="_blank">
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('images/contract.jpg') }}" class="avatar avatar-sm" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $order->contract_name }}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">{{ $order->user->phone }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $order->amount }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $order->created_at }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="@if($order->is_paid == 2) text-warning @elseif($order->is_paid == 1 ) text-success @else text-danger @endif">
                                    @if($order->is_paid == 2)
                                        در انتظار پرداخت
                                    @elseif($order->is_paid == 1 )
                                        پرداخت شده
                                    @else
                                        پرداخت ناموفق
                                    @endif
                                    </span>
                                    @if($order->is_paid == 0)
                                    <p class="text-xs text-secondary mb-0">{!! nl2br($order->is_paid) !!}</p>
                                    @endif
                                </td>
                                <td>
                                    {{ $order->trans1 }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="px-3">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
