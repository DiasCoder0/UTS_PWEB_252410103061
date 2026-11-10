<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // =============================================
    // DATA DUMMY STOK AWAL (disimpan sebagai method
    // agar bisa dipakai di beberapa fungsi)
    // =============================================

    private function getStokAwal()
    {
        return [
            ['id' => 1,  'komoditas' => 'Bayam',   'kategori' => 'Sayur', 'jumlah' => 50,  'satuan' => 'kg', 'kualitas' => 'A', 'status' => 'Siap Jual'],
            ['id' => 2,  'komoditas' => 'Kangkung', 'kategori' => 'Sayur', 'jumlah' => 35,  'satuan' => 'kg', 'kualitas' => 'B', 'status' => 'Layak Jual'],
            ['id' => 3,  'komoditas' => 'Tomat',    'kategori' => 'Sayur', 'jumlah' => 40,  'satuan' => 'kg', 'kualitas' => 'C', 'status' => 'Perlu Konversi'],
            ['id' => 4,  'komoditas' => 'Wortel',   'kategori' => 'Sayur', 'jumlah' => 60,  'satuan' => 'kg', 'kualitas' => 'A', 'status' => 'Siap Jual'],
            ['id' => 5,  'komoditas' => 'Cabai',    'kategori' => 'Sayur', 'jumlah' => 25,  'satuan' => 'kg', 'kualitas' => 'B', 'status' => 'Layak Jual'],
            ['id' => 6,  'komoditas' => 'Jagung',   'kategori' => 'Sayur', 'jumlah' => 80,  'satuan' => 'kg', 'kualitas' => 'C', 'status' => 'Perlu Konversi'],
            ['id' => 7,  'komoditas' => 'Pisang',   'kategori' => 'Buah',  'jumlah' => 45,  'satuan' => 'kg', 'kualitas' => 'B', 'status' => 'Layak Jual'],
            ['id' => 8,  'komoditas' => 'Mangga',   'kategori' => 'Buah',  'jumlah' => 30,  'satuan' => 'kg', 'kualitas' => 'A', 'status' => 'Siap Jual'],
            ['id' => 9,  'komoditas' => 'Pepaya',   'kategori' => 'Buah',  'jumlah' => 55,  'satuan' => 'kg', 'kualitas' => 'C', 'status' => 'Perlu Konversi'],
            ['id' => 10, 'komoditas' => 'Jeruk',    'kategori' => 'Buah',  'jumlah' => 40,  'satuan' => 'kg', 'kualitas' => 'A', 'status' => 'Siap Jual'],
            ['id' => 11, 'komoditas' => 'Semangka', 'kategori' => 'Buah',  'jumlah' => 70,  'satuan' => 'kg', 'kualitas' => 'B', 'status' => 'Layak Jual'],
            ['id' => 12, 'komoditas' => 'Nanas',    'kategori' => 'Buah',  'jumlah' => 65,  'satuan' => 'kg', 'kualitas' => 'C', 'status' => 'Perlu Konversi'],
        ];
    }

    // Gabungkan stok awal + barang tambahan dari session
    // lalu kurangi stok sesuai riwayat distribusi
    private function getStokTerkini()
    {
        $stok = $this->getStokAwal();

        // Tambahkan barang baru dari session
        $tambahan = session('stok_tambahan', []);
        foreach ($tambahan as $barang) {
            $stok[] = $barang;
        }

        // Kurangi stok sesuai riwayat distribusi
        $distribusiList = session('riwayat_distribusi', []);
        foreach ($distribusiList as $dist) {
            foreach ($stok as &$item) {
                if ($item['id'] == $dist['id_barang']) {
                    $item['jumlah'] -= $dist['jumlah_distribusi'];
                    // Jika stok habis, tandai
                    if ($item['jumlah'] <= 0) {
                        $item['jumlah'] = 0;
                        $item['status'] = 'Stok Habis';
                    }
                }
            }
        }

        return $stok;
    }

    // =============================================
    // REGISTER
    // =============================================

    public function register()
    {
        return view('register');
    }

    public function prosesRegister(Request $request)
    {
        session([
            'reg_nama'        => $request->nama,
            'reg_username'    => $request->username,
            'reg_password'    => $request->password,
            'reg_no_karyawan' => $request->no_karyawan,
            'reg_jabatan'     => $request->jabatan,
            'reg_mulai_kerja' => $request->mulai_kerja,
        ]);

        return redirect()->route('login');
    }

    // =============================================
    // LOGIN
    // =============================================

    public function login()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        session(['username' => $request->username]);

        return redirect()->route('dashboard')->with('login_success', $request->username);
    }

    // =============================================
    // LOGOUT
    // =============================================

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }

    // =============================================
    // DASHBOARD
    // =============================================

    public function dashboard()
    {
        $username = session('username', 'Pengguna');
        $stok     = $this->getStokTerkini();

        // Hitung statistik dinamis dari stok terkini
        $totalKomoditas  = count($stok);
        $totalStokKg     = array_sum(array_column($stok, 'jumlah'));
        $perluKonversi   = count(array_filter($stok, fn($i) => $i['kualitas'] === 'C' && $i['jumlah'] > 0));
        $produkKonversi  = count(session('riwayat_distribusi', []));

        $statistik = [
            'total_komoditas'  => $totalKomoditas,
            'total_stok_kg'    => $totalStokKg,
            'perlu_konversi'   => $perluKonversi,
            'produk_konversi'  => $produkKonversi,
        ];

        // Ringkasan per kategori
        $sayur = array_filter($stok, fn($i) => $i['kategori'] === 'Sayur');
        $buah  = array_filter($stok, fn($i) => $i['kategori'] === 'Buah');

        $ringkasanKategori = [
            [
                'kategori'       => 'Sayur',
                'emoji'          => '🥦',
                'total_item'     => count($sayur),
                'total_kg'       => array_sum(array_column($sayur, 'jumlah')),
                'siap_jual'      => count(array_filter($sayur, fn($i) => $i['kualitas'] === 'A')),
                'layak_jual'     => count(array_filter($sayur, fn($i) => $i['kualitas'] === 'B')),
                'perlu_konversi' => count(array_filter($sayur, fn($i) => $i['kualitas'] === 'C')),
                'persen_sehat'   => count($sayur) > 0
                    ? round((count(array_filter($sayur, fn($i) => in_array($i['kualitas'], ['A','B']))) / count($sayur)) * 100)
                    : 0,
            ],
            [
                'kategori'       => 'Buah',
                'emoji'          => '🍎',
                'total_item'     => count($buah),
                'total_kg'       => array_sum(array_column($buah, 'jumlah')),
                'siap_jual'      => count(array_filter($buah, fn($i) => $i['kualitas'] === 'A')),
                'layak_jual'     => count(array_filter($buah, fn($i) => $i['kualitas'] === 'B')),
                'perlu_konversi' => count(array_filter($buah, fn($i) => $i['kualitas'] === 'C')),
                'persen_sehat'   => count($buah) > 0
                    ? round((count(array_filter($buah, fn($i) => in_array($i['kualitas'], ['A','B']))) / count($buah)) * 100)
                    : 0,
            ],
        ];

        return view('dashboard', compact('username', 'statistik', 'ringkasanKategori'));
    }

    // =============================================
    // STOK PANEN
    // =============================================

    public function stokPanen()
    {
        $stokPanen = $this->getStokTerkini();
        return view('stok-panen', compact('stokPanen'));
    }

    // =============================================
    // TAMBAH BARANG
    // =============================================

    public function tambahBarang()
    {
        return view('tambah-barang');
    }

    public function prosesTambahBarang(Request $request)
    {
        // Ambil data tambahan yang sudah ada di session
        $tambahan = session('stok_tambahan', []);

        // Tentukan ID baru (lanjut dari ID terakhir)
        $stokAwal    = $this->getStokAwal();
        $idTerakhir  = count($stokAwal) + count($tambahan);
        $idBaru      = $idTerakhir + 1;

        // Tentukan status berdasarkan kualitas
        $statusMap = [
            'A' => 'Siap Jual',
            'B' => 'Layak Jual',
            'C' => 'Perlu Konversi',
        ];

        // Buat data barang baru
        $barangBaru = [
            'id'        => $idBaru,
            'komoditas' => $request->komoditas,
            'kategori'  => $request->kategori,
            'jumlah'    => (int) $request->jumlah,
            'satuan'    => 'kg',
            'kualitas'  => $request->kualitas,
            'status'    => $statusMap[$request->kualitas],
        ];

        // Simpan ke session
        $tambahan[] = $barangBaru;
        session(['stok_tambahan' => $tambahan]);

        // Redirect ke stok panen dengan pesan sukses
        return redirect()->route('stok-panen')->with('sukses_tambah', $request->komoditas);
    }

    // =============================================
    // DISTRIBUSI BARANG
    // =============================================

    public function distribusi()
    {
        // Ambil semua stok terkini untuk ditampilkan di form
        $stokTersedia = array_filter(
            $this->getStokTerkini(),
            fn($item) => $item['jumlah'] > 0
        );

        // Ambil riwayat distribusi dari session
        $riwayatDistribusi = session('riwayat_distribusi', []);

        return view('distribusi', compact('stokTersedia', 'riwayatDistribusi'));
    }

    public function prosesDistribusi(Request $request)
    {
        $stok        = $this->getStokTerkini();
        $riwayat     = session('riwayat_distribusi', []);

        // Cari data barang yang dipilih
        $barangDipilih = null;
        foreach ($stok as $item) {
            if ($item['id'] == $request->id_barang) {
                $barangDipilih = $item;
                break;
            }
        }

        // Validasi jumlah distribusi tidak melebihi stok
        if ($barangDipilih && $request->jumlah_distribusi <= $barangDipilih['jumlah']) {
            $riwayat[] = [
                'id'                => count($riwayat) + 1,
                'id_barang'         => (int) $request->id_barang,
                'komoditas'         => $barangDipilih['komoditas'],
                'kategori'          => $barangDipilih['kategori'],
                'jumlah_distribusi' => (int) $request->jumlah_distribusi,
                'satuan'            => 'kg',
                'tujuan'            => $request->tujuan,
                'keterangan'        => $request->keterangan ?? '-',
                'tanggal'           => date('Y-m-d'),
            ];

            session(['riwayat_distribusi' => $riwayat]);
            return redirect()->route('distribusi')->with('sukses_distribusi', $barangDipilih['komoditas']);
        }

        // Jika jumlah melebihi stok, kembali dengan pesan error
        return redirect()->route('distribusi')->with('error_distribusi', 'Jumlah distribusi melebihi stok yang tersedia!');
    }

    // =============================================
    // KONVERSI LIMBAH
    // =============================================

    public function konversiLimbah()
    {
        $konversiLimbah = [
            ['id' => 1, 'asal_komoditas' => 'Tomat',  'kategori' => 'Sayur', 'jumlah_masuk' => 40, 'persentase_konversi' => 25, 'jumlah_konversi' => 10, 'satuan' => 'kg', 'jenis_konversi' => 'Fermentasi Anaerob',  'hasil_produk' => 'Pupuk Kompos',  'manfaat' => 'Menyuburkan lahan tanam'],
            ['id' => 2, 'asal_komoditas' => 'Tomat',  'kategori' => 'Sayur', 'jumlah_masuk' => 40, 'persentase_konversi' => 25, 'jumlah_konversi' => 10, 'satuan' => 'kg', 'jenis_konversi' => 'Cacah & Campuran',   'hasil_produk' => 'Pakan Ternak',  'manfaat' => 'Pakan sapi dan kambing'],
            ['id' => 3, 'asal_komoditas' => 'Jagung', 'kategori' => 'Sayur', 'jumlah_masuk' => 80, 'persentase_konversi' => 25, 'jumlah_konversi' => 20, 'satuan' => 'kg', 'jenis_konversi' => 'Fermentasi Anaerob',  'hasil_produk' => 'Pupuk Kompos',  'manfaat' => 'Menyuburkan lahan tanam'],
            ['id' => 4, 'asal_komoditas' => 'Jagung', 'kategori' => 'Sayur', 'jumlah_masuk' => 80, 'persentase_konversi' => 25, 'jumlah_konversi' => 20, 'satuan' => 'kg', 'jenis_konversi' => 'Cacah & Campuran',   'hasil_produk' => 'Pakan Ternak',  'manfaat' => 'Pakan unggas dan babi'],
            ['id' => 5, 'asal_komoditas' => 'Pepaya', 'kategori' => 'Buah',  'jumlah_masuk' => 55, 'persentase_konversi' => 25, 'jumlah_konversi' => 14, 'satuan' => 'kg', 'jenis_konversi' => 'Pengomposan Aerob',   'hasil_produk' => 'Pupuk Organik', 'manfaat' => 'Meningkatkan kualitas tanah'],
            ['id' => 6, 'asal_komoditas' => 'Nanas',  'kategori' => 'Buah',  'jumlah_masuk' => 65, 'persentase_konversi' => 25, 'jumlah_konversi' => 16, 'satuan' => 'kg', 'jenis_konversi' => 'Ekstraksi Enzim',     'hasil_produk' => 'Pakan Ternak',  'manfaat' => 'Pakan sapi mengandung enzim bromelain'],
        ];

        return view('konversi-limbah', compact('konversiLimbah'));
    }

    // =============================================
    // PROFILE
    // =============================================

    public function profile()
    {
        $username = session('username', 'Pengguna');

        $profil = [
            'nama'        => session('reg_nama', 'Dias Faizullah Parvez'),
            'username'    => $username,
            'no_karyawan' => session('reg_no_karyawan', 'KRY-2024-001'),
            'jabatan'     => session('reg_jabatan', 'Pengelola Usaha Tani'),
            'mulai_kerja' => session('reg_mulai_kerja', '2024-01-15'),
        ];

        return view('profile', compact('profil'));
    }
}
