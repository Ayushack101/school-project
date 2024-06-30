@extends('layouts/commonMaster')

@section('layoutContent')

<div class="wrapper">
    {{-- Sidebar --}}
    @include('layouts.sidebar.sidebar')

    <div class="main-panel">
        {{-- Navbar --}}
        @include('layouts.header.header')

        {{-- Main Content --}}
        @yield('content')
        {{-- Footer --}}
        @include('layouts.footer.footer')
    </div>
</div>
@endsection

{{-- @stack('scripts') --}}