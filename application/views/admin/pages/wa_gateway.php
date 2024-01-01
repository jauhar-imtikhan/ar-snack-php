<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('admin/wa_gateway') ?>" aria-current="page">WA Gateway</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Whatsapp Gateway</h4>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>QR Code Wa</h4>
            </div>
            <div class="card-body">
                <div id="renderQrCodeWa"></div>
                <span class="mt-3" id="syncmsg"></span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Status Server</h4>
            </div>
            <div class="card-body">
                <h3 class="text-center text-danger" id="server_status">Server Belum Ready</h3>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.socket.io/4.7.2/socket.io.min.js" integrity="sha384-mZLF4UVrpi/QTWPA7BjNPEnkIfRFn4ZEO3Qt/HFklTJBj/gBOV8G3HcKn4NfQblz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    const socket = io("http://localhost:5000");

    socket.on('connect', function() {
        console.log('connected to server');
    })

    socket.on('qr', function(qr) {
        console.log(qr);
        $('#loaderQr').html('');
        new QRCode(document.getElementById("renderQrCodeWa"), {
            text: qr,
            width: 300,
            height: 300,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

    })

    socket.on('authenticated', function(data) {
        $('#server_status').text('Server Dengan Client Sudah Terautentikasi')
    })

    socket.on('ready', function(data) {
        $('#loaderQr').html('');
        $('#server_status').removeClass('text-danger')

        $('#server_status').text('Server Sudah Ready')
    })
    socket.on('loading_screen', function(data) {
        if (data == 0) {
            $('#syncmsg').text("Sedang Menyinkronkan Server Dengan Client")
        } else {
            $('#syncmsg').text("Server Dengan Client 100% Sudah Terhubung")
        }
    })
    socket.on('disconnectedUser', function(data) {
        $('#server_status').text('Client Log out')
    })
</script>