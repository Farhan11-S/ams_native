<?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
?>
<!--

Name        : Aplikasi Sederhana Manajemen Surat Menyurat
Version     : v1.0.1
Description : Aplikasi untuk mencatat data surat masuk dan keluar secara digital.
Date        : 2016
Developer   : M. Rudianto
Phone/WA    : 0852-3290-4156
Email       : rudi@masrud.com
Website     : https://masrud.com

-->
<!doctype html>
<html lang="en">

<!-- Include Head START -->
<?php include('include/head.php'); ?>
<!-- Include Head END -->

<!-- Body START -->
<body class="bg">

<!-- Header START -->
<header>

<!-- Include Navigation START -->
<?php include('include/menu.php'); ?>
<!-- Include Navigation END -->

</header>
<!-- Header END -->

<!-- Main START -->
<main>

    <!-- container START -->
    <div class="container">

    <?php
        $home = true;
        if(isset($_REQUEST['page'])){
            $page = $_REQUEST['page'];
            $home = false;
            switch ($page) {
                case 'tsm':
                    include "transaksi_notulen.php";
                    break;
                case 'sett':
                    include "pengaturan.php";
                    break;
                case 'pro':
                    include "profil.php";
                    break;
                case 'gsm':
                    include "galeri_notulen.php";
                    break;
                default:
                    $home = true;
                    break;
            }
        } else {
            $home = true;
        }

        if($home) {
    ?>
        <!-- Row START -->
        <div class="row">

            <!-- Include Header Instansi START -->
            <?php include('include/header_instansi.php'); ?>
            <!-- Include Header Instansi END -->

            <!-- Welcome Message START -->
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4>Selamat Datang <?php echo $_SESSION['nama']; ?></h4>
                        <p class="description">Anda login sebagai
                        <?php
                            if($_SESSION['admin'] == 1){
                                echo "<strong>Super Admin</strong>. Anda memiliki akses penuh terhadap sistem.";
                            } elseif($_SESSION['admin'] == 2){
                                echo "<strong>Administrator</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            } else {
                                echo "<strong>Petugas Disposisi</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            }?></p>
                    </div>
                </div>
            </div>
            <!-- Welcome Message END -->

            <?php
                //menghitung jumlah surat masuk
                $count1 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_notulen"));
                $count2 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_files"));

                //menghitung jumlah pengguna
                $count5 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_user"));
            ?>

            <!-- Info Statistic START -->
            <a href="?page=tsm">
                <div class="col s12 <?php echo $_SESSION['id_user'] == 1 || $_SESSION['admin'] == 2 ? "m4" : "m6"; ?>">
                    <div class="card cyan">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">mail</i> Jumlah Notulen</span>
                            <?php echo '<h5 class="white-text link">'.$count1.' Notulen</h5>'; ?>
                        </div>
                    </div>
                </div>
            </a>

            <a href="?page=gsm">
                <div class="col s12 <?php echo $_SESSION['id_user'] == 1 || $_SESSION['admin'] == 2 ? "m4" : "m6"; ?>">
                    <div class="card blue darken-3">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">attach_file</i> Jumlah Files</span>
                            <?php echo '<h5 class="white-text link">'.$count2.' Lampiran</h5>'; ?>
                        </div>
                    </div>
                </div>
            </a>

        <?php
            if($_SESSION['id_user'] == 1 || $_SESSION['admin'] == 2){?>
                <a href="?page=sett&sub=usr">
                    <div class="col s12 m4">
                        <div class="card blue accent-2">
                            <div class="card-content">
                                <span class="card-title white-text"><i class="material-icons md-36">people</i> Jumlah Pengguna</span>
                                <?php echo '<h5 class="white-text link">'.$count5.' Pengguna</h5>'; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <!-- Info Statistic START -->
        <?php
            }
        ?>

        </div>
        <!-- Row END -->
    <?php
        }
    ?>
    </div>
    <!-- container END -->

</main>
<!-- Main END -->

<!-- Include Footer START -->
<?php include('include/footer.php'); ?>
<!-- Include Footer END -->

</body>
<!-- Body END -->

</html>

<?php
    }
?>
