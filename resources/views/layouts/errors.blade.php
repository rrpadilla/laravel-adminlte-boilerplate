<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="robots" content="noindex, nofollow, noarchive">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | Error @hasSection('title') | @yield('title') @endif</title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Theme CSS -->
        <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
        <!-- AdminLTE Skin. -->
        <link rel="stylesheet" href="/adminlte/css/skins/{{ config('adminlte.theme') }}.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        @yield('head-extras')
    </head>

    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition {{ config('adminlte.theme') }} layout-top-nav">
        <!-- Site wrapper -->
        <div class="wrapper">

            @include('layouts.partials.errors.header')

            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">

                    <!-- Main content -->
                    <section class="content">

                        @include('flash::message')

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <h2 class="page-header text-center text-danger">Error</h2>
                                <div class="box box-solid">
                                    <div class="box-body text-center text-danger">
                                        @yield('message')
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>

                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="container text-center">
                    <strong>Copyright &copy; {{ date('Y') }}. {!! config('adminlte.credits') !!}</strong>
                </div>
                <!-- /.container -->
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- END - Plugins -->

        <!-- AdminLTE App -->
        <script src="/adminlte/js/adminlte.min.js"></script>
    </body>
</html>
