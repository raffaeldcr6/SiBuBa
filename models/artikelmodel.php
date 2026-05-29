<?php

class ArtikelModel {

    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function getSemuaArtikel() {
        return mysqli_query(
            $this->koneksi,
            "SELECT * FROM artikel
            ORDER BY tanggal DESC"
        );
    }

    public function getArtikelById($id) {
        $id = mysqli_real_escape_string($this->koneksi, $id);

        return mysqli_query(
            $this->koneksi,
            "SELECT * FROM artikel 
            WHERE id='$id'"
        );
    }

    public function getAllArtikel($cari = '') {
        $cari = mysqli_real_escape_string($this->koneksi, $cari);

        $where = "";

        if ($cari != '') {
            $where = "WHERE judul LIKE '%$cari%' 
            OR isi_artikel LIKE '%$cari%'";
        }

        return mysqli_query(
            $this->koneksi,
            "SELECT *
            FROM artikel
            $where
            ORDER BY tanggal DESC"
        );
    }

    public function getArtikelByIdArray($id) {
        $id = mysqli_real_escape_string($this->koneksi, $id);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT *
            FROM artikel
            WHERE id='$id'"
        );

        return mysqli_fetch_assoc($query);
    }

    public function tambahArtikel($data, $foto) {
        $judul = mysqli_real_escape_string(
            $this->koneksi,
            $data['judul']
        );

        $isi_artikel = mysqli_real_escape_string(
            $this->koneksi,
            $data['isi_artikel']
        );

        $foto = mysqli_real_escape_string(
            $this->koneksi,
            $foto
        );

        return mysqli_query(
            $this->koneksi,
            "INSERT INTO artikel
            (
                judul,
                isi_artikel,
                foto,
                tanggal
            )
            VALUES
            (
                '$judul',
                '$isi_artikel',
                '$foto',
                NOW()
            )"
        );
    }

    public function updateArtikel($id, $data, $foto) {
        $id = mysqli_real_escape_string(
            $this->koneksi,
            $id
        );

        $judul = mysqli_real_escape_string(
            $this->koneksi,
            $data['judul']
        );

        $isi_artikel = mysqli_real_escape_string(
            $this->koneksi,
            $data['isi_artikel']
        );

        $foto = mysqli_real_escape_string(
            $this->koneksi,
            $foto
        );

        return mysqli_query(
            $this->koneksi,
            "UPDATE artikel SET
                judul='$judul',
                isi_artikel='$isi_artikel',
                foto='$foto'
            WHERE id='$id'"
        );
    }

    public function hapusArtikel($id) {
        $id = mysqli_real_escape_string(
            $this->koneksi,
            $id
        );

        return mysqli_query(
            $this->koneksi,
            "DELETE FROM artikel
            WHERE id='$id'"
        );
    }
}

?>