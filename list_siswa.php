<?php

    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $jumlah_siswa = "SELECT COUNT(*) 'total' FROM tbl_siswa";
        $execute_jumlah_siswa = mysqli_query($_AUTH, $jumlah_siswa);

        $mencari_kelas = "SELECT * FROM `db_kampus`.`tbl_kelas` WHERE `id_kelas` = '1'";
        $executemencarikelas = mysqli_query($_AUTH, $mencari_kelas);

        $wali_kelas = "SELECT nama_guru FROM `db_kampus`.`tbl_guru` WHERE `id_guru` = '$executemencarikelas'";
        $executemencariwali = mysqli_query($_AUTH, $wali_kelas);

        $mencari_datasiswa = "SELECT tbl_siswa.nama_siswa, tbl_siswa.jenis_kelamin, tbl_siswa.alamat, tbl_siswa.email, tbl_siswa.tanggal_terdaftar FROM tbl_siswa";
        
        $response["message"] = "Data dari kelas X berhasil ditampilkan";
        $response["code"] = 201;
        $response["status"] = false;
        $response['total_datasiswa'] = $execute_jumlah_siswa;
        $response['wali_kelas'] = $executemencariwali;
        $response['datasiswa'] = array();

        while ($row = mysqli_fetch_array($mencari_datasiswa)){
            $data = array();

            $data["nama_lengkap"] = $row["nama_lengkap"];
            $data["jenis_kelamin"] = $row["jenis_kelamin"];
            $data["alamat"] = $row["alamat"];
            $data["email"] = $row["email"];
            $data["tanggal_terdaftar"] = $row["tanggal_terdaftar"];
            
            array_push($response['datasiswa'], $data);
        }
        echo json_encode($response);
    } else {
        $response['message'] = "API ini memerlukan parameter";
        $response['code'] = 400;
        $response['status'] = false;

        echo json_encode($response);
    }

?>