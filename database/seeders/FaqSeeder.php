<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Faq::upsert([
            [
                'question' => 'Bagaimana cara membeli saham?',
                'answer' => 'Cara membeli saham adalah dengan menekan tombol keranjang pada tabel penjualan saham. Kemudian isi jumlah saham yang ingin dibeli dan tekan tombol beli. Jika transaksi berhasil, maka saham akan masuk ke portofolio Anda.',
                'category' => 'Pembelian',
                'role' => 'user'
            ], [
                'question' => 'Bagaimana cara menjual saham?',
                'answer' => 'Cara menjual saham adalah dengan menekan tombol jual saham pada dashboard pojok kanan atas. Pilih saham yang ingin dijual dan kemudian isi jumlah saham yang ingin dijual dan tekan tombol jual.',
                'category' => 'Penjualan',
                'role' => 'user'
            ], [
                'question' => 'Apa itu EPS?',
                'answer' => 'EPS adalah Earning Per Share. EPS adalah rasio keuntungan perusahaan yang dibagi dengan jumlah saham yang dikeluarkan. EPS dapat digunakan untuk menilai seberapa besar keuntungan yang didapat perusahaan.',
                'category' => 'Rasio Keuangan',
                'role' => 'user'
            ], [
                'question' => 'Apa itu PBV?',
                'answer' => 'PBV adalah Price to Book Value. PBV adalah rasio harga saham dibagi dengan nilai buku per saham. Nilai buku per saham adalah jumlah aset perusahaan dikurangi dengan jumlah liabilitas perusahaan dibagi dengan jumlah saham yang dikeluarkan.',
                'category' => 'Rasio Keuangan',
                'role' => 'user'
            ], [
                'question' => 'Bagaimana cara mengidentifikasi saham yang bagus?',
                'answer' => 'Cara mengidentifikasi saham yang bagus adalah dengan membandingkan rasio keuangan saham dengan rasio keuangan perusahaan lainnya.',
                'category' => 'Rasio Keuangan',
                'role' => 'user'
            ], [
                'question' => 'Bagaimana cara menentukan harga saham yang bagus?',
                'answer' => 'Cara menentukan harga saham yang bagus adalah dengan membandingkan harga saham dengan rasio keuangan perusahaan.',
                'category' => 'Rasio Keuangan',
                'role' => 'company'
            ], [
                'question' => 'Bagaimana cara menambahkan saham?',
                'answer' => 'Cara menambahkan saham adalah dengan menekan tombol tambah saham pada dashboard pojok kanan atas. Kemudian isi data saham yang ingin ditambahkan dan tekan tombol tambah.',
                'category' => 'Penjualan',
                'role' => 'company'
            ], [
                'question' => 'Apakah saya bisa menghapus saham?',
                'answer' => 'Anda tidak bisa menghapus saham. Anda hanya bisa mengubah data saham dan jumlahnya hanya sejumlah yang anda miliki.',
                'category' => 'Penjualan',
                'role' => 'company'
            ], [
                'question' => 'Bagaimana cara mengubah data saham?',
                'answer' => 'Cara mengubah data saham adalah dengan menekan tombol ubah pada tabel penjualan saham. Kemudian isi data saham yang ingin diubah dan tekan tombol ubah. Jika transaksi berhasil, maka data saham akan terupdate.',
                'category' => 'Penjualan',
                'role' => 'company'
            ], [
                'question' => 'Bagaimana cara mengubah data perusahaan?',
                'answer' => 'Cara mengubah data perusahaan adalah dengan menekan tombol ubah pada dashboard pojok kanan atas. Kemudian isi data perusahaan yang ingin diubah dan tekan tombol ubah.',
                'category' => 'Perusahaan',
                'role' => 'company'
            ], [
                'question' => 'Bagaimana cara mengubah data profil?',
                'answer' => 'Cara mengubah data profil adalah dengan menekan tombol ubah pada dashboard pojok kanan atas. Kemudian isi data profil yang ingin diubah dan tekan tombol ubah.',
                'category' => 'Profil',
                'role' => 'user'
            ], [
                'question' => 'Bagaimana cara mengubah data akun?',
                'answer' => 'Cara mengubah data akun adalah dengan menekan tombol ubah pada dashboard pojok kanan atas. Kemudian isi data akun yang ingin diubah dan tekan tombol ubah. ',
                'category' => 'Akun',
                'role' => 'company'
            ], [
                'question' => 'Bagaimana cara mengubah data akun?',
                'answer' => 'Cara mengubah data akun adalah dengan menekan tombol ubah pada dashboard pojok kanan atas. Kemudian isi data akun yang ingin diubah dan tekan tombol ubah.',
                'category' => 'Akun',
                'role' => 'user'
            ]
        ], ['question', 'answer', 'category', 'role']);
    }
}
