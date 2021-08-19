<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_SESSION['errQ'])){
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert-message" class="row jarak-card">
                    <div class="col m12">
                        <div class="card red lighten-5">
                            <div class="card-content notif">
                                <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                            </div>
                        </div>
                    </div>
                </div>';
            unset($_SESSION['errQ']);
        }

    	$id = mysqli_real_escape_string($config, $_REQUEST['id']);
        $query = "SELECT notulis, tema, tanggal, mulai, selesai, tempat, nama_pimpinan, peserta,sambutan_inspektur,sambutan_sekretaris,laporan_irban_1, laporan_irban_2,laporan_irban_3,laporan_irban_4,kasubbag_program_keuangan,kasubbag_evaluasi_laporan,kasubbag_umum_kepegawaian,tindak_lanjut,penutup, CREATED_AT, id_user  FROM tbl_notulen WHERE id='$id'";
    	$query = mysqli_query($config, $query);
?>
<div class="container">
    <div class="row">
        <nav class="secondary-nav">
            <div class="nav-wrapper blue-grey darken-1">
                <ul>
                    <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">list</i> Detail Notulen</a></li>

                    <li class="waves-effect waves-light"><a href="?page=tsm"><i class="material-icons">arrow_back</i> Kembali</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="row card-detail">
        <div class="card">
    <?php 
        if($query && mysqli_num_rows($query) > 0) {
            list($notulis, $tema, $tanggal, $mulai, $selesai, $tempat, $nama_pimpinan, $peserta, $sia, $ssa,$liw1,$liw2,$liw3,$liw4,$kpk,$kep,$kup,$tl,$penutup,$dibuat, $id_user) = mysqli_fetch_array($query);

        ?>
            <div class="card-content table-responsive">
                <table>
                    <tbody>
                        <tr>
                            <td width="140px">Notulis</td>
                            <td>:</td>
                            <td><?php echo $notulis; ?></td>
                        </tr>
                        <tr>
                            <td>Tema Rapat</td>
                            <td>:</td>
                            <td><?php echo $tema; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Rapat</td>
                            <td>:</td>
                            <td><?php echo indoDate($tanggal); ?></td>
                        </tr>
                        <tr>
                            <td>Waktu Rapat</td>
                            <td>:</td>
                            <td><?php echo date('H:i', strtotime($mulai)).'-'.date('H:i', strtotime($selesai)); ?></td>
                        </tr>
                        <tr>
                            <td>Tempat Rapat</td>
                            <td>:</td>
                            <td><?php echo $tempat; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pimpinan</td>
                            <td>:</td>
                            <td><?php echo $nama_pimpinan; ?></td>
                        </tr>
                        <tr>
                            <td>Peserta</td>
                            <td>:</td>
                            <td><?php echo nl2br($peserta); ?></td>
                        </tr>
                        <tr>
                            <td>Kegiatan Rapat</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Sambutan Inspektur dan Arahan</td>
                            <td>:</td>
                            <td><?php echo nl2br($sia); ?></td>
                        </tr>
                        <tr>
                            <td>Sambutan Sekretaris dan Arahan</td>
                            <td>:</td>
                            <td><?php echo nl2br($ssa); ?></td>
                        </tr>
                        <tr>
                            <td>Laporan Irban Wilayah I</td>
                            <td>:</td>
                            <td><?php echo nl2br($liw1); ?></td>
                        </tr>
                        <tr>
                            <td>Laporan Irban Wilayah II</td>
                            <td>:</td>
                            <td><?php echo nl2br($liw2); ?></td>
                        </tr>
                        <tr>
                            <td>Laporan Irban Wilayah III</td>
                            <td>:</td>
                            <td><?php echo nl2br($liw3); ?></td>
                        </tr>
                        <tr>
                            <td>Laporan Irban Wilayah IV</td>
                            <td>:</td>
                            <td><?php echo nl2br($liw4); ?></td>
                        </tr>
                        <tr>
                            <td>Kasubbag Program & Keuangan</td>
                            <td>:</td>
                            <td><?php echo nl2br($kpk); ?></td>
                        </tr>
                        <tr>
                            <td>Kasubbag Evaluasi dan Pelaporan</td>
                            <td>:</td>
                            <td><?php echo nl2br($kep); ?></td>
                        </tr>
                        <tr>
                            <td>Kasubbag Umum dan Kepegawaian</td>
                            <td>:</td>
                            <td><?php echo nl2br($kup); ?></td>
                        </tr>
                        <tr>
                            <td>Tindak Lanjut</td>
                            <td>:</td>
                            <td><?php echo nl2br($tl); ?></td>
                        </tr>
                        <tr>
                            <td>Penutup</td>
                            <td>:</td>
                            <td><?php echo nl2br($penutup); ?></td>
                        </tr>
                        <tr>
                            <td>Ditambahkan pada</td>
                            <td>:</td>
                            <td><?php echo indoDate($dibuat); ?></td>
                        </tr>
                        <tr>
                            <td>Lampiran file</td>
                            <td>:</td>
                            <td>
                                <div class="row">
                            <?php 
                                $query = "SELECT id, filename, path  FROM tbl_files WHERE rapat_id='$id' AND isian=0";
                                $query = mysqli_query($config, $query);

                                if($query && mysqli_num_rows($query) > 0) { 
                                    list($file_id, $filename, $path) = mysqli_fetch_array($query);
                                    $fullpath = $path . $filename;
                                    echo '<p class="col s12" style="margin: 5px 5px;">'.$filename.'</p>';
                                    echo generate_show_button($file_id, $fullpath);
                            ?>

                                    <a class="col m5 s9 btn indigo lighten-1 waves-effect waves-light white-text" href="<?php echo $fullpath; ?>" download="<?php echo $filename; ?>"><i class="material-icons">file_download</i> Download</a>
                            <?php 
                                } else { echo '-'; } 
                            ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-action row">
                <a href="?page=tsm" class="col m2 s5 btn-large green waves-effect waves-light white-text"><i class="material-icons">arrow_back</i> KEMBALI</a>

                <a href="?page=tsm&act=edit&id=<?php echo $id; ?>" class="col m2 s5 btn-large blue waves-effect waves-light white-text"><i class="material-icons">edit</i> EDIT</a>

                <a href="?page=tsm&act=del&id=<?php echo $id; ?>" class="col m2 s5 btn-large deep-orange waves-effect waves-light white-text"><i class="material-icons">delete</i> HAPUS</a>

                <a href="?page=tsm&act=print&id=<?php echo $id; ?>" class="col m2 s5 btn-large indigo lighten-1 waves-effect waves-light white-text" target="_blank" rel="noopener"><i class="material-icons">print</i> CETAK</a>
            </div>
    <?php
        } else {
    ?>
            <div class="card-content table-responsive">Data Not Found</div>
        </div>
    </div>
</div>
<?php
        }
    }

    function generate_show_button($file_id, $fullpath) {
        $ext = pathinfo($fullpath, PATHINFO_EXTENSION);
        $btn_pdf ='<a class="col m5 s9 btn green waves-effect waves-light white-text" href="show_pdf.php?file_id='.$file_id.'" target="_blank" rel="noopener"><i class="material-icons">visibility</i> Lihat</a>';
        $btn_img ='<a class="col m5 s9 btn green waves-effect waves-light white-text" href="'.$fullpath.'" target="_blank" rel="noopener"><i class="material-icons">visibility</i> Lihat</a>';
        if($ext == "pdf") return $btn_pdf;
        elseif($ext == "doc" || $ext == "docx") return "-";
        else return $btn_img;
    }
?>