@extends('layouts.app')
@section('content')
    <style>
        .img-preview-container {
            position: relative;
            display: inline-block;
            margin-top: 10px;
        }

        .img-preview {
            width: 250px;
            height: auto;
            display: block;
        }

        .remove-img-btn {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            cursor: pointer;
            font-size: 12px;
            line-height: 20px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .loader {
            position: fixed;
            z-index: 301;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 200px;
            width: 200px;
            overflow: hidden;
            text-align: center;
        }

        .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 303;
            border-radius: 100%;
            border-left-color: transparent !important;
            border-right-color: transparent !important;
        }

        .spinner1 {
            width: 100px;
            height: 100px;
            border: 10px solid #fff;
            animation: spin 1s linear infinite;
        }

        .spinner2 {
            width: 70px;
            height: 70px;
            border: 10px solid #fff;
            animation: negative-spin 2s linear infinite;
        }

        .spinner3 {
            width: 40px;
            height: 40px;
            border: 10px solid #fff;
            animation: spin 4s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @keyframes negative-spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(-360deg);
            }
        }

        .loader-text {
            position: relative;
            top: 75%;
            color: #fff;
            font-weight: bold;
            font-size: 10px;
        }
    </style>

    <div class="page">
        <!-- Sidebar -->
        @include('shared.sidebar')
        <!-- Navbar -->
        @include('shared.navbar')

        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                    class="icon icon-tabler icon-tabler-clipboard-text" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path
                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 12h6" />
                                    <path d="M9 16h6" />
                                </svg>
                                Lowongan
                                <div id="entitasText" style="margin-left: 5px;">Loading... <i
                                        class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i>
                                            Penerimaan</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-regular fa-paste"></i>
                                            Lowongan Pekerjaan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-regular fa-paste"></i> Tambah Lowongan Pekerjaan</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row mt-4">
                    <form action="" method="post">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Form Tambah Lowongan Pekerjaan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Entitas</label>
                                                <input type="text" name="entitas" id="entitas"
                                                    class="form-control bg-secondary-lt cursor-not-allowed" readonly
                                                    value="PINTEX">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Buka</label>
                                                <input type="date" name="tglbuka" id="tglbuka" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Tutup</label>
                                                <input type="date" name="tgltutup" id="tgltutup" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" style="color: white">Tdk Ada Batas
                                                    Pendaftaran</label>
                                                <div>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="tdkadatgl" id="tdkadatgl"
                                                            class="form-check-input" value="0">
                                                        <span class="form-check-label">Tdk Ada Batas Tanggal</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Lowongan Untuk</label>
                                                <input type="text" name="lowongan" id="lowongan" class="form-control"
                                                    placeholder="Operator Produksi, Helper Gudang">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Pendidikan Minimal</label>
                                                <input type="text" name="pendidikan" id="pendidikan" class="form-control"
                                                    placeholder="SD, SMP, SMA, D3, S1">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Dokumen Tambahan</label>
                                                <div>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="simA" id="simA"
                                                            class="form-check-input">
                                                        <span class="form-check-label">SIM A</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="simB" id="simB"
                                                            class="form-check-input">
                                                        <span class="form-check-label">SIM B</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="simB2" id="simB2"
                                                            class="form-check-input">
                                                        <span class="form-check-label">SIM B2 Umum</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="sio" id="sio"
                                                            class="form-check-input">
                                                        <span class="form-check-label">Sertifikat SIO Forklift</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">Requirement Pekerjaan</label>
                                                <div class="border-success shadow rounded">
                                                    <textarea class="content" name="requirement" id="requirement"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-primary d-none d-sm-inline-block"
                                        data-bs-toggle="modal" data-bs-target="#myModalCheck" data-bs-backdrop="static"
                                        data-bs-keyboard="false">
                                        <i class="fa-solid fa-user-plus"></i>
                                        Simpan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('shared.footer')
        </div>
    </div>
    {{-- Modal start --}}
    <div class="modal modal-blur fade" id="myModalCheck" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="overlay">
            <div class="loader">
                <span class="spinner spinner1"></span>
                <span class="spinner spinner2"></span>
                <span class="spinner spinner3"></span>
                <br>
                <span class="loader-text">Membuat Review Sebelum Menyimpan</span>
            </div>
        </div>
        <div class="modal-dialog modal-full-width  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Review Lowongan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAcc" name="formAcc" method="post" action="javascript:void(0)">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="resultChecklist"></div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal end --}}
    <script>
        // const someCheckbox = document.getElementById('someID');
        document.getElementById('tdkadatgl').addEventListener('change', e => {
            if (e.target.checked === true) {
                console.log("Checkbox is checked - boolean value: ", e.target.checked)
                document.getElementById('tglbuka').disabled = true;
                document.getElementById('tglbuka').classList.add("cursor-not-allowed");
                document.getElementById('tgltutup').disabled = true;
                document.getElementById('tgltutup').classList.add("cursor-not-allowed");
                document.getElementById('tdkadatgl').value = "1";
            }
            if (e.target.checked === false) {
                console.log("Checkbox is not checked - boolean value: ", e.target.checked)
                document.getElementById('tglbuka').disabled = false;
                document.getElementById('tglbuka').classList.remove("cursor-not-allowed");
                document.getElementById('tgltutup').disabled = false;
                document.getElementById('tgltutup').classList.remove("cursor-not-allowed");
                document.getElementById('tdkadatgl').value = "0";
            }
        });
        $('.content').richText({
            // text formatting
            bold: true,
            italic: true,
            underline: true,
            // text alignment
            leftAlign: true,
            centerAlign: true,
            rightAlign: true,
            justify: true,
            // lists
            ol: true,
            ul: true,
            // title
            heading: true,
            // fonts
            fonts: true,
            fontList: ["Arial",
                "Arial Black",
                "Comic Sans MS",
                "Courier New",
                "Geneva",
                "Georgia",
                "Helvetica",
                "Impact",
                "Lucida Console",
                "Tahoma",
                "Times New Roman",
                "Verdana"
            ],
            fontColor: true,
            backgroundColor: false,
            fontSize: true,
            // uploads
            imageUpload: false,
            fileUpload: false,
            // link
            urls: false,
            // tables
            table: true,
            // code
            removeStyles: false,
            code: false,
            // colors
            colors: [],
            // dropdowns
            fileHTML: '',
            imageHTML: '',
            // translations
            translations: {
                'title': 'Title',
                'white': 'White',
                'black': 'Black',
                'brown': 'Brown',
                'beige': 'Beige',
                'darkBlue': 'Dark Blue',
                'blue': 'Blue',
                'lightBlue': 'Light Blue',
                'darkRed': 'Dark Red',
                'red': 'Red',
                'darkGreen': 'Dark Green',
                'green': 'Green',
                'purple': 'Purple',
                'darkTurquois': 'Dark Turquois',
                'turquois': 'Turquois',
                'darkOrange': 'Dark Orange',
                'orange': 'Orange',
                'yellow': 'Yellow',
                'imageURL': 'Image URL',
                'fileURL': 'File URL',
                'linkText': 'Link text',
                'url': 'URL',
                'size': 'Size',
                'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsive</a>',
                'text': 'Text',
                'openIn': 'Open in',
                'sameTab': 'Same tab',
                'newTab': 'New tab',
                'align': 'Align',
                'left': 'Left',
                'justify': 'Justify',
                'center': 'Center',
                'right': 'Right',
                'rows': 'Rows',
                'columns': 'Columns',
                'add': 'Add',
                'pleaseEnterURL': 'Please enter an URL',
                'videoURLnotSupported': 'Video URL not supported',
                'pleaseSelectImage': 'Please select an image',
                'pleaseSelectFile': 'Please select a file',
                'bold': 'Bold',
                'italic': 'Italic',
                'underline': 'Underline',
                'alignLeft': 'Align left',
                'alignCenter': 'Align centered',
                'alignRight': 'Align right',
                'addOrderedList': 'Ordered list',
                'addUnorderedList': 'Unordered list',
                'addHeading': 'Heading/title',
                'addFont': 'Font',
                'addFontColor': 'Font color',
                'addBackgroundColor': 'Background color',
                'addFontSize': 'Font size',
                'addImage': 'Add image',
                'addVideo': 'Add video',
                'addFile': 'Add file',
                'addURL': 'Add URL',
                'addTable': 'Add table',
                'removeStyles': 'Remove styles',
                'code': 'Show HTML code',
                'undo': 'Undo',
                'redo': 'Redo',
                'save': 'Save',
                'close': 'Close'
            },
            // privacy
            youtubeCookies: false,
            // preview
            preview: false,
            // placeholder
            placeholder: 'Masukkan Requirement Pekerjaan',
            // dev settings
            useSingleQuotes: false,
            height: 150,
            heightPercentage: 0,
            adaptiveHeight: false,
            id: "",
            class: "",
            useParagraph: false,
            maxlength: 0,
            maxlengthIncludeHTML: false,
            callback: undefined,
            useTabForNext: false,
            save: false,
            saveCallback: undefined,
            saveOnBlur: 0,
            undoRedo: true
        });

        $(function() {
            $('#myModalCheck').on('show.bs.modal', function(e) {
                $(".overlay").fadeIn(300);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'POST',
                    url: '{{ url('reviewLowongan') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        tipe: 'form',
                    },
                    success: function(data) {
                        $('.resultChecklist').html(data);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay").fadeOut(300);
                    }, 500);
                });
            });
        });
    </script>
@endsection
