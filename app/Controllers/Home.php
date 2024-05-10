<?php

namespace App\Controllers;

use App\Models\M_Product;
use App\Models\M_RiwayatTransaksi;
use App\Models\M_StokKeluar;
use App\Models\M_StokMasuk;

class Home extends BaseController
{
    public function index()
    {
        $this->product = new M_Product();
        $this->riwayatTransaksi = new M_RiwayatTransaksi();
        $this->stokKeluar = new M_StokKeluar();
        $this->stokMasuk = new M_StokMasuk();
        $date = date("Y-m-d H:i:s");
        $dateMonth = date("Y-m-01 H:i:s");

        $data['product'] = $this->product->selectCount('id_product')->first()->id_product;
        $hargaJual = $this->riwayatTransaksi->where('created_at >=', $dateMonth)->where('created_at <=', $date)->selectSum('harga_jual')->first()->harga_jual;
        $hargaBeli = $this->riwayatTransaksi->where('created_at >=', $dateMonth)->where('created_at <=', $date)->selectSum('harga_beli')->first()->harga_beli;

        $data['jumlahTerjual'] = $this->riwayatTransaksi->where('created_at >=', $dateMonth)->where('created_at <=', $date)->selectSum('jumlah')->first()->jumlah;
        $data['stokMasuk'] = $this->stokMasuk->where('tanggal >=', date("Y-m-01"))->where('tanggal <=', date("Y-m-d"))->selectCount('id_stokMasuk')->first()->id_stokMasuk;
        $data['stokKeluar'] = $this->stokKeluar->where('tanggal >=', date("Y-m-01"))->where('tanggal <=', date("Y-m-d"))->selectCount('id_stokKeluar')->first()->id_stokKeluar;
        $data['pendapatan'] = $hargaJual - $hargaBeli;
        // dd($dateMonth);
        return view('home', $data);
    }
}
