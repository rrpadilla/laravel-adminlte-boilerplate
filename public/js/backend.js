$(function () {
    $('#sidebar-form').on('submit', function (e) {
        e.preventDefault();
    });

    $('.sidebar-menu li.active').data('lte.pushmenu.active', true);

    $('#search-input').on('keyup', function () {
        var term = $('#search-input').val().trim();

        if (term.length === 0) {
            $('.sidebar-menu li').each(function () {
                $(this).show(0);
                $(this).removeClass('active');
                if ($(this).data('lte.pushmenu.active')) {
                    $(this).addClass('active');
                }
            });
            return;
        }

        $('.sidebar-menu li').each(function () {
            if ($(this).text().toLowerCase().indexOf(term.toLowerCase()) === -1) {
                $(this).hide(0);
                $(this).removeClass('pushmenu-search-found', false);

                if ($(this).is('.treeview')) {
                    $(this).removeClass('active');
                }
            } else {
                $(this).show(0);
                $(this).addClass('pushmenu-search-found');

                if ($(this).is('.treeview')) {
                    $(this).addClass('active');
                }

                var parent = $(this).parents('li').first();
                if (parent.is('.treeview')) {
                    parent.show(0);
                }
            }

            if ($(this).is('.header')) {
                $(this).show();
            }
        });

        $('.sidebar-menu li.pushmenu-search-found.treeview').each(function () {
            $(this).find('.pushmenu-search-found').show(0);
        });
    });
});

$(function () {
    //Initialize Select2 Elements
    $('select.select2').select2();

    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].square-green, input[type="radio"].square-green').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    $('input[type="checkbox"].square-blue, input[type="radio"].square-blue').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue'
    });
    $('input[type="checkbox"].square-yellow, input[type="radio"].square-yellow').iCheck({
        checkboxClass: 'icheckbox_square-yellow',
        radioClass: 'iradio_square-yellow'
    });
});

$(function () {
    //Initialize Datetimepicker Elements
    $('input.datetimepicker').datetimepicker({
        //locale: 'es', locale: 'en',
        format: 'YYYY/MM/DD h:mm A',
        showTodayButton: true,
        showClear: true,
        icons: {
            today: "fa fa-thumb-tack",
            clear: "fa fa-trash"
        }
    });

    $('input.datetimepicker-single').datetimepicker({
        //locale: 'es', locale: 'en',
        format: 'YYYY-MM-DD',
        showTodayButton: true,
        showClear: true,
        icons: {
            today: "fa fa-thumb-tack",
            clear: "fa fa-trash"
        }
    });

    $('input.datetimepicker-search').datetimepicker({
        //locale: 'es', locale: 'en',
        format: 'YYYY-MM-DD',
        showTodayButton: true,
        showClear: true,
        icons: {
            today: "fa fa-thumb-tack",
            clear: "fa fa-trash"
        }
    });

    $('#date-range-select-search').on('select2:select', function (e) {
        var data = e.params.data;
        var fromElem = $('#date-range-search-from');
        var toElem = $('#date-range-search-to');
        var index = data.id ? data.id : 'custom';
        var handler = null;

        var ranges = {
            'custom': function () {
                fromElem.data('DateTimePicker').clear();
                toElem.data('DateTimePicker').clear();
            },
            'today': function () {
                fromElem.data('DateTimePicker').date(moment());
                toElem.data('DateTimePicker').date(moment());
            },
            'yesterday': function () {
                var start = moment().subtract(1, 'days');
                var end = moment().subtract(1, 'days');
                fromElem.data('DateTimePicker').date(start);
                toElem.data('DateTimePicker').date(end);
            },
            'last_7_days': function () {
                var start = moment().subtract(6, 'days');
                var end = moment();
                fromElem.data('DateTimePicker').date(start);
                toElem.data('DateTimePicker').date(end);
            },
            'this_month': function () {
                var start = moment().startOf('month');
                var end = moment().endOf('month');
                fromElem.data('DateTimePicker').date(start);
                toElem.data('DateTimePicker').date(end);
            },
            'last_month': function () {
                var start = moment().subtract(1, 'month').startOf('month');
                var end = moment().subtract(1, 'month').endOf('month');
                fromElem.data('DateTimePicker').date(start);
                toElem.data('DateTimePicker').date(end);
            },
            'last_30_days': function () {
                var start = moment().subtract(29, 'days');
                var end = moment();
                fromElem.data('DateTimePicker').date(start);
                toElem.data('DateTimePicker').date(end);
            },
            'last_60_days': function () {
                var start = moment().subtract(59, 'days');
                var end = moment();
                fromElem.data('DateTimePicker').date(start);
                toElem.data('DateTimePicker').date(end);
            },
            'last_90_days': function () {
                var start = moment().subtract(89, 'days');
                var end = moment();
                fromElem.data('DateTimePicker').date(start);
                toElem.data('DateTimePicker').date(end);
            },
            'months': function (numb) {
                var start = moment().subtract(numb, 'months').startOf('month');
                var end = moment().subtract(numb, 'months').endOf('month');
                fromElem.data('DateTimePicker').date(start);
                toElem.data('DateTimePicker').date(end);
            },
            'years': function (numb) {
                var start = moment().subtract(numb, 'years').startOf('year');
                var end = moment().subtract(numb, 'years').endOf('year');
                fromElem.data('DateTimePicker').date(start);
                toElem.data('DateTimePicker').date(end);
            }
        };

        if (ranges.hasOwnProperty(index) && typeof (ranges[index]) === 'function') {
            handler = ranges[index];
            handler.call(index);
        } else {
            var fnData = index.split(' ');
            if (fnData.length === 2) {
                var numb = fnData[0];
                index = fnData[1];
                if (!isNaN(numb) && ranges.hasOwnProperty(index) && typeof (ranges[index]) === 'function') {
                    handler = ranges[index];
                    handler.call(index, numb);
                }
            }
        }
    });
});
