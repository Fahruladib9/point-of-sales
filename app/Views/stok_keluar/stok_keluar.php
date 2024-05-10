<?= $this->extend('layout/default'); ?>

<?= $this->section('title'); ?>
<title>Stok Keluar</title>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tabel Stok Keluar</h1>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-secondary mt-4 px-3 ml-3" data-toggle="modal" data-target="#exampleModal">
                        Add Data
                    </button>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">stok-keluar</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url(); ?>stok-keluar/tambah" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group kode_transaksi">
                                <label for="kode_transaksi">Kode Transaksi</label>
                                <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" value="<?= $kode_transaksi; ?>" readonly required>
                            </div>
                            <div class="form-group kode_product ml-3">
                                <label for="kode_product">Kode Product</label>
                                <input type="text" class="form-control" id="kode_product" name="kode_product" readonly required>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="nama_product">Nama Product</label>
                            <select class="form-control searchselect" name="nama_product" id="nama_product" required>
                                <option value="">-- Pilih Product --</option>
                                <?php foreach ($product as $key => $value) : ?>
                                    <option value="<?= $value->nama_product; ?>"><?= $value->nama_product; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group jumlah_stok">
                            <label for="jumlah_stok">Jumlah Stok</label>
                            <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" readonly>
                        </div>
                        <div class="form-group jumlah">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" oninput="showData()" min="0" required>
                        </div>
                        <div class="form-group keterangan">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <div class="form-group tanggal">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> <?= session()->getFlashdata('error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Transaksi</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stok_keluar as $key => $value) : ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $value->kode_transaksi; ?></td>
                                            <td><?= $value->nama_product; ?></td>
                                            <td><?= $value->jumlah; ?></td>
                                            <td><?= $value->keterangan; ?></td>
                                            <td><?= date("d-m-Y", strtotime($value->tanggal)); ?></td>
                                            <td class="text-center">
                                                <form action="<?= base_url(); ?>delete-stok-keluar/<?= $value->id_stokKeluar; ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin mau hapus data?')">
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
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
    $('.kode_transaksi').hide()
    $('.kode_product').hide()
    $('.jumlah_stok').hide()
    $('.jumlah').hide()
    $('.keterangan').hide()
    $('.tanggal').hide()


    $('#nama_product').on('change', function(e) {
        var nama = $('#nama_product').val()
        $.ajax({
            type: "GET",
            url: "<?= base_url(); ?>show-data-keluar/" + nama,
            dataType: "JSON",
            success: function(response) {
                // tampilkan data
                var data = response.success
                $('.kode_transaksi').show()
                $('.kode_product').show()
                $('.jumlah_stok').show()
                $('.jumlah').show()
                $('.keterangan').show()
                $('.tanggal').show()
                // isi dengan data
                $('#kode_product').val(data.kode_product)
                $('#jumlah_stok').val(data.jumlah)
            }
        });

    })
</script>
<?= $this->endSection(); ?>