<?php

    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nis = $_POST['nis'];
        $nama_siswa = $_POST['nama_siswa'];
        $jeniskelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $nomerhp = $_POST['nomor_telp'];
        $email = $_POST['email'];
    
        $add_orang = "INSERT INTO tbl_siswa (nis, nama_siswa, jenis_kelamin, alamat, nomor_telp, email)
        VALUES ('$nis', '$nama_siswa', '$jeniskelamin', '$alamat', '$nomerhp', '$email')";
        $cek_orang = "SELECT COUNT(*) 'totaltambah' FROM tbl_siswa WHERE tbl_siswa.nis = '$nis'";

        if (mysqli_query($_AUTH, $add_orang)){
            $jurusan = $_POST['id_jurusan'];
            $kelas = $_POST['id_kelas'];
            $tambahkankedatasiswa = "INSERT INTO tbl_datasiswa (id_kelas, nis, id_jurusan)
            VALUES 
            ($kelas, '$nis', '$jurusan')";
            $exe_tambahdata = mysqli_query($_AUTH, $tambahkankedatasiswa);
            $cek_username = "SELECT COUNT(*) 'jumlah_data_yang_ditambahkan' FROM tbl_datasiswa WHERE tbl_datasiswa.nis = '$nis'";
            $exe_username = mysqli_query($_AUTH, $cek_username);

            $getdataadd = "SELECT tbl_siswa.nama_siswa, tbl_siswa.jenis_kelamin, tbl_siswa.alamat, tbl_siswa.nomor_telp, tbl_siswa.email FROM tbl_siswa WHERE tbl_siswa.nama_siswa = '$nama_siswa' AND tbl_siswa.jenis_kelamin = '$jeniskelamin' AND tbl_siswa.alamat = '$alamat' AND tbl_siswa.nomor_telp = '$nomerhp' AND tbl_siswa.email = '$email'";
            $exe_getdataadd = mysqli_query($_AUTH, $getdataadd);

            if ($get_jumlahUser['jumlah_data_yang_ditambahkan'] == 0) {
                $response['message'] = "Data gagal ditambahkan";
                $response['code'] = 400;
                $response['status'] = false;
                echo json_encode($response);
            } else {
                $response['message'] = "Data murid berhasil ditambahkan";
                $response['code'] = 200;
                $response['status'] = true;
                $response['tambahdata'] = array();
                while ($row = mysqli_fetch_array($getdataadd)) {
                    $data = array();

                    $data['nama_siswa'] = $row['nama_siswa'];
                    $data['jenis_kelamin'] = $row['jenis_kelamin'];
                    $data['alamat'] = $row['alamat'];
                    $data['nomor_telp'] = $row['nomor_telp'];
                    $data['email'] = $row['email'];

                    array_push($response['tambahdata'], $data);
                }
                echo json_encode($response);

                
            }
        }

        
    } else {
        $response['message'] = trim("Need an API");
        $response['code'] = 400;
        $response['status'] = false;
        echo json_encode($response);
    }





?>