@extends('admin.layout')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between pb-0">
            <h6 class="d-inline-block">قرارداد ها</h6>
            <a class="btn bg-gradient-dark mb-0 d-inline-block" href="{{ route('admin.contract.create') }}"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;افزودن قرارداد</a>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">متن قرارداد</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">قیمت</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">فعال</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contracts as $contract)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ asset('images/contract.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $contract->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ Str::limit(strip_tags($contract->description), 20) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">{{ Str::limit(strip_tags($contract->text), 30) }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ number_format($contract->price) }} تومان</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($contract->is_active)
                                        <span class="badge badge-sm bg-gradient-success">فعال</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-secondary">غیرفعال</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.contract.edit', $contract->id) }}" class="text-secondary font-weight-bold text-xs mx-1" data-toggle="tooltip" data-original-title="Edit user">
                                        ویرایش
                                    </a>
{{--                                    <form method="post" action="{{ route('admin.contract.destroy', $contract->id) }}" onsubmit="return confirm('از حذف {{ $contract->name }} مطمئن هستید؟')" class="d-inline-block">--}}
{{--                                        @csrf--}}
{{--                                        @method('delete')--}}
{{--                                        <button href="{{ route('admin.contract.edit', $contract->id) }}" class="text-warning bg-body border-0 font-weight-bold text-xs mx-1" data-toggle="tooltip" type="submit">--}}
{{--                                            حذف--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-3">
            {{ $contracts->links() }}
        </div>
    </div>
@endsection
