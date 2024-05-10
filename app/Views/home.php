<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Dashboard</title>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selamat Datang <?= session('user')['nama']; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $product; ?></h3>

                            <p>Stok produk</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                        </div>
                        <a href="<?= base_url(); ?>product" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 style="font-size: 35px;">Rp. <?= number_format($pendapatan, 2, ',', '.'); ?></h3>
                            <p>Pendapatan bulan ini</p>
                        </div>
                        <div class="icon">
                            <i class="icon fas fa-dollar-sign"></i>
                        </div>
                        <a href="<?= base_url(); ?>riwayat-penjualan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $jumlahTerjual; ?></h3>

                            <p>Produk terjual bulan ini</p>
                        </div>
                        <div class="icon">
                            <i class="icon fas fa-chart-line"></i>
                        </div>
                        <a href="<?= base_url(); ?>riwayat-penjualan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?= $stokMasuk; ?></h3>

                            <p>Stok masuk bulan ini</p>
                        </div>
                        <div class="icon">
                            <i class="icon fas fa-chart-line"></i>
                        </div>
                        <a href="<?= base_url(); ?>stok-masuk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $stokKeluar; ?></h3>

                            <p>Stok keluar bulan ini</p>
                        </div>
                        <div class="icon">
                            <i class="icon fas fa-chart-line"></i>
                        </div>
                        <a href="<?= base_url(); ?>stok-keluar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>