<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_notulen.php";
                    break;
                case 'edit':
                    include "edit_notulen.php";
                    break;
                case 'show':
                    include "detail_notulen.php";
                    break;
                case 'print':
                    include "print.php";
                    break;
                case 'del':
                    include "hapus_notulen.php";
                    break; 
                default:
                    $home = true;
                    break;
            }
        } else {
            $admin = $_SESSION['admin'] != 3
            ?>
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
                                        <?php if ($admin) {?>
                                        <li class="waves-effect waves-light">
                                            <a href="?page=tsm&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Secondary Nav END -->
            

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

                <div class="col s12 table-responsive">
                    <table id="table_id" class="display blue lighten-4">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="25%">Tema Rapat</th>
                                <th width="18%">Tanggal Rapat</th>
                                <th width="24%">Pimpinan Rapat</th>
                                <th width="10%">Notulis</th>
                                <th width="18%">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = mysqli_query($config, "SELECT * FROM tbl_notulen");
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_array($query)){
                                        echo "<tr>";
                                        echo '<td>'. $row['id'] .'</td>';
                                        echo '<td>'. $row['tema'] .'</td>';
                                        echo '<td>'. $row['tanggal'] .'</td>';
                                        echo '<td>'. $row['nama_pimpinan'] .'</td>';
                                        echo '<td>'. $row['notulis'] .'</td>';
                                        echo '<td class="mdc-data-table__cell row">
                                        <a class="btn green waves-effect waves-light col m5 s12" style="margin-right:5px;" title="Lihat detail" href="?page=tsm&amp;act=show&amp;id='. $row['id'] .'"><i class="material-icons">list</i></a>';
                                        if (($_SESSION['admin'] == 1 || $_SESSION['nama'] == $row['notulis']) && $admin) {
                                            echo '<a class="btn blue waves-effect waves-light col m5 s12" title="Edit" href="?page=tsm&amp;act=edit&amp;id='. $row['id'] .'"><i class="material-icons">edit</i></a>';
                                            echo '<a class="btn deep-orange waves-effect waves-light col m5 s12" style="margin-right:5px;" title="Hapus" href="?page=tsm&amp;act=del&amp;id='. $row['id'] .'"><i class="material-icons">delete</i></a>';
                                        }

                        
                                        echo '<a class="btn indigo lighten-1 waves-effect waves-light col m5 s12" title="Cetak" href="?page=tsm&amp;act=print&amp;id='. $row['id'] .'" target="_blank" rel="noopener"><i class="material-icons">print</i></a></td>';
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            <!-- Row END -->
            </div>

<?php
        }
    }
?>

<style>
    label {
        color: black;
        display: flex;
    }
    select {
        margin: 0 10px !important;
        height: 2rem !important;
        border:none !important;
        border-bottom: 1px solid black !important;
        text-align-last:center;
    }
    input[type=search] {
        margin: 0 10px !important;
        border:none !important;
        border-bottom: 1px solid black !important;
        height: 1rem !important;
    }
    #table_id_length{
        margin-top: 15px !important;
        margin-bottom: 15px !important;
    }
    #table_id_filter{
        margin-top: 15px !important;
        margin-bottom: 15px !important;
    }
</style>