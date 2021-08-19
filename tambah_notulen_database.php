<?php
ob_start();
//cek session
session_start();
if(empty($_SESSION['admin']) || $_SESSION['admin'] == 3){
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {
    require_once 'include/config.php';
    require_once 'include/functions.php';
    $config = conn($host, $username, $password, $database);
    //validasi form kosong
    if($_REQUEST['tema'] == "" || $_REQUEST['tanggal'] == "" || $_REQUEST['mulai'] == "" || $_REQUEST['selesai'] == ""
    || $_REQUEST['tempat'] == "" || $_REQUEST['nama_pimpinan'] == "" || $_REQUEST['peserta'] == ""){
        $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
        echo '<script language="javascript">window.history.back();</script>';
    } else {
        $tema = $_REQUEST['tema'];
        $tanggal = $_REQUEST['tanggal'];
        $mulai = $_REQUEST['mulai'];
        $selesai = $_REQUEST['selesai'];
        $tempat = $_REQUEST['tempat'];
        $nama_pimpinan = $_REQUEST['nama_pimpinan'];
        $peserta = $_REQUEST['peserta'];
        $sia = $_REQUEST['sia'];
        $ssa = $_REQUEST['ssa'];
        $liw1 = $_REQUEST['liw1'];
        $liw2 = $_REQUEST['liw2'];
        $liw3 = $_REQUEST['liw3'];
        $liw4 = $_REQUEST['liw4'];
        $kpk = $_REQUEST['kpk'];
        $kep = $_REQUEST['kep'];
        $kup = $_REQUEST['kup'];
        $tl = $_REQUEST['tl'];
        $penutup = $_REQUEST['penutup'];
        $username = $_SESSION['nama'];
        $id_user = $_SESSION['id_user'];

        //validasi input data
        if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $tempat)){
            $_SESSION['notulis'] = 'Form Notulis hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $tema)){
                $_SESSION['nama_rapat'] = 'Form Nama Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if(!preg_match("/^[0-9.-]*$/", $tanggal)){
                    $_SESSION['tanggal'] = 'Form Tanggal Rapat hanya boleh mengandung angka dan minus(-)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9: ]*$/", $mulai) && !preg_match("/^[a-zA-Z0-9: ]*$/", $selesai)){
                        $_SESSION['nama_pimpinan'] = 'Form Waktu Rapat hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9., ]*$/", $nama_pimpinan)){
                            $_SESSION['nama_pimpinan'] = 'Form Nama Pimpinan Rapat hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,)';
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

                            $query = "INSERT INTO tbl_notulen(notulis, tema, tanggal, mulai, selesai, tempat,nama_pimpinan, peserta, sambutan_inspektur,sambutan_sekretaris,laporan_irban_1, laporan_irban_2,laporan_irban_3,laporan_irban_4,kasubbag_program_keuangan,kasubbag_evaluasi_laporan,kasubbag_umum_kepegawaian,tindak_lanjut,penutup,id_user)
                            VALUES('$username','$tema','$tanggal','$mulai','$selesai','$tempat','$nama_pimpinan','$peserta', '$sia', '$ssa','$liw1','$liw2','$liw3','$liw4','$kpk','$kep','$kup','$tl','$penutup', '$id_user')";
                            $query = mysqli_query($config, $query);
                                
                            queryChecker($query, $config);
                            $rapat_id = mysqli_insert_id($config);  

                            //jika form file tidak kosong akan mengeksekusi script dibawah ini
                            if($file != ""){
                                $rand = rand(1,10000);
                                $nfile = $rand."-".$file;
                                //validasi file
                                if(in_array($eks, $ekstensi) == true){
                                    if($ukuran < 2500000){

                                        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                        $query = mysqli_query($config, "INSERT INTO tbl_files(filename,path,isian,rapat_id)
                                                VALUES('$nfile','$target_dir',0,'$rapat_id')");

                                        queryChecker($query, $config);
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

function queryChecker($query, $config) {
    if(!$query){
        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query, '. mysqli_error($config);
        echo '<script language="javascript">window.history.back();</script>';
        die();
    }
}