{{-- @extends('admin.layouts.app
{{-- @extends('admin/adminlayout') --}}
@extends('admin.layouts.app')


{{-- @section('container') --}}
@section('content')
    <div class="p-0 mt-20 w-full overflow-hidden">
        {{-- Load Alert --}}
        @include('components.flowbite-alert')
        <div class="w-full">
            <!-- Main widget -->
            @include('admin.components.dashboard.main-chart')
        </div>
        <br>
        {{-- @include('admin.components.dashboard.twin-table') --}}
        @include('admin.components.dashboard.table-transaction')
    </div>
@endsection
