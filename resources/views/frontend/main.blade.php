<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Shila Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        {{Html::style('css/bootstrap.css')}}
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- Ionicons -->
        {{Html::style('css/ionicons.min.css')}}

        <!-- Theme style -->
        {{Html::style('css/AdminLTE.min.css')}}

        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        {{Html::style('css/_all-skins.min.css')}}
        {{Html::style('css/custom.css')}}
        <!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Add stripe js file -->
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        @if(count(\App\ShopSetting::all())>0)
        <script type="text/javascript">
Stripe.setPublishableKey('{!! \App\ShopSetting::all()->first()->stripe_public_key !!}');
        </script>
        @endif
    </head>

    <body class="hold-transition skin-blue layout-top-nav">
        <div class="content-wrapper">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </body>

    <!-- jQuery 2.2.3 -->
    {{Html::script('js/jquery-2.2.3.min.js')}}
    <!-- Bootstrap 3.3.6 -->
    {{Html::script('js/bootstrap.min.js')}}
    <!-- Custom specific js -->
    @include('frontend.scripts')
</body>
</html>