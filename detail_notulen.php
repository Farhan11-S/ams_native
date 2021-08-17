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
        $query = "SELECT notulis, nama, tanggal, waktu, nama_pimpinan, peserta, isian, CREATED_AT, id_user  FROM tbl_rapat WHERE id='$id'";
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
            list($notulis, $nama, $tanggal, $waktu, $nama_pimpinan, $peserta, $isian, $dibuat, $id_user) = mysqli_fetch_array($query);

            $query = "SELECT nama  FROM tbl_user WHERE id_user='$id_user'";
    	    $query = mysqli_query($config, $query);
            list($pembuat) = mysqli_fetch_array($query);
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
                            <td>Nama Rapat</td>
                            <td>:</td>
                            <td><?php echo $nama; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Rapat</td>
                            <td>:</td>
                            <td><?php echo indoDate($tanggal); ?></td>
                        </tr>
                        <tr>
                            <td>Waktu Rapat</td>
                            <td>:</td>
                            <td><?php echo $waktu; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pimpinan</td>
                            <td>:</td>
                            <td><?php echo $nama_pimpinan; ?></td>
                        </tr>
                        <tr>
                            <td>Peserta</td>
                            <td>:</td>
                            <td><?php echo $peserta; ?></td>
                        </tr>
                        <tr>
                            <td>Isian</td>
                            <td>:</td>
                            <td><?php echo $isian; ?></td>
                        </tr>
                        <tr>
                            <td>Ditambahkan pada</td>
                            <td>:</td>
                            <td><?php echo indoDate($dibuat); ?></td>
                        </tr>
                        <tr>
                            <td>Ditambahkan oleh</td>
                            <td>:</td>
                            <td><?php echo $pembuat; ?></td>
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