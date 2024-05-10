<?php

namespace App\Controllers\Data_Barang;

use App\Controllers\BaseController;
use App\Controllers\Settings;
use App\Models\M_StokKeluar;
use App\Models\M_Product;
use stdClass;

class C_StokKeluar extends BaseController
{

    public function __construct()
    {
        $this->setting = new Settings();
        $this->stokKeluar = new M_stokKeluar();
        $this->product = new M_Product();
    }

    public function index()
    {
        $data['product'] = $this->product->findAll();
        $data['stok_keluar'] = $this->stokKeluar->showData();
        $data['kode_transaksi'] = $this->kode_transaksi()->newKode;
        return view('stok_keluar/stok_keluar', $data);
    }

    public function show($id)
    {
        $data = $this->product->where('nama_product', $id)->first();
        return $this->response->setJSON(['success' => $data]);
    }

    public function kode_transaksi()
    {
        $kodeTerakhir = $this->stokKeluar->select('kode_transaksi')->orderBy('id_stokKeluar', 'DESC')->first();
        $kodeTransaksi = 'TK' . substr(date('Y'), -2) . date('m') . date('d') . '001';
        $data = new stdClass();
        if ($kodeTerakhir) {
            $kodeTerakhir = $kodeTerakhir->kode_transaksi;
            $lastThreeDigits = substr($kodeTerakhir, -3);
            $newKode =  'TK' . substr(date('Y'), -2) . date('m') . date('d') . str_pad((int)$lastThreeDigits + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newKode = $kodeTransaksi;
        }
        $data->newKode = $newKode;
        return $data;
    }

    public function tambah()
    {
        $data = esc($this->request->getPost());
        $product = $this->product->where('nama_product', $data['nama_product'])->first();
        $newJumlah = $product->jumlah -= $data['jumlah'];
        if ($newJumlah < 0) {
            $this->setting->allert('Oops', 'Data gagal ditambahkan', 'error');
            return redirect()->back();
        } else {
            // echo $newJumlah;
            if (!$this->validate([
                'kode_transaksi' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Kode transaksi harus diisi',
                    ],
                ],
                'nama_product' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Nama produk harus diisi',
                    ],
                ],
                'jumlah' => [
                    'rules'  => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah harus diisi',
                        'numeric' => 'Jumlah hanya boleh diisi angka',
                    ],
                ],
                'keterangan' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Keterangan harus diisi',
                    ],
                ],
                'tanggal' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Tanggal harus diisi',
                    ],
                ],
            ])) {
                session()->getFlashdata('error', $this->validator->listErrors());
                return redirect()->back();
            } else {
                $this->stokKeluar->insert([
                    'id_product' => $product->id_product,
                    'kode_transaksi' => $data['kode_transaksi'],
                    'nama_product' => $data['nama_product'],
                    'jumlah' => $data['jumlah'],
                    'keterangan' => $data['keterangan'],
                    'tanggal' => $data['tanggal'],
                ]);
                $this->product->update($product->id_product, [
                    'jumlah' => $newJumlah,
                ]);
                $this->setting->allert('Sukses', 'Data berhasil ditambahkan', 'success');
                return redirect()->back();
            }
        }
    }

    public function delete($id)
    {
        $this->stokKeluar->delete($id);
        $this->setting->allert('Sukses', 'Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
