<?php

namespace App\Controllers;

use App\Models\M_Product;
use App\Models\M_RiwayatTransaksi;
use App\Controllers\Settings;
use stdClass;

class C_Kasir extends BaseController
{
    public function __construct()
    {
        $this->product = new M_Product();
        $this->riwayatTransaksi = new M_RiwayatTransaksi();
        $this->settings = new Settings();
    }

    public function index()
    {
        $user = session('user');
        $data['nama'] = $user['nama'];
        $data['tanggal'] = date('Y-m-d');
        return view('kasir/kasir', $data);
    }

    public function kodeTransaksi()
    {
        $lastKode = $this->riwayatTransaksi->select('no_faktur')->orderBy('id_riwayatTransaksi', 'DESC')->first();
        $data = new stdClass();
        $kodeTransaksi = 'TRX-' . substr(date('Y'), -2) . date('m') . date('d') . '001';

        if ($lastKode) {
            $lastKode = $lastKode->no_faktur;
            $lastThreeDigits = substr($lastKode, -3);
            $newKode = 'TRX-' . substr(date('Y'), -2) . date('m') . date('d')  . str_pad((int)$lastThreeDigits + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newKode = $kodeTransaksi;
        }
        $data->newKode = $newKode;
        return $this->response->setJSON(['success' => $data]);
    }

    public function tambah($id)
    {
        $cart = session('cart') ?? [];
        $data = $this->product->where('kode_product', $id)->first();
        $jumlahInput = $this->request->getPost('jumlah');
        if (array_key_exists($data->id_product, $cart)) {
            $cart[$data->id_product]['jumlah'] += $jumlahInput;
        } else {
            $cart[$data->id_product] = [
                'id_product' => $data->id_product,
                'kode_product' => $data->kode_product,
                'nama_product' => $data->nama_product,
                'harga_jual' => $data->harga_jual,
                'jumlah' => $jumlahInput,
            ];
        }
        session()->set('cart', $cart);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function showCart($id)
    {
        $data = $this->product->where('kode_product', $id)->first();
        return $this->response->setJSON(['success' => $data]);
    }

    public function updateCart($id)
    {
        $data = esc($this->request->getPost());
        $cart = session('cart') ?? [];
        if (array_key_exists($id, $cart)) {
            $cart[$id]['jumlah'] = $data['jumlah'];
        }
        session()->set('cart', $cart);
        return $this->response->setJSON(['success', 'success']);
    }

    public function show()
    {
        $cart = session('cart') ?? [];
        $data = $cart;
        return $this->response->setJSON(['cart_data' => $data]);
    }

    public function removeCart()
    {
        session()->remove('cart');
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteCart($id)
    {
        $cart = session('cart') ?? [];
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->set('cart', $cart);
        }
        return $this->response->setJSON(['status' => 'success']);
    }

    public function addCart()
    {
        $noFaktur = $this->request->getPost('no_faktur');
        $kasir = $this->request->getPost('kasir');
        $data = $this->request->getPost();
        $total = $this->request->getPost('total');

        $product = $this->product->whereIn('id_product', $data['id_product'])->findAll();
        $sukses = false;

        // jika nama product kosong redirect back
        if (!isset($data['nama_product'])) {
            return redirect()->back();
        }
        // looping jumlah product dan kode product berdasarkan id dari $product
        foreach ($product as $key => $value) {
            $jumlah[] = $value->jumlah;
            $kodeProduct[] = $value->kode_product;
            $hargaBeli[] = $value->harga_beli;
        }
        // Loop melalui data produk yang dikirimkan dari formulir
        foreach ($data['nama_product'] as $key => $nama_product) {
            // Tambahkan setiap produk ke dalam array secara terpisah
            $cartData[] = [
                'no_faktur' => $noFaktur,
                'kode_product' => $kodeProduct[$key],
                'kasir' => $kasir,
                'nama_product' => $nama_product,
                'id_product' => $data['id_product'][$key],
                'harga_jual' => $data['harga_jual'][$key],
                'harga_beli' => $hargaBeli[$key],
                'jumlah' => $data['jumlah'][$key],
                'total' => $total[$key],
                'bayar' => $data['bayar'],
                'kembalian' => $data['kembalian'],
            ];
        }

        // mencari id_product banyak data serta mengurangkan jumlah $product - jumlah dari $cartData dan update jumlahnya di database
        foreach ($cartData as $key => $value) {
            if (isset($jumlah[$key])) {
                $id_product = $product[$key]->id_product;
                $hasil = $jumlah[$key] - $value['jumlah'];
                $kembalian = $value['kembalian'];
                if ($hasil >= 0 && $kembalian >= 0) {
                    $this->product->update($id_product, ['jumlah' => $hasil]);
                    $sukses = true;
                } else {
                    $this->settings->allert('Oops', 'Data gagal ditambahkan', 'error');
                    return redirect()->back();
                }
            }
        }
        if ($sukses == true) {
            $this->riwayatTransaksi->insertBatch($cartData);
            session()->remove('cart');
            return redirect()->back();
        }
    }

    public function cetak($bayar, $kembalian)
    {
        return view('kasir/cetak', ['bayar' => $bayar, 'kembalian' => $kembalian]);
    }
}
