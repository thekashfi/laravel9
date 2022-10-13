@extends('layout')

@section('content')
    <div class="pt-100"></div>

    <div class="container">
        <h3 class="mb-25">قرارداد های من</h3>
        <table class="table">
            {{-- <thead>
                <tr>
                    <th scope="col" class="text-secondary fw-light border-bottom">نام</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">دانلود</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">تاریخ خرید</th>
                </tr>
            </thead> --}}
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->contract_name }}</td>
                        <td>
                            <a href="{{ route('form', $payment->contract->slug) }}" class="btn btn-sm btn-success">دانلود</a>
                        </td>
                        <td>{{ $payment->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
