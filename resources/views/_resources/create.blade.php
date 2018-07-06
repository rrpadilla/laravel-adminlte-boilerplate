{{-- Extends Layout --}}
@extends('layouts.backend')

<?php
$_pageTitle = (isset($addVarsForView['_pageTitle']) && !empty($addVarsForView['_pageTitle']) ? $addVarsForView['_pageTitle'] : ucwords($resourceTitle));
$_pageSubtitle = (isset($addVarsForView['_pageSubtitle']) && !empty($addVarsForView['_pageSubtitle']) ? $addVarsForView['_pageSubtitle'] : "Add " . str_singular($_pageTitle));
$_formFiles = isset($addVarsForView['formFiles']) ? $addVarsForView['formFiles'] : false;
$_listLink = route($resourceRoutesAlias.'.index');
$_createLink = route($resourceRoutesAlias.'.create');
$_storeLink = route($resourceRoutesAlias.'.store');
?>

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    {!! Breadcrumbs::render($resourceRoutesAlias.'.create') !!}
@endsection

{{-- Page Title --}}
@section('page-title', $_pageTitle)

{{-- Page Subtitle --}}
@section('page-subtitle', $_pageSubtitle)

{{-- Header Extras to be Included --}}
@section('head-extras')

@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <!-- Edit Form -->
            <div class="box box-info" id="wrap-edit-box">

                <form class="form" role="form" method="POST" action="{{ $_storeLink }}" {!! $_formFiles === true ? 'enctype="multipart/form-data"' : '' !!}>
                    {{ csrf_field() }}

                    {{ redirect_back_field() }}

                    <div class="box-header with-border">
                        <h3 class="box-title">Add new</h3>

                        <div class="box-tools">
                            <a href="{{ $_listLink }}" class="btn btn-sm btn-primary margin-r-5 margin-l-5">
                                <i class="fa fa-search"></i> <span>List</span>
                            </a>
                            <a href="{{ $_createLink }}" class="btn btn-sm btn-primary margin-r-5 margin-l-5">
                                <i class="fa fa-plus"></i> <span>Add</span>
                            </a>
                            <button class="btn btn-sm btn-info margin-r-5 margin-l-5">
                                <i class="fa fa-save"></i> <span>Save</span>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        @include($resourceAlias.'.form')
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <!-- Edit Button -->
                        <div class="col-xs-6">
                            <div class="text-center margin-b-5 margin-t-5">
                                <button class="btn btn-info">
                                    <i class="fa fa-save"></i> <span>Save</span>
                                </button>
                            </div>
                        </div>
                        <!-- /.col-xs-6 -->
                        <div class="col-xs-6">
                            <div class="text-center margin-b-5 margin-t-5">
                                <a href="{{ $_listLink }}" class="btn btn-default">
                                    <i class="fa fa-ban"></i> <span>Cancel</span>
                                </a>
                            </div>
                        </div>
                        <!-- /.col-xs-6 -->
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
            <!-- /End Edit Form -->
        </div>
    </div>
    <!-- /.row -->
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    
@endsection
