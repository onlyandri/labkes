<?php
date_default_timezone_set('Asia/Jakarta');

// fungsi tampil alert
function alert($tipe, $msg)
{

    if ($tipe == 'danger') {
        $tampil =   "
                        <div class='alert alert-danger alert-dismissible animated fadeIn' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong>Maaf!</strong> $msg.
                        </div>
                    ";
    } else {
        $tampil =   "
                        <div class='alert alert-success alert-dismissible animated fadeIn' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong>Sukses!</strong> $msg.
                        </div>
                    ";
    }

    return $tampil;
}

// ==================================================================== pesan berhasil
function tampilPesan($title, $pesan, $tipe, $halaman = "")
{
    // jika tidak pindah halaman
    if ($halaman == "") {
        $alert = '
                    setTimeout(function () {
                        swal({
                            title: "' . $title . '",
                            text: "' . $pesan . '", 
                            type: "' . $tipe . '",  
                            showConfirmButton: true
                        });
                    }, 0);
        ';
        echo '<script type="text/javascript">' . $alert . '</script>';
    } else { // jika pindah halaman
        $alert = '
                    setTimeout(function () {
                        swal({
                            title: "' . $title . '",
                            text: "' . $pesan . '", 
                            type: "' . $tipe . '",  
                            showConfirmButton: false 
                        });
                    }, 0);
        ';
        $pindah_halaman = 'setTimeout(function(){window.top.location="' . $halaman . '"} , 2000);';
        echo '<script type="text/javascript">' . $alert . $pindah_halaman . '</script>';
    }
}

// fungsi jika tidak ada data
function angka($nilai)
{
    if (!empty($nilai)) {
        $tampil = $nilai;
    } else {
        $tampil = 0;
    }

    return $tampil;
}

// fungsi menampilkan pembeli
function pembeli($parm)
{
    if (!empty($parm)) {
        $tampil = $parm;
    } else {
        $tampil = 'Pembeli Biasa';
    }

    return $tampil;
}

// fungsi nominal uang
function uang($nilai)
{
    if ($nilai) {
        $hasil = number_format($nilai, 0, ",", ".");
    }
    if ($nilai == 0) {
        $hasil = "0";
    }
    if ($nilai == null) {
        $hasil = "0";
    }

    return $hasil;
}

// fungsi tanggal full
function fullDate($tanggal = "")
{
    if ($tanggal) {
        $hari           = date('D', strtotime($tanggal));
        $tgl            = date('d', strtotime($tanggal));
        $bulan          = date('m', strtotime($tanggal));
        $tahun          = date('Y', strtotime($tanggal));

        $indo_hari = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );

        $indo_bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        $tampil_tanggal = $indo_hari[$hari] . ', ' . $tgl . ' ' . $indo_bulan[$bulan] . ' ' . $tahun;
    } else {
        $tampil_tanggal = '-';
    }

    return $tampil_tanggal;
}

// fungsi tanggal -> 17 Agustus 1945
function longDate($tanggal = "")
{
    if ($tanggal) {
        $tgl            = date('d', strtotime($tanggal));
        $bulan          = date('m', strtotime($tanggal));
        $tahun          = date('Y', strtotime($tanggal));

        $indo_bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        $tampil_tanggal = $tgl . ' ' . $indo_bulan[$bulan] . ' ' . $tahun;
    } else {
        $tampil_tanggal = '-';
    }

    return $tampil_tanggal;
}

// fungsi bulan romawi
function blnSingkat($tanggal = "")
{
    if ($tanggal) {

        $tgl            = $tanggal;

        $indo_bulan = array(
            '1' => 'Jan',
            '2' => 'Feb',
            '3' => 'Mar',
            '4' => 'Apr',
            '5' => 'Mei',
            '6' => 'Jun',
            '7' => 'Jul',
            '8' => 'Agst',
            '9' => 'Sep',
            '10' => 'Okt',
            '11' => 'Nop',
            '12' => 'Des'
        );

        $bulan_romawi = $indo_bulan[$tgl];
    }

    return $bulan_romawi;
}

// fungsi tanggal -> 17 Agustus 1945
function blnFull($bulan = "")
{
    if ($bulan) {

        $indo_bulan = array(
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        $tampil_bulan = $indo_bulan[$bulan];
    } else {
        $tampil_bulan = '-';
    }
    return $tampil_bulan;
}

// fungsi tanggal -> 17 Agustus 1945
function blnString($bulan = "")
{
    if ($bulan) {

        $indo_bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        $tampil_bulan = $indo_bulan[$bulan];
    } else {
        $tampil_bulan = '-';
    }
    return $tampil_bulan;
}

// Fungsi Umur
function umur($tanggal_lahir)
{
    $birthDate = new DateTime($tanggal_lahir);
    $today = new DateTime("today");
    if ($birthDate > $today) {
        exit("0 tahun 0 bulan 0 hari");
    }
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->days;
    $umur = '';
    if ($y > 0) {
        $umur = $y . " tahun";
    } else if ($y <= 0 and $m > 0) {
        $umur = $m . " bulan";
    } else {
        $umur = $d . " hari";
    }

    return $umur;
}

// mengganti Byte ke 
function cbTerpilih($value, $data)
{
    if ($value == $data) {
        echo "selected";
    } else {
        echo "";
    }
}
// mengganti Byte ke 
function terconteng($value, $data)
{
    if ($value == $data) {
        echo "checked";
    } else {
        echo "";
    }
}
// ===PR
function listItem($nilai)
{
    if ($nilai) {
        $string_nilai   = $nilai;
        $potongan_nilai = explode(", ", $string_nilai);
        $kata1        = $potongan_nilai[0];
        $kata2        = $potongan_nilai[1];
        $nilai_tampil      = "'$kata1', '$kata2'";
    }

    return $nilai_tampil;
}

// fungsi tanggal sql
function tglSql($tanggal = "")
{
    if ($tanggal) {
        $string_tgl   = $tanggal;
        $potongan_tgl = explode("/", $string_tgl);
        $tgl          = $potongan_tgl[0];
        $bulan        = $potongan_tgl[1];
        $tahun        = $potongan_tgl[2];
        $tgl_sql      = $tahun . '-' . $bulan . '-' . $tgl;
    }

    return $tgl_sql;
}
// fungsi tanggal encrypt
function tglEncrypt($tanggal)
{
    if ($tanggal) {
        $string_tgl   = $tanggal;
        $potongan_tgl = explode("-", $string_tgl);
        $tgl          = $potongan_tgl[0];
        $bulan        = $potongan_tgl[1];
        $tahun        = $potongan_tgl[2];
        $tgl_enc      = $tahun . 'asdc' . $bulan . 'aqwd' . $tgl;
    }

    return $tgl_enc;
}
// fungsi tanggal derypt
function tglDerypt($tanggal)
{
    if ($tanggal) {
        $string_tgl   = $tanggal;
        $potongan_tgl = explode("a", $string_tgl);
        $tgl          = $potongan_tgl[0];
        $bulan        = $potongan_tgl[1];
        $tahun        = $potongan_tgl[2];
        $tgl_enc      = $tahun . '-' . $bulan . '-' . $tgl;
    }

    return $tgl_enc;
}
// fungsi tanggal sql
function tglIndo($tanggal = "")
{
    if ($tanggal) {
        $string_tgl   = $tanggal;
        $potongan_tgl = explode("-", $string_tgl);
        $tgl          = $potongan_tgl[2];
        $bulan        = $potongan_tgl[1];
        $tahun        = $potongan_tgl[0];

        if ($bulan != '00') {
            $tampil      = $tgl . '/' . $bulan . '/' . $tahun;
        } else {
            $tampil      = '-';
        }
    } else {
        $tampil      = '-';
    }

    return $tampil;
}

// fungsi hanya angka
function hanyaAngka($nilai = 0)
{
    $tampil = preg_replace("/[^0-9]/", "", $nilai);
    return $tampil;
}

// fungsi hanya angka
function namaDepan($text)
{
    $potongan_nama = explode(" ", $text);
    $nama_depan    = $potongan_nama[0];
    return $nama_depan;
}
// fungsi tanggal indonesia
function tglIndo2($tanggal = "")
{
    if ($tanggal) {
        $string_tgl   = $tanggal;
        $potongan_tgl = explode("-", $string_tgl);
        $tahun        = $potongan_tgl[0];
        $bulan        = $potongan_tgl[1];
        $tgl          = $potongan_tgl[2];
        $tgl_sql      = $tgl . '/' . $bulan . '/' . $tahun;
    }

    return $tgl_sql;
}
// fungsi awalrange
function awalRange($range)
{
    if ($range) {
        $string_range   = $range;
        $potongan_range = explode(" - ", $string_range);
        $awal_range     = $potongan_range[0];
        $potongan_tgl   = explode("/", $awal_range);
        $tgl            = $potongan_tgl[0];
        $bulan          = $potongan_tgl[1];
        $tahun          = $potongan_tgl[2];
        $tgl_sql        = $tahun . '-' . $bulan . '-' . $tgl;
    }

    return $tgl_sql;
}
// fungsi akhirrange
function akhirRange($range)
{
    if ($range) {
        $string_range   = $range;
        $potongan_range = explode(" - ", $string_range);
        $akhir_range     = $potongan_range[1];
        $potongan_tgl   = explode("/", $akhir_range);
        $tgl            = $potongan_tgl[0];
        $bulan          = $potongan_tgl[1];
        $tahun          = $potongan_tgl[2];
        $tgl_sql        = $tahun . '-' . $bulan . '-' . $tgl;
    }

    return $tgl_sql;
}

function jam($jam)
{
    if ($jam) {
        $string_jam   = $jam;
        $potongan_jam = explode(":", $string_jam);
        $jam          = $potongan_jam[0];
        $detik        = $potongan_jam[1];
        $jam_enc      = $jam . ':' . $detik;
    }
    return $jam_enc;
}

function selisihBulan($tgl_awal, $tgl_akhir)
{
    $awal  = date_create($tgl_awal);
    $akhir = date_create($tgl_akhir); // waktu sekarang
    $diff  = date_diff($awal, $akhir);

    return $diff->m . ' bulan, ';
}

function level($parm)
{
    if ($parm) {
        if ($parm == 'A') {
            $tampil = "Admin";
        } else if ($parm == 'G') {
            $tampil = "Guru";
        } else if ($parm == 'S') {
            $tampil = "Siswa";
        } else {
            $tampil = "Wali Siswa";
        }
    } else {
        $tampil = "???";
    }
    return $tampil;
}

function statusUser($parm)
{
    if ($parm == 1) {
        $tampil = "Aktif";
    } else {
        $tampil = "Blokir";
    }
    return $tampil;
}

function kelamin($kel)
{
    if ($kel == 'L') {
        $tampil = "Laki-laki";
    } else {
        $tampil = "Perempuan";
    }
    return $tampil;
}

function newId($max_id, $jenis)
{
    if ($jenis == 'Pasien') {
        $awal_id = 'PS';
    } else if ($jenis == 'Barang') {
        $awal_id = 'BR';
    } else if ($jenis == 'Keluar') {
        $awal_id = 'BK';
    } else if ($jenis == 'TMasuk') {
        $awal_id = 'TM';
    } else if ($jenis == 'TKeluar') {
        $awal_id = 'TK';
    } else {
        $awal_id = 'RM';
    }

    // $awal_id = substr($max_id, 0, 1);
    $tgl_id  = substr($max_id, 2, 4);
    $no_id   = substr($max_id, 6);

    $tgl_sekarang = date("ym");

    if ($tgl_id == $tgl_sekarang) {
        $no_id_baru = $no_id + 1;
    } else {
        $no_id_baru = 1;
    }

    if ($no_id_baru <= 9) {
        $id_baru = $awal_id . $tgl_sekarang . '0' . $no_id_baru;
    } else {
        $id_baru = $awal_id . $tgl_sekarang . $no_id_baru;
    }

    return $id_baru;
}
