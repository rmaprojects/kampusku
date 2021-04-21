<?php

    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nis = $_POST['nis'];
        $nama_siswa = $_POST['nama_siswa'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $nomor_telp = $_POST['nomor_telp'];
        $email = $_POST['email'];

        $cek_data = "SELECT * FROM tbl_siswa WHERE nis = '$nis'";
        $check_ifexist = mysqli_fetch_array(mysqli_query($_AUTH, $cek_data));

        if (isset($check_ifexist)){

            $query_update = "UPDATE tbl_siswa SET tbl_siswa.nama_siswa = '$nama_siswa', tbl_siswa.jenis_kelamin = '$jenis_kelamin', tbl_siswa.alamat = '$alamat', tbl_siswa.nomor_telp = '$nomor_telp', tbl_siswa.email = '$email' WHERE tbl_siswa.nis = '$nis'";
            
            if (mysqli_query($query_update)){
                $jurusan = $_POST['id_jurusan'];
                $kelas = $_POST['id_kelas'];

                $query_update_datasiswa = "UPDATE tbl_datasiswa SET tbl_datasiswa.id_kelas = $kelas, tbl_datasiswa.id_jurusan = '$jurusan' WHERE tbl_datasiswa.nis = '0128392'";
                if (mysqli_query($query_update_datasiswa)){

                    $query_search_data = "SELECT * FROM tbl_siswa WHERE nis ='$nis'";
                    $exe_data_add = mysqli_query($_AUTH, $query_search_data);

                    $response['message'] = "Data dari Siswa bernama $nama_siswa sudah diupdate";
                    $response['code'] = "201";
                    $response['status'] = true;
                    $response['detailupdate'] = array();
                    while ($row = mysqli_fetch_array($exe_data_add)){
                        $data = array();

                        $data['nama_siswa'] = $row ['nama_siswa'];
                        $data['jenis_kelamin'] = $row ['jenis_kelamin'];
                        $data['alamat'] = $row ['alamat'];
                        $data['nomor_telp'] = $row ['nomor_telp'];
                        $data['email'] = $row ['email'];
                        $data['tanggal_terdaftar'] = $row['tanggal_terdaftar'];
                        
                        array_push($_response['detailupdate'], $data);
                    }
                    echo json_encode($_response);
                    
                }
            } else {
                $response['message'] = "Ada sesuatu yang salah, silahkan dicoba ulang";
                $response['code'] = 500;
                $response['status'] = false;
            }
        } else {
            $response['message'] = "Data tidak ditemukan";
            $response['code'] = 404;
            $response['message'] = false;
        }
    } else {
        $response['message'] = "Need an API";
        $response['code'] = 401;
        $response['status'] = false;
    }








?>