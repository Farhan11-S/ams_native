<?php
    //cek session
    if(!empty($_SESSION['admin'])){
?>

<nav class="blue-grey darken-1">
    <div class="nav-wrapper">
        <a href="./" class="brand-logo center hide-on-large-only"><img class="logoside" src="upload/234036693_206258044784916_3376650780198122801_n.jpg" alt="AMS" style="margin-top:20px; height:50px !important; width:50px !important;"></a>
        <ul id="slide-out" class="side-nav" data-simplebar-direction="vertical">
            <li class="no-padding">
                <div class="logo-side center blue-grey darken-3">
                    <?php
                        $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
                        while($data = mysqli_fetch_array($query)){
                            if(!empty($data['logo'])){
                                echo '<img class="logoside" src="./upload/'.$data['logo'].'"/>';
                            } else {
                                echo '<img class="logoside" src="./asset/img/logo.png"/>';
                            }
                            if(!empty($data['nama'])){
                                echo '<h5 class="smk-side">'.$data['nama'].'</h5>';
                            } else {
                                echo '<h5 class="smk-side">SMK  Al - Husna Loceret Nganjuk</h5>';
                            }
                            if(!empty($data['alamat'])){
                                echo '<p class="description-side">'.$data['alamat'].'</p>';
                            } else {
                                echo '<p class="description-side">Jalan Raya Kediri Gg. Kwagean No. 04 Loceret Telp/Fax. (0358) 329806 Nganjuk 64471</p>';
                            }
                        }
                    ?>
                </div>
            </li>
            <li class="no-padding blue-grey darken-4">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header"><i class="material-icons">account_circle</i><?php echo $_SESSION['nama']; ?></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="?page=pro">Profil</a></li>
                                <li><a href="?page=pro&sub=pass">Ubah Password</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li><a href="./"><i class="material-icons middle">dashboard</i> Beranda</a></li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header" href="?page=tsm"><i class="material-icons">mail</i>Notulen</a>
                   </li>
                </ul>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header" a href="?page=gsm"><i class="material-icons">image</i> Arsip File</a>
                </ul>
            </li>
            <li class="no-padding">
            <?php
                if($_SESSION['admin'] == 1){ ?>
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header"><i class="material-icons">settings</i> Pengaturan</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="?page=sett">Instansi</a></li>
                                <li><a href="?page=sett&sub=usr">User</a></li>
                                <li><a href="?page=sett&sub=back">Backup Database</a></li>
                                <li><a href="?page=sett&sub=rest">Restore Database</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            <?php
                }
            ?>
            <?php
                if($_SESSION['admin'] == 2){ ?>
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header"><i class="material-icons">settings</i> Pengaturan</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="?page=sett">Instansi</a></li>
                                <li><a href="?page=sett&sub=usr">User</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            <?php
                }
            ?>
            </li>
        </ul>
        <!-- Menu on medium and small screen END -->

        <!-- Menu on large screen START -->
        <ul class="center hide-on-med-and-down" id="nv">
            <li><a href="./" class="ams hide-on-med-and-down"> <img class="logoside" src="upload/234036693_206258044784916_3376650780198122801_n.jpg" alt="AMS" style="margin-top:10px; height:50px !important; width:50px !important;"></a></li>
            <li><div class="grs"></></li>
            <li><a href="./"><i class="material-icons"></i>&nbsp; Beranda</a></li>
            <li><a href="?page=tsm">Notulen</a></li>
            <li><a href="?page=gsm">Arsip File</a></li>
            <?php
                if($_SESSION['admin'] == 1){ ?>
            <li><a class="dropdown-button" href="#!" data-activates="pengaturan">Pengaturan <i class="material-icons md-18">arrow_drop_down</i></a></li>
                <ul id='pengaturan' class='dropdown-content'>
                    <li><a href="?page=sett&sub=usr">User</a></li>
                    <li class="divider"></li>
                    <li><a href="?page=sett&sub=back">Backup Database</a></li>
                    <li><a href="?page=sett&sub=rest">Restore Database</a></li>
                </ul>
            <?php
                }
            ?>
            <?php
                if($_SESSION['admin'] == 2){ ?>
            <li><a class="dropdown-button" href="#!" data-activates="pengaturan">Pengaturan <i class="material-icons md-18">arrow_drop_down</i></a></li>
                <ul id='pengaturan' class='dropdown-content'>
                    <li><a href="?page=sett">Instansi</a></li>
                    <li><a href="?page=sett&sub=usr">User</a></li>
                </ul>
            <?php
                }
            ?>
            <li class="right" style="margin-right: 10px;"><a class="dropdown-button" href="#!" data-activates="logout"><i class="material-icons">account_circle</i> <?php echo $_SESSION['nama']; ?><i class="material-icons md-18">arrow_drop_down</i></a></li>
                <ul id='logout' class='dropdown-content'>
                    <li><a href="?page=pro">Profil</a></li>
                    <li><a href="?page=pro&sub=pass">Ubah Password</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="material-icons">settings_power</i> Logout</a></li>
                </ul>
        </ul>
        <!-- Menu on large screen END -->
        <a href="#" data-activates="slide-out" class="button-collapse" id="menu"><i class="material-icons">menu</i></a>
    </div>
</nav>

<?php
    } else {
        header("Location: ../");
        die();
    }
?>
