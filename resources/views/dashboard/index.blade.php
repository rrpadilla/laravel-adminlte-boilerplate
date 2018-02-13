{{-- Extends Layout --}}
@extends('layouts.backend')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection

{{-- Page Title --}}
@section('page-title', 'Dashboard')

{{-- Page Subtitle --}}
@section('page-subtitle', 'it all starts here')

{{-- Header Extras to be Included --}}
@section('head-extras')

@endsection

@section('content')

    <!-- Small boxes (Stat box) -->
    <div class="row">
    </div>
    <!-- /.row -->

@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')

@endsection
