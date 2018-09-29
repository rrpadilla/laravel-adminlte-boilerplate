<div class="box-footer clearfix">
    <!-- Pagination -->
    <div class="pull-right">
        <div class="no-margin text-center">
            {!! $records->appends(request()->query())->render() !!}
        </div>
    </div>
    <!-- / End Pagination -->
</div>
<!-- /.box-footer -->
