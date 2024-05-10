<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir Toko H. Fahrul</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>template/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>template/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="print">
        <!-- content untuk print -->
    </div>
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> KASIR TOKO <small>H. Fahrul</small></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>logout">Logout</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <form id="formProduct">
                                        <div class="form-group">
                                            <label for="kode_product">Kode Product</label>
                                            <input type="text" class="form-control" id="kode_product" name="kode_product" required>
                                            <div id="errorKodeproduct" class="invalid-feedback">
                                                Kode product tidak ditemukan
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah">Quantity</label>
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="1">
                                        </div>
                                        <div class="form-group nama_product" style="display: none;">
                                            <label for="nama_product">Nama Product</label>
                                            <input type="text" class="form-control" id="nama_product" name="nama_product">
                                        </div>
                                        <div class="form-group harga_jual" style="display: none;">
                                            <label for="harga_jual">Harga</label>
                                            <input type="text" class="form-control" id="harga_jual" name="harga_jual">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary" id="addButton">Add</button>
                                            <div class="spinner-border text-primary ml-2" role="status" id="loadingSpinner" style="display: none;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card card-primary card-outline invoice">
                                <div class="card-body pb-5">
                                    <h5 class="card-title">Invoice</h5>
                                    <p class="card-text" style="margin-top: 30px;">
                                        * ini harusnya bukti bayar untuk dicetak tapi msh males bikinnya 😋
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->

                        <div class="col-lg">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group no_faktur">
                                                <label for="no_faktur">No Faktur</label>
                                                <input type="text" class="form-control no_faktur" id="no_faktur" name="no_faktur" readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group tanggal">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= date("d-m-Y", strtotime($tanggal)); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group jam">
                                                <label for="jam">Jam</label>
                                                <input type="text" class="form-control" id="jam" name="jam" readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group kasir">
                                                <label for="kasir">Kasir</label>
                                                <input type="text" class="form-control" id="kasir" name="kasir" value="<?= $nama; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <form id="formBayar" class="mt-2" action="<?= base_url(); ?>add-cart" method="POST">
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <table class="table" id="cartTable">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Produk</th>
                                                    <th>Harga</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <input type="text" class="form-control no_faktur" name="no_faktur" hidden readonly>
                                        <input type="text" class="form-control" id="kasir" name="kasir" value="<?= $nama; ?>" hidden readonly>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="bayar">Bayar</label>
                                                    <input type="number" class="form-control" id="bayar" name="bayar" min="0" required>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="kembalian">Kembalian</label>
                                                    <input type="text" class="form-control" id="kembalian" name="kembalian" readonly>
                                                </div>
                                            </div>
                                            <div style="margin-top: 31px;">
                                                <button type="submit" class="btn btn-primary" id="addBayar">Simpan</button>
                                                <div class="spinner-border text-primary ml-2" role="status" id="loadingBayar" style="display: none;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <div style="margin-top: 31px;" class="ml-2">
                                                <button type="button" class="btn btn-primary" id="bersihkan">Bersihkan</button>
                                                <div class="spinner-border text-primary" role="status" id="loadingBersihkan" style="display: none; margin-left: 90%;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                V 1.0.0
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2024 <a href="<?= base_url(); ?>/kasir">SudenDEV</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- jQuery -->
    <script src="<?= base_url(); ?>template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>template/dist/js/adminlte.min.js"></script>
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function updateJam() {
            let jam = new Date();
            let jamTeks = jam.getHours().toString().padStart(2, '0') + ':' + jam.getMinutes().toString().padStart(2, '0') + ':' + jam.getSeconds().toString().padStart(2, '0');
            document.getElementById('jam').value = jamTeks;
        }

        // Jalankan fungsi updateJam setiap detik
        setInterval(updateJam, 1000);
    </script>
    <!-- sweetalert -->
    <script>
        <?php if (session()->getFlashdata('title')) : ?>
            Swal.fire({
                title: "<?= session()->getFlashdata('title'); ?>",
                text: "<?= session()->getFlashdata('text'); ?>",
                icon: "<?= session()->getFlashdata('icon'); ?>"
            });
        <?php endif; ?>
    </script>
    <script>
        getData()
        kodeTransaksi()
        // loading add cart
        $('#loadingSpinner').hide();
        $('.nama_product').hide();
        $('.harga_jual').hide();
        $('#kode_product').val();
        $('#nama_product').val();
        $('#harga_jual').val();
        $('#jumlah').val();

        $('#kode_product').focus()


        // cari data yang sesuai dengan kode_product
        $('#kode_product').on('input', function() {
            var kodeProduct = $('#kode_product').val();
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>show-cart/" + kodeProduct,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#kode_product').removeClass('form-control is-invalid').addClass('form-control')
                        $('#nama_product').val(response.success.nama_product);
                        $('#harga_jual').val(response.success.harga_jual);
                    } else {
                        $('#kode_product').removeClass('form-control').addClass('form-control is-invalid')
                    }
                }
            });
        })

        // tambah cart
        $('#formProduct').on('submit', function(event) {
            event.preventDefault();
            // Sembunyikan tombol tambah dan tampilkan spinner
            $('#addButton').hide();
            $('#loadingSpinner').show();

            setTimeout(function() {
                // Tampilkan kembali tombol tambah dan sembunyikan spinner
                $('#addButton').show();
                $('#loadingSpinner').hide();

                var kodeProduct = $('#kode_product').val();
                var namaProduct = $('#nama_product').val();
                var hargaJual = $('#harga_jual').val();
                var jumlahInput = $('#jumlah').val();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>tambah-cart/" + kodeProduct,
                    data: {
                        kode_product: kodeProduct,
                        jumlah: jumlahInput
                    },
                    dataType: "json",
                    success: function(response) {
                        getData()
                        $('#kode_product').focus()
                    }
                });

                // Reset input form
                $('#kode_product').val('');
                $('#nama_product').val('');
                $('#harga_jual').val('');
                $('#jumlah').val('1');
            }, 300);
        });

        // No faktur / kode transaksi
        function kodeTransaksi() {
            // No faktur kode transaksi
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>kode-transaksi",
                dataType: "JSON",
                success: function(response) {
                    $('.no_faktur').val(response.success.newKode)
                    // console.log(response.success.newKode)
                }
            });
        }

        // tampil data cart
        function getData() {
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>show",
                dataType: "JSON",
                success: function(response) {
                    var no = 1
                    var totalCart = 0
                    $('tbody').empty()
                    $.each(response.cart_data, function(index, item) {
                        var total = item.harga_jual * item.jumlah

                        totalCart += total;

                        // Append ke tbody
                        $('tbody').append(`
                        <tr>
                            <td>${no++}</td>
                            <td><input type="text" class="form-control" name="nama_product[]" value="${item.nama_product}" readonly></td>
                            <td><input type="text" class="form-control" name="harga_jual[]" value="${item.harga_jual}" readonly></td>
                            <td><input type="number" class="form-control cart_jumlah${item.id_product}" data-id_product="${item.id_product}" name="jumlah[]" value="${item.jumlah}" min="1" ></td>
                            <td><input type="text" class="form-control" name="total[]" value="${total}" readonly></td>
                            <td>
                                <button type="button" class="btn btn-danger delete-cart${item.id_product}" >Remove</button>
                                <div class="spinner-border text-danger loadingRemove${item.id_product}" role="status" style="display:none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                            </td>
                            <td><input type="hidden" class="form-control" name="id_product[]" value="${item.id_product}" readonly></td>
                        </tr>
                        `)

                        // update jumlah cart
                        $('.cart_jumlah' + item.id_product).on('input', function() {
                            var id = $('.cart_jumlah' + item.id_product).data('id_product')
                            var newJumlah = $('.cart_jumlah' + item.id_product).val()
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url(); ?>update-cart/" + id,
                                data: {
                                    id_product: id,
                                    jumlah: newJumlah,
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    getData()
                                }
                            });
                        });

                        // delete cart berdasarkan id
                        $('.delete-cart' + item.id_product).on('click', function() {
                            $('.loadingRemove' + item.id_product).show()
                            $('.delete-cart' + item.id_product).hide()
                            $.ajax({
                                type: "get",
                                url: "<?= base_url(); ?>delete-cart/" + item.id_product,
                                dataType: "JSON",
                                success: function(namaProduct) {
                                    getData()
                                    $('.loadingRemove' + item.id_product).hide()
                                    $('.delete-cart' + item.id_product).show()
                                    $('#kembalian').val('')
                                    $('#bayar').val('')
                                    $('#kode_product').focus()
                                }
                            });
                        });
                    });

                    // tampilan total jumlah
                    $('tbody').append(`
                        <tr>
                            <td class="font-weight-bold">Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="text" class="form-control" name="totalCart" value="${totalCart}" readonly></td>
                        </tr>
                    `)

                    // hitung total kembalian uang
                    $('#bayar').on('input', function() {
                        var bayar = $('#bayar').val()
                        var totalBayar = bayar - totalCart

                        $('#kembalian').val(totalBayar)
                    })
                }
            });
        }

        // cetak struk
        $('#loadingBayar').hide();
        $('#loadingBersihkan').hide();

        $('#formBayar').on('submit', function(event) {
            // event.preventDefault();

            $('#addBayar').hide();
            $('#loadingBayar').show();

            // var bayar = $('#bayar').val()
            // var kembalian = $('#kembalian').val()

            // window.open('<?= base_url(); ?>cetak-struk/' + bayar + '/' + kembalian, "_blank")

            setTimeout(function() {
                $('#addBayar').show();
                $('#loadingBayar').hide();
                $('#kode_product').focus()
            }, 300)
        })

        // loading hapus data bayar

        $('#bersihkan').on('click', function() {
            $('#bersihkan').hide();
            $('#loadingBersihkan').show();

            setTimeout(function() {
                $.ajax({
                    type: "get",
                    url: "<?= base_url(); ?>delete-cart",
                    dataType: "JSON",
                    success: function(response) {
                        getData()
                        $('#kembalian').val('')
                        $('#bayar').val('')
                        $('#kode_product').focus()
                    }
                });
                $('#bersihkan').show();
                $('#loadingBersihkan').hide();
            }, 300)
        })
    </script>
</body>

</html>