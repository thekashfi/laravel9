@extends('admin.layout')

@section('content')
    <div class="card mb-4">

        <div class="card-header d-flex justify-content-between pb-0">
            <h6 class="d-inline-block">دسته بندی ها</h6>
            <a class="btn bg-gradient-dark mb-0 d-inline-block" href="{{ route('admin.category.create') }}"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;افزودن دسته بندی</a>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تعداد قرارداد</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تعداد فایل</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تعداد پکیج ها</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نمایش در منو</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نمایش در</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
{{--                                        <div>--}}
{{--                                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">--}}
{{--                                        </div>--}}
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $category->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-center text-xs font-weight-bold mb-0">{{ $category->contracts_count }}</p>
                                </td>
                                <td>
                                    <p class="text-center text-xs font-weight-bold mb-0">{{ $category->files_count }}</p>
                                </td>
                                <td>
                                    <p class="text-center text-xs font-weight-bold mb-0">{{ $category->packages_count }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($category->in_menu)
                                        <span class="badge badge-sm bg-gradient-success">بله</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-secondary">خیر</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($category->hidden)
                                        <span class="badge badge-sm bg-gradient-success">فقط پکیج</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-secondary">پکیج و منو وبسایت</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                        ویرایش
                                    </a>
                                    <form method="post" action="{{ route('admin.category.destroy', $category->id) }}" onsubmit="return confirm('از حذف {{ $category->name }} مطمئن هستید؟')" class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button href="{{ route('admin.category.edit', $category->id) }}" class="text-warning bg-body border-0 font-weight-bold text-xs mx-1" data-toggle="tooltip" type="submit">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
    </div>
@endsection
