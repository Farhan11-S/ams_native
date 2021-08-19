<?php
    //cek session
    if(empty($_SESSION['admin']) || $_SESSION['admin'] == 3){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else { ?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="?page=tsm&act=add" class="judul"><i class="material-icons">mail</i> Tambah Data Notulen</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- Secondary Nav END -->
            </div>
            <!-- Row END -->

            <?php
                if(isset($_SESSION['errQ'])){
                    $errQ = $_SESSION['errQ'];
                    echo '<div id="alert-message" class="row">
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
                if(isset($_SESSION['errEmpty'])){
                    $errEmpty = $_SESSION['errEmpty'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errEmpty']);
                }
            ?>

            <!-- Row form Start -->
            <div class="row jarak-form">

                <!-- Form START -->
                <form id="main-form" class="col s12" method="POST" action="tambah_notulen_database.php" enctype="multipart/form-data">

                    <!-- Row in form START -->
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix md-prefix">bookmark</i>
                            <input id="tema" type="text" class="validate" name="tema" required>
                                <?php
                                    if(isset($_SESSION['tema_rapat'])){
                                        $tema = $_SESSION['tema_rapat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tema.'</div>';
                                        unset($_SESSION['tema_rapat']);
                                    }
                                ?>
                            <label for="tema">Tema Rapat</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix md-prefix">assignment_ind</i>
                            <input id="nama_pimpinan" type="text" class="validate" name="nama_pimpinan" required>
                                <?php
                                    if(isset($_SESSION['nama_pimpinan'])){
                                        $nama_pimpinan = $_SESSION['nama_pimpinan'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nama_pimpinan.'</div>';
                                        unset($_SESSION['nama_pimpinan']);
                                    }
                                ?>
                            <label for="nama_pimpinan">Nama Pimpinan Rapat</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="tanggal" type="text" name="tanggal" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['tanggal'])){
                                        $tanggal = $_SESSION['tanggal'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tanggal.'</div>';
                                        unset($_SESSION['tanggal']);
                                    }
                                ?>
                            <label for="tanggal">Tanggal Rapat</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix md-prefix">place</i>
                            <input id="tempat" type="text" class="validate" name="tempat" required>
                                <?php
                                    if(isset($_SESSION['tempat'])){
                                        $tema = $_SESSION['tempat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tempat.'</div>';
                                        unset($_SESSION['tempat']);
                                    }
                                ?>
                            <label for="tempat">Tempat Rapat</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">assignment_ind</i>
                            <textarea id="peserta" class="materialize-textarea validate" name="peserta" required></textarea>
                                <?php
                                    if(isset($_SESSION['peserta'])){
                                        $peserta = $_SESSION['peserta'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$peserta.'</div>';
                                        unset($_SESSION['peserta']);
                                    }
                                ?>
                            <label for="peserta">Peserta Rapat</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="sia" class="materialize-textarea validate" name="sia"></textarea>
                                <?php
                                    if(isset($_SESSION['sia'])){
                                        $sia = $_SESSION['sia'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$sia.'</div>';
                                        unset($_SESSION['sia']);
                                    }
                                ?>
                            <label for="sia">Sambutan Inspektur dan Arahan</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="ssa" class="materialize-textarea validate" name="ssa"></textarea>
                                <?php
                                    if(isset($_SESSION['ssa'])){
                                        $ssa = $_SESSION['ssa'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$ssa.'</div>';
                                        unset($_SESSION['ssa']);
                                    }
                                ?>
                            <label for="ssa">Sambutan Sekretaris dan Arahan</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="liw1" class="materialize-textarea validate" name="liw1"></textarea>
                                <?php
                                    if(isset($_SESSION['liw1'])){
                                        $liw1 = $_SESSION['liw1'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$liw1.'</div>';
                                        unset($_SESSION['liw1']);
                                    }
                                ?>
                            <label for="liw1">Laporan Irban Wilayah I</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="liw2" class="materialize-textarea validate" name="liw2"></textarea>
                                <?php
                                    if(isset($_SESSION['liw2'])){
                                        $liw2 = $_SESSION['liw2'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$liw2.'</div>';
                                        unset($_SESSION['liw2']);
                                    }
                                ?>
                            <label for="liw2">Laporan Irban Wilayah II</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="liw3" class="materialize-textarea validate" name="liw3"></textarea>
                                <?php
                                    if(isset($_SESSION['liw3'])){
                                        $liw3 = $_SESSION['liw3'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$liw3.'</div>';
                                        unset($_SESSION['liw3']);
                                    }
                                ?>
                            <label for="liw3">Laporan Irban Wilayah III</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="liw4" class="materialize-textarea validate" name="liw4"></textarea>
                                <?php
                                    if(isset($_SESSION['liw4'])){
                                        $liw4 = $_SESSION['liw4'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$liw4.'</div>';
                                        unset($_SESSION['liw4']);
                                    }
                                ?>
                            <label for="liw4">Laporan Irban Wilayah IV</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="kpk" class="materialize-textarea validate" name="kpk"></textarea>
                                <?php
                                    if(isset($_SESSION['kpk'])){
                                        $kpk = $_SESSION['kpk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kpk.'</div>';
                                        unset($_SESSION['kpk']);
                                    }
                                ?>
                            <label for="kpk">Kasubbag Program & Keuangan</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="kep" class="materialize-textarea validate" name="kep"></textarea>
                                <?php
                                    if(isset($_SESSION['kep'])){
                                        $kep = $_SESSION['kep'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kep.'</div>';
                                        unset($_SESSION['kep']);
                                    }
                                ?>
                            <label for="kep">Kasubbag Evaluasi dan Pelaporan</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="kup" class="materialize-textarea validate" name="kup"></textarea>
                                <?php
                                    if(isset($_SESSION['kup'])){
                                        $kup = $_SESSION['kup'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kup.'</div>';
                                        unset($_SESSION['kup']);
                                    }
                                ?>
                            <label for="kup">Kasubbag Umum dan Kepegawaian</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="tl" class="materialize-textarea validate" name="tl"></textarea>
                                <?php
                                    if(isset($_SESSION['tl'])){
                                        $tl = $_SESSION['tl'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tl.'</div>';
                                        unset($_SESSION['tl']);
                                    }
                                ?>
                            <label for="tl">Tindak lanjut</label>
                        </div>
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix md-prefix">info_outline</i>
                            <textarea id="penutup" class="materialize-textarea validate" name="penutup"></textarea>
                                <?php
                                    if(isset($_SESSION['penutup'])){
                                        $penutup = $_SESSION['penutup'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$penutup.'</div>';
                                        unset($_SESSION['penutup']);
                                    }
                                ?>
                            <label for="penutup">Penutup</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix md-prefix">alarm</i>
                            <input id="mulai" type="time" name="mulai" class="timepicker" required>
                                <?php
                                    if(isset($_SESSION['mulai'])){
                                        $mulai = $_SESSION['mulai'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$mulai.'</div>';
                                        unset($_SESSION['mulai']);
                                    }
                                ?>
                            <label style="margin-top: 20px;" for="mulai">Waktu Mulai Rapat</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix md-prefix">alarm</i>
                            <input id="selesai" type="time" name="selesai" class="timepicker" required>
                                <?php
                                    if(isset($_SESSION['selesai'])){
                                        $selesai = $_SESSION['selesai'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$selesai.'</div>';
                                        unset($_SESSION['selesai']);
                                    }
                                ?>
                            <label style="margin-top: 20px;" for="selesai">Waktu Selesai Rapat</label>
                        </div>
                        <div style="margin-top: 3rem !important;" class="input-field col s12">
                            <div class="file-field input-field">
                                <div class="btn light-green darken-1">
                                    <span>File</span>
                                    <input type="file" id="file" name="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Upload file/scan gambar surat masuk" disabled>
                                        <?php
                                            if(isset($_SESSION['errSize'])){
                                                $errSize = $_SESSION['errSize'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errSize.'</div>';
                                                unset($_SESSION['errSize']);
                                            }
                                            if(isset($_SESSION['errFormat'])){
                                                $errFormat = $_SESSION['errFormat'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errFormat.'</div>';
                                                unset($_SESSION['errFormat']);
                                            }
                                        ?>
                                    <small class="red-text">*Format file yang diperbolehkan *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF dan ukuran maksimal file 2 MB!</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button onclick="submitForm()" type="button"class="btn-large blue waves-effect waves-light" id="submit_button">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <a href="?page=tsm" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                        </div>
                    </div>

                </form>
                <!-- Form END -->
            </div>
            <!-- Row form END -->
            <script>
                function submitForm() {
                    const form = document.getElementById("main-form");
                    form.submit()
                }
            </script>
<?php
    }
?>
