{{-- Extends Layout --}}
@extends('layouts.backend')

<?php
$_pageTitle = (isset($addVarsForView['_pageTitle']) && ! empty($addVarsForView['_pageTitle']) ? $addVarsForView['_pageTitle'] : ucwords($resourceTitle));
$_pageSubtitle = (isset($addVarsForView['_pageSubtitle']) && ! empty($addVarsForView['_pageSubtitle']) ? $addVarsForView['_pageSubtitle'] : 'List');
$_listLink = route($resourceRoutesAlias.'.index');
$_createLink = route($resourceRoutesAlias.'.create');

$tableCounter = 0;
$total = 0;
if (count($records) > 0) {
    $total = $records->total();
    $tableCounter = ($records->currentPage() - 1) * $records->perPage();
    $tableCounter = $tableCounter > 0 ? $tableCounter : 0;
}
?>

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    {!! Breadcrumbs::render($resourceRoutesAlias) !!}
@endsection

{{-- Page Title --}}
@section('page-title', $_pageTitle)

{{-- Page Subtitle --}}
@section('page-subtitle', $_pageSubtitle)

{{-- Header Extras to be Included --}}
@section('head-extras')
    @parent
@endsection

@section('content')

    <!-- Default box -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $_pageSubtitle }}</h3>

            <!-- Search -->
            <div class="box-tools pull-right">
                <form class="form" role="form" method="GET" action="{{ $_listLink }}">
                    <div class="input-group input-group-sm margin-r-5 pull-left" style="width: 200px;">
                        <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="Search...">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <a href="{{ $_createLink }}" class="btn btn-sm btn-primary pull-right">
                        <i class="fa fa-plus"></i> <span>Add</span>
                    </a>
                </form>
            </div>
            <!-- END Search -->
        </div>

        @includeIf($resourceAlias.'._search')

        <div class="box-body no-padding">
            @if (count($records) > 0)
                <div class="padding-5">
                    <span class="text-green padding-l-5">Total: {{ $total }} items.</span>&nbsp;
                </div>
                @include($resourceAlias.'.table')
            @else
                <p class="margin-l-5 lead text-green">No records found.</p>
            @endif
        </div>
        <!-- /.box-body -->
        @if (count($records) > 0)
            @include('common.paginate', ['records' => $records])
        @endif

    </div>
    <!-- /.box -->

@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    @include('_resources._list-footer-extras', ['sortByParams' => []])
@endsection
