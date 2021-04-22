<?php
//API by Raka

    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nis = $_POST['nis'];
        $nama_siswa = $_POST['nama_siswa'];
        $jeniskelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $nomerhp = $_POST['nomor_telp'];
        $email = $_POST['email'];
        $kelas = $_POST['id_kelas'];
        $jurusan = $_POST['id_jurusan'];
        

        $cek_data = "SELECT * FROM tbl_siswa WHERE nis = '$nis'";
        $check_ifexist = mysqli_fetch_array(mysqli_query($_AUTH, $cek_data));

        if (isset($check_ifexist)) {
            $response['message'] = "DATA TERDETEKSI GANDA ULANG KEMABIL";
            $response['code'] = 403;
            $response['status'] = false;
            echo json_encode($response);
        }
        else{
            $query_input_siswa = "INSERT INTO tbl_siswa (nis, nama_siswa, jenis_kelamin, alamat, nomor_telp, email)
            VALUES ('$nis', '$nama_siswa', '$jeniskelamin', '$alamat', '$nomerhp', '$email')";
            if (mysqli_query($_AUTH, $query_input_siswa)) {
                
                //Input to datasiswa table
                $query_input_datasiswa = "INSERT INTO tbl_datasiswa (id_kelas, nis, id_jurusan)VALUES($kelas, '$nis', '$jurusan')";
                $exe_input_datasiswa = mysqli_query($_AUTH, $query_input_datasiswa);

                $query_search_data = "SELECT * FROM tbl_siswa WHERE nis ='$nis'";
                $exe_data_add = mysqli_query($_AUTH, $query_search_data);

                $_response["message"] = "Data siswa ".$nama_siswa." berhasil di tambah";
                $_response["code"] = 200;
                $_response["status"] = true;
                $_response['tambahdata'] = array();
                while ($row = mysqli_fetch_array($exe_data_add)){
                    $data = array();

                    $data['nama_siswa'] = $row ['nama_siswa'];
                    $data['jenis_kelamin'] = $row ['jenis_kelamin'];
                    $data['alamat'] = $row ['alamat'];
                    $data['nomor_telp'] = $row ['nomor_telp'];
                    $data['email'] = $row ['email'];
                    $data['tanggal_terdaftar'] = $row['tanggal_terdaftar'];
                    
                    array_push($_response['tambahdata'], $data);
                }
                echo json_encode($_response);

            }else {
                $response["message"] = "Error please try again";
                $response["code"] = 403;
                $response["status"] = false;
                echo json_encode($response);
            }
        }
        
    }else {
            $response['message'] = trim("Need an API");
            $response['code'] = 400;
            $response['status'] = false;
            echo json_encode($response);
    }
?>