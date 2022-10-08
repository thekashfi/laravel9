<!doctype html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Fillables</title>
    <link id="pagestyle" href="/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="">
    <script>window.opener.postMessage('a message');</script>

    <form class="row p-3 w-100">
        <div class="mb-3 col-md-12">
            <label for="name" class="form-label">نام</label>
            <input name="name" type="text" class="form-control" id="name">
        </div>
        <div class="mb-3 col-md-12">
            <label for="name" class="form-label">اعتبار سنجی</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="validationHelp">
            <div id="emailHelp" class="form-text">e.g. min:3|max:20|required</div>
        </div>
        <div class="mb-3 col-md-12">
            <label for="name" class="form-label">توضیحات</label>
            <input name="name" type="text" class="form-control" id="name">
        </div>
        <div class="mb-3 col-md-12">
            <label for="name" class="form-label">توضیحات</label>
            <input name="name" type="text" class="form-control" id="name">
            <select name="options" class="form-select" size="4">
                <option selected>متن</option>
                <option value="1">عدد</option>
                <option value="2">تاریخ میلادی</option>
                <option value="3">تاریخ شمسی</option>
                <option value="4">فو</option>
                <option value="5">بار</option>
                <option value="6">باز</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">افزودن</button>
    </form>

</body>
</html>
