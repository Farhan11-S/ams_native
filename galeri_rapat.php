<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else { ?>
    <!-- Row form Start -->
    <div class="row jarak-form black-text">
        <form class="col s12" method="post" action="">
            <div class="input-field col s3">
                <i class="material-icons prefix md-prefix">date_range</i>
                <input id="dari_tanggal" type="text" name="dari_tanggal" id="dari_tanggal" required>
                <label for="dari_tanggal">Dari Tanggal</label>
            </div>
            <div class="input-field col s3">
                <i class="material-icons prefix md-prefix">date_range</i>
                <input id="sampai_tanggal" type="text" name="sampai_tanggal" id="sampai_tanggal" required>
                <label for="sampai_tanggal">Sampai Tanggal</label>
            </div>
            <div class="col s6">
                <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">FILTER <i class="material-icons">filter_list</i></button>
            </div>
        </form>
    </div>
    <!-- Row form END -->
<?php
        if(isset($_REQUEST['submit'])){

            $dari_tanggal = $_REQUEST['dari_tanggal'];
            $sampai_tanggal = $_REQUEST['sampai_tanggal'];

            if($_REQUEST['dari_tanggal'] == "" || $_REQUEST['sampai_tanggal'] == ""){
                header("Location: ./admin.php?page=gsm");
                die();
            } else {
                $query = "SELECT tbl_files.id, rapat_id, filename, path, tanggal FROM tbl_files JOIN tbl_rapat ON rapat_id = tbl_rapat.id WHERE tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal' ORDER By tbl_rapat.id";
            }
        } else {
            $query = "SELECT tbl_files.id, rapat_id, filename, path, tanggal FROM tbl_files JOIN tbl_rapat ON rapat_id = tbl_rapat.id";
        }
    }
?>
<table id="table_id" class="display blue lighten-4">
    <thead>
        <tr>
            <th width="5%">ID</th>
            <th>Filename</th>
            <th width="25%">Tanggal</th>
            <th width="18%">Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = mysqli_query($config, $query);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_array($query)){
                    echo "<tr>";
                    echo '<td>'. $row['id'] .'</td>';
                    echo '<td>'. $row['filename'] .'</td>';
                    echo '<td>'. $row['tanggal'] .'</td>';
                    echo '<td class="mdc-data-table__cell">
                    <a class="btn green waves-effect waves-light" title="Lihat detail" href="?page=tsm&amp;act=show&amp;id='. $row['rapat_id'] .'"><i class="material-icons">list</i></a></td>';
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>

<style>
    #table_id_length{
        display: none;
    }
    #table_id_filter{
        display: none;
    }
</style>