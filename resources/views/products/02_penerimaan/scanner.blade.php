<!DOCTYPE html>

<html lang="en">

<head>

    <title>
        ScanX
    </title>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('assets/extentions/scanx/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extentions/scanx/site.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/extentions/scanx/cropper.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extentions/scanx/simplebar.css') }}" rel="stylesheet" />

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

        <div class="container">
            <a class="navbar-brand" href="#">ScanX</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Home/Devices">Devices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Home/ScannerSample">Scanner Example</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Home/Documentation">Docs</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <main role="main">


        <div class="container content">

            <div id="alert"></div>

            <div class="row align-items-center">
                <div class="col">

                    <div class="form-group">
                        <label for="">
                            Choose scanner:
                        </label>
                        <select id="select-scanner-drp" class="form-control">
                            <option value="">--- Select Scanner ---</option>
                        </select>
                    </div>



                </div>
                <div class="col">
                    <div class="form-group">
                        <label>DPI Res:</label>
                        <select class="form-control" id="drp-dpi">
                            <option value="72">
                                72 DPI
                            </option>
                            <option value="96">
                                96 DPI
                            </option>
                            <option value="150">
                                150 DPI
                            </option>
                            <option value="300">
                                300 DPI
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Color Mode:</label>
                        <select class="form-control" id="drp-color-mode">
                            <option value="2">
                                Grayscale
                            </option>
                            <option value="1">
                                Color
                            </option>
                            <option value="4">
                                Black & White
                            </option>

                        </select>
                    </div>
                </div>
                <div class="col vertical">
                    <button type="button" class="btn btn-sm btn-primary" onclick="scanSingle();">
                        <i class="fas fa-file"></i>
                        Scan Single
                    </button>

                    <button type="button" class="btn btn-sm btn-primary" onclick="scanImage();">
                        <i class="fas fa-print"></i>
                        Scan
                    </button>
                </div>
            </div>

            <br />
            <br />

            <div class="row">
                <div class="col-10">
                    <div style="background-color:whitesmoke;padding:20px; ">
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="scanTest();">
                                            <i class="fas fa-file"></i>
                                            Scan Test
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary" onclick="resetCropper();">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary" onclick="zoomIn();">
                                            <i class="fas fa-search-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary" onclick="zoomOut();">
                                            <i class="fas fa-search-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary"
                                            onclick="clearCropper();">
                                            <i class="fas fa-arrows-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary" onclick="setCrop();">
                                            <i class="fas fa-crop"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary"
                                            onclick="rotateLeft();">
                                            <i class="fas fa-undo"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-primary"
                                            onclick="rotateRight();">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary" onclick="save();">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div style="height:750px;">
                            <img id="image-container" style="max-width:100%; display:none;" />
                        </div>


                    </div>

                </div>

                <div class="col-2 border" style="background-color:whitesmoke;">
                    <div data-simplebar style="height:750px;">
                        <ul id="image-list" style="padding:20px;"></ul>
                    </div>
                </div>
            </div>

        </div>

        <br />


    </main>

    <footer class="footer">
        <div class="container">
            <span class="text-muted">
                ScanX All rights reserved 2018 - 2024 <a
                    href="https://github.com/balbarak/scanx">https://github.com/balbarak/scanx</a>
            </span>
        </div>
    </footer>


    <script src="{{ asset('assets/extentions/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/extentions/scanx/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/extentions/scanx/all.min.js') }}"></script>


    <script type="text/javascript">
        $(function() {

            setActiveLink();
        })

        function setActiveLink() {

            var currentPath = location.pathname.toLocaleLowerCase();

            $('.nav-item a').each(function(i, n) {

                var href = $(n).attr("href");

                if (href) {
                    href = href.toLowerCase();

                    if (href.endsWith(currentPath)) {

                        var anchor = $(n);

                        var navToggle = anchor.parents('.nav-item');

                        navToggle.addClass('active');

                        $(n).closest("li").addClass('active');

                    }
                }
            });
        }
    </script>

    <script src="{{ asset('assets/extentions/scanx/cropper.min.js') }}"></script>

    <script src="{{ asset('assets/extentions/scanx/signalr.min.js') }}"></script>

    <script src="{{ asset('assets/extentions/scanx/scanx.js') }}"></script>

    <script src="{{ asset('assets/extentions/scanx/simplebar.js') }}"></script>

    <script src="{{ asset('assets/extentions/scanx/cropper-viewer.js') }}"></script>


    <script type="text/javascript">
        var scan = new ScanX();

        $(function() {

            setupEvents();

            scan.connect();


        })

        function setupEvents() {

            scan.connection.on("OnError", (data) => {
                addAlert(data);
            });

            scan.connection.on("OnFinish", () => {

            });

            scan.connection.on("OnLog", (data) => {

                alert(data);

            });

            scan.connection.on("OnImageScanned", (data) => {

                var img = '<li><img class="img-fluid" src="data: image/jpeg;base64,' + data.imageBytes +
                    '" onclick="setImageToViewer(this)"></img><p class="text-center">' + data.page + ' <br/>' + data
                    .size + ' </p></li>';

                $("#image-list").append(img);
            });

            scan.connection.onclose(() => {


            })

        }

        function addAlert(data) {

            $("#alert").append(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                data.Message + '</div >');

        }
    </script>



</body>

</html>
