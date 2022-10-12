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
                <tr>
                    <td>قرارداد یک</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success">دانلود</button>
                    </td>
                    <td>1401/11/03</td>
                </tr>
                <tr>
                    <td>Jacob</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success">دانلود</button>
                    </td>
                    <td>1401/11/03</td>
                </tr>
                <tr>
                    <td>Larry the Bird</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success">دانلود</button>
                    </td>
                    <td>1401/11/03</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
