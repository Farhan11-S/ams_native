<?php
ob_start();
//cek session
session_start();
if(empty($_SESSION['admin'])){
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {
    require_once 'include/config.php';
    require_once 'include/functions.php';
    $config = conn($host, $username, $password, $database);
    //validasi form kosong
    if($_REQUEST['notulis'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['tanggal'] == ""
    || $_REQUEST['waktu'] == "" || $_REQUEST['nama_pimpinan'] == "" || $_REQUEST['peserta'] == "" || $_REQUEST['isian'] == ""){
        $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
        echo '<script language="javascript">window.history.back();</script>';
    } else {
        $notulis = $_REQUEST['notulis'];
        $nama = $_REQUEST['nama'];
        $tanggal = $_REQUEST['tanggal'];
        $waktu = $_REQUEST['waktu'];
        $nama_pimpinan = $_REQUEST['nama_pimpinan'];
        $peserta = $_REQUEST['peserta'];
        $isian = $_REQUEST['isian'];
        $id_user = $_SESSION['id_user'];

        //validasi input data
        if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $notulis)){
            $_SESSION['notulis'] = 'Form Notulis hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $nama)){
                $_SESSION['nama_rapat'] = 'Form Nama Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if(!preg_match("/^[0-9.-]*$/", $tanggal)){
                    $_SESSION['tanggal'] = 'Form Tanggal Rapat hanya boleh mengandung angka dan minus(-)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9: ]*$/", $waktu)){
                        $_SESSION['nama_pimpinan'] = 'Form Waktu Rapat hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9., ]*$/", $nama_pimpinan)){
                            $_SESSION['nama_pimpinan'] = 'Form Nama Pimpinan Rapat hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9., -]*$/", $peserta)){
                                $_SESSION['peserta'] = 'Form Peserta Rapat hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,) dan minus (-)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                $ekstensi = array('jpg','png','jpeg','doc','docx','pdf');
                                $file = $_FILES['file']['name'];
                                $x = explode('.', $file);
                                $eks = strtolower(end($x));
                                $ukuran = $_FILES['file']['size'];
                                $target_dir = "upload/rapat/";

                                if (! is_dir($target_dir)) {
                                    mkdir($target_dir, 0755, true);
                                }

                                $query = mysqli_query($config, "INSERT INTO tbl_rapat(notulis, nama, tanggal, waktu, nama_pimpinan, peserta, isian, id_user)
                                    VALUES('$notulis','$nama','$tanggal','$waktu','$nama_pimpinan','$peserta', '$isian', '$id_user')");
                                    
                                queryChecker($query);
                                $rapat_id = mysqli_insert_id($config);

                                if(!empty($_REQUEST['isianImages'])){
                                    $isian_images = $_REQUEST['isianImages'];
                                    $isian_images = json_decode($isian_images);
                                    for ($i=0; $i < count($isian_images); $i++) { 
                                        $filename = str_replace($target_dir, "", $isian_images[0]);
                                        $query = mysqli_query($config, "INSERT INTO tbl_files(filename,path,rapat_id)
                                                VALUES('$filename','$target_dir','$rapat_id')");

                                        queryChecker($query);
                                    }
                                }    

                                //jika form file tidak kosong akan mengeksekusi script dibawah ini
                                if($file != ""){
                                    $rand = rand(1,10000);
                                    $nfile = $rand."-".$file;
                                    //validasi file
                                    if(in_array($eks, $ekstensi) == true){
                                        if($ukuran < 2500000){

                                            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                            $query = mysqli_query($config, "INSERT INTO tbl_files(filename,path,rapat_id)
                                                    VALUES('$nfile','$target_dir','$rapat_id')");

                                            queryChecker($query);
                                        } else {
                                            $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        }
                                    } else {
                                        $_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF!';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    }
                                }
                                $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                header("Location: ./admin.php?page=tsm");
                            }
                        }
                    }
                }
            }
        }
    }
}

function queryChecker($query) {
    if(!$query){
        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query, '. mysqli_error($config);
        echo '<script language="javascript">window.history.back();</script>';
    }
}