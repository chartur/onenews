<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> 404 - OneNews </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="{{ asset('/images/fav.png') }}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="/admin/css/vendor.css">
    <link rel="stylesheet" href="/admin/css/app.css">
    <link rel="stylesheet" href="/css/styles.css">
    <!-- Theme initialization -->
    <style>
        .main-active-background-color {
            background-color: #e74c3c!important;
            color: #fff !important;
        }
    </style>
</head>
<body>
<div class="app blank sidebar-opened 404">
    <article class="content">
        <div class="error-card global">
            <div class="error-title-block">
                <h1 class="error-title">404</h1>
                <h2 class="error-sub-title"> Sorry, page not found </h2>
            </div>
            <div class="error-container">
                <p>You better try our awesome search:</p>
                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn main-active-background-color h-100" type="button">{{ trans('main.search') }}</button>
                            </span>
                        </div>
                    </div>
                </div>
                <br>
                <a class="btn main-active-background-color" href="/">
                    <i class="fa fa-angle-left"></i> {{ trans('main.return_home') }}
                </a>
            </div>
        </div>
    </article>
</div>
<!-- Reference block for JS -->
<div class="ref" id="ref">
    <div class="color-primary"></div>
    <div class="chart">
        <div class="color-primary"></div>
        <div class="color-secondary"></div>
    </div>
</div>
<script src="/admin/js/vendor.js"></script>
<script src="/admin/js/app.js"></script>
</body>
</html>