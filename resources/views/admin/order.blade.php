@extends('admin.layout')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between pb-0">
            <h6 class="d-inline-block">آیتم های تراکنش شماره #{{ $order->id }}</h6>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام قرار داد</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نوع قرار داد</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">مشاهده</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    @if ( $item->item_type == \App\Models\Contract::class )
                                        <a href="{{ route('contract',[ $item->item->slug]) }}">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('images/contract.jpg') }}" class="avatar avatar-sm" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->item->name }}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('images/contract.jpg') }}" class="avatar avatar-sm" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->item->name }}</h6>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ( $item->item_type == \App\Models\Contract::class )
                                        متن قرارداد
                                    @else
                                        فایل قرارداد
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ( $item->item_type == \App\Models\Contract::class )
                                        <a href="{{ route('admin.print' , $item->id) }}" target="_blank">
                                            مشاهده
                                        </a>
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
