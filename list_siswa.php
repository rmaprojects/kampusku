<?php

    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        //Mencari Jumlah Siswa
        $jumlah_siswa = "SELECT COUNT(*) 'total' FROM tbl_datasiswa WHERE tbl_datasiswa.id_kelas = 1";
        $execute_jumlah_siswa = mysqli_query($_AUTH, $jumlah_siswa);  
        $get_jumlahsiswa = mysqli_fetch_assoc($execute_jumlah_siswa);

        $mencari_datasiswa = "SELECT tbl_siswa.nama_siswa, tbl_siswa.jenis_kelamin, tbl_siswa.alamat, tbl_siswa.email, tbl_siswa.tanggal_terdaftar, tbl_kelas.kelas, tbl_jurusan.jurusan FROM tbl_siswa JOIN tbl_datasiswa ON tbl_siswa.nis=tbl_datasiswa.nis JOIN tbl_jurusan ON tbl_datasiswa.id_jurusan=tbl_jurusan.id_jurusan JOIN tbl_kelas ON tbl_datasiswa.id_kelas=tbl_kelas.id_kelas WHERE tbl_kelas.id_kelas='1'";
        $exe_datasiswa = mysqli_query($_AUTH, $mencari_datasiswa);
        // $get_data = mysqli_fetch_array($_AUTH, $exe_datasiswa);

        // // Mecari Wali Kelas
        $wali_kelas = "SELECT nama_guru FROM `db_kampus`.`tbl_guru` WHERE `id_guru` = '1'";
        $executemencariwali = mysqli_query($_AUTH, $wali_kelas);
        $get_walikelas = mysqli_fetch_assoc($executemencariwali);
        
        $response["message"] = trim("Data dari kelas X Sudah ditampilkan");
        $response["code"] = 200;
        $response["status"] = true;
        $response['total_siswa'] = $get_jumlahsiswa ['total'];
        $response['wali_kelas'] = $get_walikelas['nama_guru'];
        $response['datasiswa'] = array();

        while ($row = mysqli_fetch_array($exe_datasiswa)){
            $data = array();

            $data["nama_siswa"] = $row["nama_siswa"];
            $data["jenis_kelamin"] = $row["jenis_kelamin"];
            $data["alamat"] = $row["alamat"];
            $data["email"] = $row["email"];
            $data["tanggal_terdaftar"] = $row["tanggal_terdaftar"];
            
            array_push($response['datasiswa'], $data);
        }
        echo json_encode($response);
    } else {
        $response['message'] = "Need an API";
        $response['code'] = 400;
        $response['status'] = false;

        echo json_encode($response);
    }

?>