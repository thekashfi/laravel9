@if(! Session::has('response'))
    <!doctype html>
    <html dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <title>Fillables</title>
        <link id="pagestyle" href="/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="dashboard">
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>اشکالات زیر را برطرف کنید:</strong>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <form method="post" action="" class="p-3 w-100" x-data="{type: null}">
            @csrf

            <input type="hidden" name="contract_id" value="{{ request()->contract_id }}">

            <div class="mb-3 col-md-12">
                <label for="name" class="form-label">نام</label>
                <input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3 col-md-12">
                <label for="name" class="form-label">اعتبار سنجی</label>
                <input name="rules" type="text" class="form-control" id="name" aria-describedby="rulesHelp" value="{{ old('rules') }}">
                <div id="rulesHelp" class="form-text">e.g. min:3|max:20|required</div>
            </div>

            <div class="mb-3 col-md-12">
                <label for="name" class="form-label">توضیحات</label>
                <input name="description" type="text" class="form-control" id="name" value="{{ old('description') }}">
            </div>

            <div class="mb-3 col-md-12">
                <label for="name" class="form-label">نوع</label>
                <select name="type" class="form-select resize-vertical" size="4" x-model="type">
                    <option value="text" selected {{ old('type') == 'text' ? 'selected' : '' }}>متن</option>
                    <option value="number" {{ old('type') == 'number' ? 'selected' : '' }}>عدد</option>
                    <option value="select" {{ old('type') == 'select' ? 'selected' : '' }}>لیست</option>
                    <option value="time" {{ old('type') == 'timestamps' ? 'selected' : '' }}>زمان</option>
                    <option value="date_solar" {{ old('type') == 'date_solar' ? 'selected' : '' }}>تاریخ شمسی</option>
                    <option value="month" {{ old('type') == 'month' ? 'selected' : '' }}>ماه میلادی</option>
                    <option value="date" {{ old('type') == 'date' ? 'selected' : '' }}>تاریخ میلادی</option>
                    <option value="url" {{ old('type') == 'url' ? 'selected' : '' }}>وبگاه</option>
                    <option value="textarea" {{ old('type') == 'textarea' ? 'selected' : '' }}>نایحه متنی</option>
                </select>
            </div>

            <template x-if="type === 'select'">
                <div class="mb-3">
                    <label for="options" class="form-label">گزینه ها</label>
                    <textarea name="options" class="form-control" id="options" rows="3"  aria-describedby="optionsHelp">{{ old('options') }}</textarea>
                    <div id="optionsHelp" class="form-text">هر گزینه را در یک خط وارد کنید.</div>
                </div>
            </template>


            <div class="mb-3 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">افزودن</button>
            </div>
        </form>

        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="/assets/js/argon-dashboard.min.js?v=2.0.4"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </body>
    </html>
@else
    <script>
        window.opener.postMessage(`{!! Session::get('response') !!}`)
        window.close()
    </script>
@endif
