<?php

class UserModel {

    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function register($data) {

        $nik = mysqli_real_escape_string($this->koneksi, $data['nik']);
        $nama = mysqli_real_escape_string($this->koneksi, $data['nama']);
        $email = mysqli_real_escape_string($this->koneksi, $data['email']);
        $alamat = mysqli_real_escape_string($this->koneksi, $data['alamat']);
        $nohp = mysqli_real_escape_string($this->koneksi, $data['nohp']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = 'user';

        $query = mysqli_query(
            $this->koneksi,
            "INSERT INTO users 
            (nik, nama, email, alamat, nohp, password, role)
            VALUES
            ('$nik', '$nama', '$email', '$alamat', '$nohp', '$password', '$role')"
        );

        return $query;
    }

    public function login($email, $password) {

        $email = mysqli_real_escape_string($this->koneksi, $email);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT * FROM users WHERE email='$email'"
        );

        $user = mysqli_fetch_assoc($query);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getAllUsers() {

        return mysqli_query(
            $this->koneksi,
            "SELECT * FROM users ORDER BY id DESC"
        );
    }

    public function getUserById($id) {

        $id = mysqli_real_escape_string($this->koneksi, $id);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT * FROM users WHERE id='$id'"
        );

        return mysqli_fetch_assoc($query);
    }

    public function tambahUser($data) {

        $nik = isset($data['nik']) ? mysqli_real_escape_string($this->koneksi, $data['nik']) : '';
        $nama = mysqli_real_escape_string($this->koneksi, $data['nama']);
        $email = mysqli_real_escape_string($this->koneksi, $data['email']);
        $alamat = isset($data['alamat']) ? mysqli_real_escape_string($this->koneksi, $data['alamat']) : '';
        $nohp = isset($data['nohp']) ? mysqli_real_escape_string($this->koneksi, $data['nohp']) : '';
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = mysqli_real_escape_string($this->koneksi, $data['role']);

        return mysqli_query(
            $this->koneksi,
            "INSERT INTO users
            (nik, nama, email, alamat, nohp, password, role)
            VALUES
            ('$nik', '$nama', '$email', '$alamat', '$nohp', '$password', '$role')"
        );
    }

    public function updateUser($id, $data) {

        $id = mysqli_real_escape_string($this->koneksi, $id);
        $nik = isset($data['nik']) ? mysqli_real_escape_string($this->koneksi, $data['nik']) : '';
        $nama = mysqli_real_escape_string($this->koneksi, $data['nama']);
        $email = mysqli_real_escape_string($this->koneksi, $data['email']);
        $alamat = isset($data['alamat']) ? mysqli_real_escape_string($this->koneksi, $data['alamat']) : '';
        $nohp = isset($data['nohp']) ? mysqli_real_escape_string($this->koneksi, $data['nohp']) : '';
        $role = mysqli_real_escape_string($this->koneksi, $data['role']);

        return mysqli_query(
            $this->koneksi,
            "UPDATE users SET
                nik='$nik',
                nama='$nama',
                email='$email',
                alamat='$alamat',
                nohp='$nohp',
                role='$role'
            WHERE id='$id'"
        );
    }

    public function updatePassword($id, $password) {

        $id = mysqli_real_escape_string($this->koneksi, $id);
        $password = password_hash($password, PASSWORD_DEFAULT);

        return mysqli_query(
            $this->koneksi,
            "UPDATE users SET password='$password' WHERE id='$id'"
        );
    }

    public function hapusUser($id) {

        $id = mysqli_real_escape_string($this->koneksi, $id);

        return mysqli_query(
            $this->koneksi,
            "DELETE FROM users WHERE id='$id'"
        );
    }

    public function cekEmail($email) {

        $email = mysqli_real_escape_string($this->koneksi, $email);

        $query = mysqli_query(
            $this->koneksi,
            "SELECT * FROM users WHERE email='$email'"
        );

        return mysqli_num_rows($query);
    }
}

?>