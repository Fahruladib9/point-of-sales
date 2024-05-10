<?php

namespace App\Controllers\Data_Barang;

use App\Controllers\BaseController;
use App\Controllers\Settings;
use App\Models\M_RiwayatTransaksi;

class C_RiwayatPenjualan extends BaseController
{

    public function __construct()
    {
        $this->settings = new Settings();
        $this->riwayatTransaksi = new M_RiwayatTransaksi();
    }

    public function index()
    {
        $data['riwayat'] = $this->riwayatTransaksi->orderBy('id_riwayatTransaksi', 'DESC')->findAll();
        return view('riwayat_penjualan/riwayat_penjualan', $data);
    }

    public function delete($id)
    {
        $this->riwayatTransaksi->delete($id);
        $this->settings->allert('Sukses', 'Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
