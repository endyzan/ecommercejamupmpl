@extends('admin.layouts.app')


@section('content')
    <div class="p-0 mt-20 w-full overflow-hidden">
        @include('admin.components.dashboard.twin-table')
        <div class="w-full">
            @include('admin.components.dashboard.main-chart-fullver')
        </div>
        <br>
        @include('admin.components.dashboard.table-transaction')
    </div>
@endsection
