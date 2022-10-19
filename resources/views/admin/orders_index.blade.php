@extends('admin.layout')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between pb-0">
            <h6 class="d-inline-block">فاکتور ها</h6>
            <div class="d-inline-block">
                <form>
                    <div class="input-group">
                        <button type="submit" class="input-group-text text-body"><i class="fas fa-search" style="font-family:'Font Awesome 5 Free' !important;" aria-hidden="true"></i></button>
                        <input type="text" name="q" value="{{ request()->query('q') }}" class="form-control" placeholder="جست و جو" onfocus="focused(this)" onfocusout="defocused(this)" style="border-right: 1px solid #d2d6da!important;border-left: 1px solid #d2d6da!important;">
                    </div>
                </form>
            </div>

        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">شماره فاکتور</th>
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
                                <td class="text-center">
                                    <a href="{{ route('admin.order' , $order->uuid) }}">
                                        #{{ $order->id }}
                                    </a>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">{{ $order->user->phone }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('admin.order' , $order->uuid) }}">
                                        <span class="text-secondary text-xs font-weight-bold">{{ number_format($order->amount) }}</span>
                                    </a>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('admin.order' , $order->uuid) }}">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $order->created_at->toJalali()->format('Y/n/j H:i') }}</span>
                                    </a>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('admin.order' , $order->uuid) }}">
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
                                        <p class="text-xs text-secondary mb-0">{!! nl2br($order->result) !!}</p>
                                        @endif
                                    </a>
                                </td>
                                <td class="text-center">
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
