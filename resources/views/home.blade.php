@extends('layout', ['title' => 'Home'])

@section('page-content')
    @include('partials.home.main-banners-section')
    @include('partials.home.aboutus-section')
    @include('partials.home.all-products')
    @include('partials.home.mitra-section')
    @include('partials.home.contactus-section')

    @include('partials.chatbox.chatbox')
@endsection
