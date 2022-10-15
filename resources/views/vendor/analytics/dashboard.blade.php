@extends('admin.layout')
@section('head')
    <link id="pagestyle" href="{{ asset('/assets/css/tailwind.min.css') }}" rel="stylesheet" />
@endsection
@section('content')

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between pb-0">
            <h6 class="d-inline-block">داشبورد</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="min-h-screen  text-gray-500 flex flex-col" style="text-align: left;direction: ltr">
                <div class="px-4 w-full lg:px-0 sm:max-w-5xl sm:mx-auto">
                    <div class="flex">
                        @include('analytics::data.filter')
                    </div>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @each('analytics::stats.card', $stats, 'stat')
                    </div>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @include('analytics::data.pages-card')
                        @include('analytics::data.sources-card')
                        @include('analytics::data.users-card')
                        @include('analytics::data.devices-card')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const filterButton = document.getElementById('filter-button');
        const filterDropdown = document.getElementById('filter-dropdown');

        filterButton.addEventListener('click', function (e) {
            e.preventDefault();

            filterDropdown.style.display = 'block';
        });

        document.addEventListener('click', function (e) {
            if (!filterButton.contains(e.target) && !filterDropdown.contains(e.target)) {
                filterDropdown.style.display = 'none';
            }
        });
    </script>
@endsection
