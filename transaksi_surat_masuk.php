<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 3){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.location.href="./logout.php";
                  </script>';
        } else {

            if(isset($_REQUEST['act'])){
                $act = $_REQUEST['act'];
                switch ($act) {
                    case 'add':
                        include "tambah_surat_masuk.php";
                        break;
                    case 'edit':
                        include "edit_surat_masuk.php";
                        break;
                    case 'show':
                        include "detail_surat_masuk.php";
                        break;
                    /* case 'print':
                        include "cetak_disposisi.php";
                        break; */
                    case 'del':
                        include "hapus_surat_masuk.php";
                        break; 
                    default:
                        $home = true;
                        break;
                }
            } else {

                $query = mysqli_query($config, "SELECT surat_masuk FROM tbl_sett");
                list($surat_masuk) = mysqli_fetch_array($query);

                //pagging
                $limit = $surat_masuk;
                $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }?>
                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col m7">
                                        <ul class="left">
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=tsm" class="judul"><i class="material-icons" style="margin: 0 5px 6px 0;">mail</i>Notulen</a></li>
                                            <li class="waves-effect waves-light">
                                                <a href="?page=tsm&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->

                <?php
                    if(isset($_SESSION['succAdd'])){
                        $succAdd = $_SESSION['succAdd'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succAdd.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succAdd']);
                    }
                    if(isset($_SESSION['succEdit'])){
                        $succEdit = $_SESSION['succEdit'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succEdit.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succEdit']);
                    }
                    if(isset($_SESSION['succDel'])){
                        $succDel = $_SESSION['succDel'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succDel.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succDel']);
                    }
                ?>

                <!-- Row form Start -->
                <div class="row jarak-form">

                <table id="table_id" class="display blue lighten-4">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">Notulis</th>
                            <th width="25%">Nama Rapat</th>
                            <th width="24%">Pimpinan Rapat</th>
                            <th width="18%">Tanggal Rapat</th>
                            <th width="10%">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = mysqli_query($config, "SELECT * FROM tbl_rapat");
                            if(mysqli_num_rows($query) > 0){
                                $no = 1;
                                while($row = mysqli_fetch_array($query)){
                                    echo "<tr>";
                                    echo '<td>'. $row['id'] .'</td>';
                                    echo '<td>'. $row['notulis'] .'</td>';
                                    echo '<td>'. $row['nama'] .'</td>';
                                    echo '<td>'. $row['nama_pimpinan'] .'</td>';
                                    echo '<td>'. $row['tanggal'] .'</td>';
                                    echo '<td class="mdc-data-table__cell">
                                    <a class="btn green waves-effect waves-light" title="Lihat detail" href="?page=tsm&amp;act=show&amp;id='. $row['id'] .'"><i class="material-icons">list</i></a>
                    
                                    <a class="btn blue waves-effect waves-light" title="Edit" href="?page=tsm&amp;act=edit&amp;id='. $row['id'] .'"><i class="material-icons">edit</i></a>
                    
                                    <a class="btn deep-orange waves-effect waves-light" title="Hapus" href="?page=tsm&amp;act=del&amp;id='. $row['id'] .'"><i class="material-icons">delete</i></a>
                    
                                    <a class="btn indigo lighten-1 waves-effect waves-light" title="Cetak disposisi" href="?page=tsm&amp;act=print&amp;id='. $row['id'] .'" target="_blank" rel="noopener"><i class="material-icons">print</i></a></td>';
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>

<?php
            }
        }
    }
?>
