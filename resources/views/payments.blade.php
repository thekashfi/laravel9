@extends('layout')

@section('content')
    <div class="pt-100"></div>

    <div class="container">
        <h3 class="mb-15">قرارداد های من</h3>
        <table class="table">
            {{-- <thead>
                <tr>
                    <th scope="col" class="text-secondary fw-light border-bottom">نام</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">دانلود</th>
                    <th scope="col" class="text-secondary fw-light border-bottom">تاریخ خرید</th>
                </tr>
            </thead> --}}
            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->contract_name }}</td>
                        <td>
                            <a href="{{ route('form', $payment->id) }}" class="btn btn-sm btn-success">دانلود</a>
                        </td>
                        <td>{{ $payment->created_at }}</td>
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
