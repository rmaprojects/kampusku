<?php
//API by Raka

    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nis = $_POST['nis'];
        $nama_siswa = "SELECT nama_siswa FROM tbl_siswa WHERE tbl_siswa.nis = '$nis'";

        $cek_data = "SELECT * FROM tbl_datasiswa WHERE nis = '$nis'";
        $check_ifexist = mysqli_fetch_array(mysqli_query($_AUTH, $cek_data));

        if (isset($check_ifexist)) {
            $query_delete_datasiswa = "DELETE FROM tbl_datasiswa WHERE tbl_datasiswa.nis = '$nis'";
            if (mysqli_query($_AUTH, $query_delete_datasiswa)){
                $query_delete_siswa = "DELETE FROM tbl_siswa WHERE tbl_siswa.nis = '$nis'";
                $exe_delete_siswa = mysqli_query($_AUTH, $query_delete_siswa);

                $response['message'] = trim("Data dengan NIS $nis sudah dihapus");
                $response['code'] = 200;
                $response['status'] = true;

                echo json_encode($response);
            } else {
                $response['message'] = "GAGAL";
                $response['code'] = 400;
                $response['status'] = false;
                echo json_encode($response);
            }
        } else {
            $response['message'] = "Data memang sudah terhapus atau tidak ada";
            $response['code'] = 403;
            $response['status'] = false;
            echo json_encode($response);
        }
    } else {
            $response['message'] = "Need API";
            $response['code'] = 403;
            $response['status'] = false;
            echo json_encode($response);
    }






?>