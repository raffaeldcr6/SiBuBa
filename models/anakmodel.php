<?php

class AnakModel {

    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function getJumlahAnak($user_id) {
        $query = mysqli_query(
            $this->koneksi,
            "SELECT * FROM anak WHERE user_id='$user_id'"
        );

        return mysqli_num_rows($query);
    }

    public function getDataAnak($user_id) {
        return mysqli_query(
            $this->koneksi,
            "SELECT * FROM anak 
            WHERE user_id='$user_id'
            ORDER BY id DESC"
        );
    }

    public function getDataAnakLengkap($user_id = null) {
    $where = "";
    if ($user_id !== null) {
        $where = "WHERE a.user_id='$user_id'";
    }

    return mysqli_query(
        $this->koneksi,
        "SELECT a.*, u.nama AS nama_ibu,
        TIMESTAMPDIFF(YEAR, a.tanggal_lahir, CURDATE()) AS umur_tahun,
        TIMESTAMPDIFF(MONTH, a.tanggal_lahir, CURDATE()) AS umur_bulan
        FROM anak a
        LEFT JOIN users u ON a.user_id = u.id
        $where
        ORDER BY a.id DESC"
    );
}

    public function getAnakById($id, $user_id) {
        $query = mysqli_query(
            $this->koneksi,
            "SELECT * FROM anak
            WHERE id='$id'
            AND user_id='$user_id'"
        );

        return mysqli_fetch_assoc($query);
    }

    public function cekNikAnakUpdate($nik_anak, $id) {
        $query = mysqli_query(
            $this->koneksi,
            "SELECT * FROM anak 
            WHERE nik_anak='$nik_anak' 
            AND id != '$id'"
        );

        return mysqli_num_rows($query);
    }

    public function getFotoAnak($id) {
        $query = mysqli_query(
            $this->koneksi,
            "SELECT foto FROM anak WHERE id='$id'"
        );

        return mysqli_fetch_assoc($query);
    }

    public function updateAnak($id, $user_id, $data, $foto) {
        return mysqli_query(
            $this->koneksi,
            "UPDATE anak SET
                nik_anak='{$data['nik_anak']}',
                foto='$foto',
                nama_anak='{$data['nama_anak']}',
                tanggal_lahir='{$data['tanggal_lahir']}',
                jenis_kelamin='{$data['jenis_kelamin']}',
                berat_badan='{$data['berat_badan']}',
                panjang_lahir='{$data['panjang_lahir']}',
                golongan_darah='{$data['golongan_darah']}',
                catatan='{$data['catatan']}'
            WHERE id='$id'
            AND user_id='$user_id'"
        );
    }
}
?>
