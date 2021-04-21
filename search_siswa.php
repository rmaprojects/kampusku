<?php

    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nis = $_POST['nis'];

        //Cari NIS
        $cek_data = "SELECT * FROM tbl_siswa WHERE nis = '$nis'";
        $check_ifexist = mysqli_fetch_array(mysqli_query($_AUTH, $cek_data));

        if (isset($check_ifexist)) {
            $cari_nis = "SELECT * FROM tbl_siswa WHERE nis = '$nis'";
            $exe_cari_nis = mysqli_query($_AUTH, $cari_nis);

            $response['message'] = "Data dari siswa dengan NIS $nis ditemukan";
            $response['code'] = 200;
            $response['status'] = true;
            $response['caridata'] = array();
            while($row = mysqli_fetch_array($exe_cari_nis)){
                $data = array();
                
                $data['nama_siswa'] = $row['nama_siswa'];
                $data['jenis_kelamin'] = $row['alamat'];
                $data['nomor_telp'] = $row['nomor_telp'];
                $data['email'] = $row['email'];

                array_push($response['caridata'], $data);
            }
            echo json_encode($response);
        } else {
            $response['message'] = "Data dari NIS $nis tidak ditemukan, coba ulang";
            $response['code'] = 404;
            $response['status'] = false;
            echo json_encode($response);
        }
    }



















?>