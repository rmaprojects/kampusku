<?php

    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nis = $_POST['nis'];
        $nama_siswa = $_POST['nama_siswa'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $nomor_telp = $_POST['nomor_telp'];
        $email = $_POST['email'];
        $id_jurusan = $_POST['id_jurusan'];
        $kelas = $_POST['id_kelas'];

        $cek_data = "SELECT * FROM tbl_siswa WHERE nis = '$nis'";
        $check_ifexist = mysqli_fetch_array(mysqli_query($_AUTH, $cek_data));

        if (isset($check_ifexist)) {
            $query_update_datasiswa = "UPDATE `tbl_datasiswa` SET `id_kelas` = '$kelas', `id_jurusan` = '$id_jurusan' WHERE `tbl_datasiswa`.`nis` = '$nis'";
            if (mysqli_query($_AUTH, $query_update_datasiswa)){
                $query_update_siswa = "UPDATE `tbl_siswa` SET `nama_siswa` = '$nama_siswa', `jenis_kelamin` = '$jenis_kelamin', `alamat` = '$alamat', `nomor_telp` = '$nomor_telp', `email` = '$email' WHERE `tbl_siswa`.`nis` = '$nis'";
                $exe_update_siswa = mysqli_query($_AUTH, $query_update_siswa);

                $query_search_data = "SELECT * FROM tbl_siswa WHERE nis ='$nis'";
                $exe_data_add = mysqli_query($_AUTH, $query_search_data);

                $response['message'] = trim("Siswa dengan nama $nama_siswa telah diupdate");
                $response['code'] = 200;
                $response['status'] = true;
                $response['update_siswa'] = array();
                while ($row = mysqli_fetch_array($exe_data_add)){
                    $data = array();

                    $data['nama_siswa'] = $row ['nama_siswa'];
                    $data['jenis_kelamin'] = $row ['jenis_kelamin'];
                    $data['alamat'] = $row ['alamat'];
                    $data['nomor_telp'] = $row ['nomor_telp'];
                    $data['email'] = $row ['email'];
                    
                    array_push($response['update_siswa'], $data);
                }
                echo json_encode($response);
            } else {
                $response['message'] = "GAGAL";
                $response['code'] = 400;
                $response['status'] = false;
                echo json_encode($response);
            }
        } else {
            $response['message'] = "NIS tidak ditemukan, coba ulang";
            $response['code'] = 403;
            $response['status'] = false;
            echo json_encode($response);
        }

    } else {
        $response['message'] = "Need an API";
        $response['code'] = 400;
        $response['status'] = false;
        echo json_encode($response);
    }

?>