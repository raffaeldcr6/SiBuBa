<?php

class BookingModel {

    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function cekBooking($user_id, $anak_id, $jadwal_id) {
        $query = mysqli_query($this->koneksi, "
            SELECT * FROM booking
            WHERE user_id='$user_id'
            AND anak_id='$anak_id'
            AND jadwal_id='$jadwal_id'
        ");

        return mysqli_num_rows($query);
    }

    public function tambahBooking($user_id, $anak_id, $jadwal_id) {
        return mysqli_query($this->koneksi, "
            INSERT INTO booking
            (user_id, anak_id, jadwal_id, status)
            VALUES
            ('$user_id', '$anak_id', '$jadwal_id', 'terdaftar')
        ");
    }

    public function getHistoriBooking($user_id) {
        return mysqli_query($this->koneksi, "
            SELECT 
                b.*,
                a.nama_anak,
                a.jenis_kelamin,
                j.nama_kegiatan,
                j.kategori,
                j.tanggal,
                j.jam_mulai,
                j.jam_selesai,
                j.lokasi
            FROM booking b
            JOIN anak a ON b.anak_id = a.id
            JOIN jadwal_posyandu j ON b.jadwal_id = j.id
            WHERE b.user_id='$user_id'
            ORDER BY b.created_at DESC
        ");
    }
}
?>