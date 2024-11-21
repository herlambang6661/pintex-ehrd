<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="{{ asset('hrd16.png') }}">
    <title>{{ !empty($judul) ? $judul : '' }} - EHRD PT PINTEX (Stand Alone).</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extentions/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/select2/css/select2.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/extentions/datatables/Select-1.6.0/css/select.bulma.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/datatables/FixedColumns-4.2.1/css/fixedColumns.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/extentions/placeholder/placeholder-loading.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/richtext/richtext.min.css') }}" rel="stylesheet">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
