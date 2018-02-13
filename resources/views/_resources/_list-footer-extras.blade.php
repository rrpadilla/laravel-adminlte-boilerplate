<!-- Delete Confirm - Helper. Show a modal box -->
<div id="modalConfirmModelDelete" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="modalConfirmModelDeleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalConfirmModelDeleteLabel">Are you sure <i class="fa fa-question"></i>
                </h4>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to delete this item<i class="fa fa-question"></i></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnModalConfirmModelDelete" data-form-id="">Confirm
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnModalCancelModelDelete">
                    Cancel
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Page scripts -->

{{-- Initiate Confirm Delete --}}
<script type="text/javascript">
    $(function () {
        $(document).on('click', '.btnOpenerModalConfirmModelDelete', function (e) {
            e.preventDefault();
            var formId = $(this).attr('data-form-id');
            var btnConfirm = $('#modalConfirmModelDelete').find('#btnModalConfirmModelDelete');
            if (btnConfirm.length) {
                btnConfirm.attr('data-form-id', formId);
            }
            $('#modalConfirmModelDelete').modal('show');
        });
        // Modal Button Confirm Delete
        $(document).on('click', '#btnModalConfirmModelDelete', function (e) {
            e.preventDefault();
            var formId = $(this).attr('data-form-id');
            var form = $(document).find('#' + formId);
            if (form.length) {
                form.submit();
            }
            $('#modalConfirmModelDelete').modal('hide');
        });
        // Modal Button Cancel Delete
        $(document).on('click', '#modalConfirmModelDelete #btnModalCancelModelDelete', function (e) {
            e.preventDefault();
            var btnConfirm = $('#modalConfirmModelDelete').find('#btnModalConfirmModelDelete');
            if (btnConfirm.length) {
                btnConfirm.attr('data-form-id', "");
            }
            $('#modalConfirmModelDelete').modal('hide');
        });
    });
</script>
<!-- End Delete Confirm - Helper. Show a modal box -->

<script type="text/javascript">
    $(function () {
        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".list-records input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".list-records input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        // Search
        $('ul.custom-data-changer li a').on('click', function (e) {
            e.preventDefault();
            var showValue = $(this).attr('data-value');
            var dataChanger = $(this).parent('li').parent('ul.custom-data-changer');
            if (dataChanger.length) {
                var inputSelector = dataChanger.attr('data-change');
                if (inputSelector == '#search-show-input') {
                    showValue = (!isNaN(showValue) && showValue > 0 && showValue <= 100) ? showValue : 10;
                } else if (inputSelector == '#search-sort-input') {
                    showValue = (showValue == 'asc' || showValue == 'desc') ? showValue : '';
                } else if (inputSelector == '#search-sortby-input') {
                    @if (count($sortByParams)) <?php $strTmp = ''; ?>
                        @foreach ($sortByParams as $sortByParam)
                            <?php $strTmp .= (empty($strTmp)) ? "showValue == '$sortByParam'" : " || showValue == '$sortByParam'"; ?>
                        @endforeach
                        showValue = ({!! $strTmp !!}) ? showValue : '';
                    @endif
                }
                var inputElem = $(document).find(inputSelector);
                if (inputElem.length) {
                    inputElem.val('');
                    inputElem.val(showValue);
                }
            }
        });
    });
</script>
