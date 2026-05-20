<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no"
        name="viewport" />
    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon"
        href="<?php echo e(asset('images/favicon.ico')); ?>" />

    <!-- For iPhone 4 Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo e(asset('images/apple-icon-114x114.png')); ?>" />

    <!-- For iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo e(asset('images/apple-icon-72x72.png')); ?>" />

    <!-- For iPhone: -->
    <link rel="apple-touch-icon-precomposed" href="<?php echo e(asset('images/apple-icon-57x57.png')); ?>" />

    <!-- Library - Bootstrap v3.3.5 -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('libraries/lib.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('libraries/Stroke-Gap-Icon/stroke-gap-icon.css')); ?>" />

    <!-- Custom - Common CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/plugins.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/navigation-menu.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('libraries/lightslider-master/lightslider.css')); ?>" />

    <!-- Custom - Theme CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('style.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/shortcode.css')); ?>" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .report {
            height: 170px;
            width: 10%;
            border: 1px solid #133E8D;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.4s;
        }

        .report:hover {
            box-shadow: -5px 8px 30px 0px #133E8D, 0px 10px 15px -3px rgba(0, 0, 0, 0.1)
        }

        .report-image {
            width: 100%;
            height: 40%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative
        }

        .click-report {
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translate(50%, -50%);
            animation: bounce-infinite 2s linear infinite;
            display: none
        }

        .report:hover .click-report {
            display: block
        }

        .report-title {
            text-align: center;
            height: 40%;
            padding: 0 6px
        }

        .report-title p {
            font-weight: 500;
            color: black;
            font-size: 13px;
            transition: 0.4s
        }

        .report-title p:hover {
            color: #133E8D
        }

        @media all and (max-width:768px) {
            .report {
                width: 100%;
            }

            .report-container {
                padding-left: 130px;
                padding-right: 130px
            }
        }

        @media all and (max-width:475px) {
            .report {
                width: 100%;
            }

            .report-container {
                padding-left: 130px;
                padding-right: 130px
            }
        }

        .menus {
            list-style: none;
        }

        .menus li {
            display: inline-block;
            margin-right: 10px;
            /* add spacing between items */
        }

        .first-team {
            background: rgb(127, 206, 127);
        }

        .last-teams {
            background: rgb(234, 158, 158);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.25rem
        }

        .card-title {
            margin-bottom: 0.75rem
        }

        .card-subtitle {
            margin-top: -0.375rem;
            margin-bottom: 0
        }

        .card-text:last-child {
            margin-bottom: 0
        }

        .card-link:hover {
            text-decoration: none
        }

        .card-link+.card-link {
            margin-left: 1.25rem
        }

        .card>.list-group:first-child .list-group-item:first-child {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem
        }

        .card>.list-group:last-child .list-group-item:last-child {
            border-bottom-right-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem
        }

        .card-header {
            padding: 0rem 1.25rem;
            margin-bottom: 0;
            /* background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125) */
        }

        .card-header:first-child {
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.125)
        }

        .card-footer:last-child {
            border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px)
        }

        .card-header-tabs {
            margin-right: -0.625rem;
            margin-bottom: -0.75rem;
            margin-left: -0.625rem;
            border-bottom: 0
        }

        .card-header-pills {
            margin-right: -0.625rem;
            margin-left: -0.625rem
        }

        .card-img-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1.25rem
        }

        .card-img {
            width: 100%;
            border-radius: calc(0.25rem - 1px)
        }

        .card-img-top {
            width: 100%;
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px)
        }

        .card-img-bottom {
            width: 100%;
            border-bottom-right-radius: calc(0.25rem - 1px);
            border-bottom-left-radius: calc(0.25rem - 1px)
        }

        @media (min-width:576px) {
            .card-deck {
                display: flex;
                flex-flow: row wrap;
                margin-right: -15px;
                margin-left: -15px
            }

            .card-deck .card {
                display: flex;
                flex: 1 0 0%;
                flex-direction: column;
                margin-right: 15px;
                margin-left: 15px
            }
        }

        @media (min-width:576px) {
            .card-group {
                display: flex;
                flex-flow: row wrap
            }

            .card-group .card {
                flex: 1 0 0%
            }

            .card-group .card+.card {
                margin-left: 0;
                border-left: 0
            }

            .card-group .card:first-child {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0
            }

            .card-group .card:first-child .card-img-top {
                border-top-right-radius: 0
            }

            .card-group .card:first-child .card-img-bottom {
                border-bottom-right-radius: 0
            }

            .card-group .card:last-child {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0
            }

            .card-group .card:last-child .card-img-top {
                border-top-left-radius: 0
            }

            .card-group .card:last-child .card-img-bottom {
                border-bottom-left-radius: 0
            }

            .card-group .card:not(:first-child):not(:last-child) {
                border-radius: 0
            }

            .card-group .card:not(:first-child):not(:last-child) .card-img-top,
            .card-group .card:not(:first-child):not(:last-child) .card-img-bottom {
                border-radius: 0
            }
        }

        .card-columns .card {
            margin-bottom: 0.75rem
        }

        @media (min-width:576px) {
            .card-columns {
                column-count: 3;
                column-gap: 1.25rem
            }

            .card-columns .card {
                display: inline-block;
                width: 100%
            }
        }
        .bg-red {
            /* background-color: #ff4d4d; */
        }

        .text-center {
            text-align: center;
        }

        .form-select-lg {
            font-size: 1.2rem;
            padding: 0.5rem 1rem;
            color: #333; /* Ensure text is visible */
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-dark {
            background-color: #343a40;
            border: none;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        h4.text-danger {
            /* color: #dc3545; */
        }

        .d-grid {
            display: grid;
        }
    </style>
</head>

<body>
    <?php echo $__env->make('menuBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- PageBanner -->
    <div class="container-fluid page-banner blogpost no-padding">
        <div class="section-padding"></div>
        <div class="container">
            <div class="banner-content-block">
                <div class="banner-content">
                    <h3>Keep in Touch</h3>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active" style="color: yellow"> <?php echo e($name); ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="section-padding"></div>
    </div>
    <!-- PageBanner /- -->
</body>
<?php /**PATH /home/ferwafa/public_html/resources/views/mainMenuBar.blade.php ENDPATH**/ ?>