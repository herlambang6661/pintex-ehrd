<script src="{{ asset('assets/extentions/jquery-3.7.1.min.js') }}"></script>

<script src="{{ asset('assets/extentions/scanx/signalr.min.js') }}"></script>

<script src="{{ asset('assets/extentions/scanx/scanx.js') }}"></script>

<img id="image" alt="scanned image" />

<button type="button" onclick="startScan()">
    Scan
</button>

<script type="text/javascript">
    // declar scanx class
    var scan = new ScanX();


    //setup on image scan events
    scan.connection.on("OnImageScanned", (data) => {
        console.log('image event');
        var image = document.getElementById('image');
        image.src = "data:image/jpeg;base64," + data.imageBytes;
    });

    //get installed scanners and select the first id
    var firstScannerId = scan.getScanners()[0].deviceId;

    //define scan settings
    var settings = {
        color: 1, //color mode 1 color, 2 Grayscale, 4 Black and white
        dpi: 200 //dpi
    }

    //Scan first imaga
    function startScan() {
        scan.scanSingle(firstScannerId, settings);
    }

    //Connect to the protocol
    scan.connect();
</script>
