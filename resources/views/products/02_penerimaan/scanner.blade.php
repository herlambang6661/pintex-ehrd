<!DOCTYPE html>
<html>

<head>
    <title>Dynamic Web TWAIN for Laravel</title>
    <script src="{{ asset('Resources/dynamsoft.webtwain.initiate.js') }}"></script>
    <script src="{{ asset('Resources/dynamsoft.webtwain.config.js') }}"></script>
    <meta name="_token" content="{{ csrf_token() }}" />
</head>

<body>
    <h3>Dynamic Web TWAIN for Laravel</h3>
    <div id="dwtcontrolContainer"></div>
    <input type="button" value="Load Image" onclick="loadImage();" />
    <input type="button" value="Scan Image" onclick="acquireImage();" />
    <input id="btnUpload" type="button" value="Upload Image" onclick="upload()">

    <script>
        var DWObject;
        var deviceList = [];

        window.onload = function() {
            if (Dynamsoft) {
                Dynamsoft.DWT.AutoLoad = false;
                Dynamsoft.DWT.UseLocalService = true;
                Dynamsoft.DWT.Containers = [{
                    ContainerId: 'dwtcontrolContainer',
                    Width: '640px',
                    Height: '640px'
                }];
                Dynamsoft.DWT.RegisterEvent('OnWebTwainReady', Dynamsoft_OnReady);
                // https://www.dynamsoft.com/customer/license/trialLicense?product=dwt
                Dynamsoft.DWT.ProductKey =
                    'LICENSE-KEY';
                Dynamsoft.DWT.ResourcesPath = 'https://unpkg.com/dwt/dist/';

                Dynamsoft.DWT.Load();
            }

        };

        function Dynamsoft_OnReady() {
            DWObject = Dynamsoft.DWT.GetWebTwain('dwtcontrolContainer');
            var token = document.querySelector("meta[name='_token']").getAttribute("content");
            DWObject.SetHTTPFormField('_token', token);

            let count = DWObject.SourceCount;
            let select = document.getElementById("source");

            DWObject.GetDevicesAsync().then(function(devices) {
                for (var i = 0; i < devices.length; i++) { // Get how many sources are installed in the system
                    let option = document.createElement('option');
                    option.value = devices[i].displayName;
                    option.text = devices[i].displayName;
                    deviceList.push(devices[i]);
                    select.appendChild(option);
                }
            }).catch(function(exp) {
                alert(exp.message);
            });
        }

        function loadImage() {
            var OnSuccess = function() {};
            var OnFailure = function(errorCode, errorString) {};

            if (DWObject) {
                DWObject.IfShowFileDialog = true;
                DWObject.LoadImageEx("", Dynamsoft.DWT.EnumDWT_ImageType.IT_ALL, OnSuccess, OnFailure);
            }
        }

        function acquireImage() {
            if (DWObject) {
                var sources = document.getElementById('source');
                if (sources) {
                    DWObject.SelectDeviceAsync(deviceList[sources.selectedIndex]).then(function() {
                        return DWObject.AcquireImageAsync({
                            IfShowUI: false,
                            IfCloseSourceAfterAcquire: true
                        });
                    }).catch(function(exp) {
                        alert(exp.message);
                    });
                }
            }
        }

        function upload() {
            var OnSuccess = function(httpResponse) {
                alert("Succesfully uploaded");
            };

            var OnFailure = function(errorCode, errorString, httpResponse) {
                alert(httpResponse);
            };

            var date = new Date();
            DWObject.HTTPUploadThroughPostEx(
                "{{ route('dwtupload.upload') }}",
                DWObject.CurrentImageIndexInBuffer,
                '',
                date.getTime() + ".jpg",
                1, // JPEG
                OnSuccess, OnFailure
            );
        }
    </script>

</body>

</html>
