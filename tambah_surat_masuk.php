<?php
    //cek session
    if(empty($_SESSION['admin'])){
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
                                <li class="waves-effect waves-light"><a href="?page=tsm&act=add" class="judul"><i class="material-icons">mail</i> Tambah Data Surat Masuk</a></li>
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
                <form id="main-form" class="col s12" method="POST" action="tambah_rapat_database.php" enctype="multipart/form-data">

                    <!-- Row in form START -->
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">looks_one</i>
                            <input id="notulis" type="text" class="validate" name="notulis" required>
                                <?php
                                    if(isset($_SESSION['notulis'])){
                                        $notulis = $_SESSION['notulis'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$notulis.'</div>';
                                        unset($_SESSION['notulis']);
                                    }
                                ?>
                            <label for="notulis">Notulis Rapat</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">bookmark</i>
                            <input id="nama" type="text" class="validate" name="nama" required>
                                <?php
                                    if(isset($_SESSION['nama_rapat'])){
                                        $nama = $_SESSION['nama_rapat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nama.'</div>';
                                        unset($_SESSION['nama_rapat']);
                                    }
                                ?>
                            <label for="nama">Nama Rapat</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">place</i>
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
                        <div class="input-field col s6">
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
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">storage</i>
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
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="waktu" type="time" name="waktu" class="timepicker" required>
                                <?php
                                    if(isset($_SESSION['waktu'])){
                                        $waktu = $_SESSION['waktu'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$waktu.'</div>';
                                        unset($_SESSION['waktu']);
                                    }
                                ?>
                            <label style="margin-top: 20px;" for="waktu">Waktu Rapat</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">looks_two</i>
                            <textarea id="isian" name="isian" placeholder="Isian Rapat" required></textarea>
                        </div>
                        <div class="input-field col s12">
                            <div class="file-field input-field">
                                <div class="btn light-green darken-1">
                                    <span>File</span>
                                    <input type="file" id="file" name="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Upload file/scan gambar surat masuk">
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
            <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
            <script>
                function submitForm() {
                    const form = document.getElementById("main-form");
                    const isian = tinyMCE.activeEditor.getContent();
                    const parser = new DOMParser();
                    const htmlDoc = parser.parseFromString(isian, "text/html");
                    const isianImages = htmlDoc.getElementsByTagName("img");
                    const imgSrcs = [];

                    for (let i = 0; i < isianImages.length; i++) {
                        imgSrcs.push(isianImages[i].getAttribute("src"));
                    }
                    const hiddenField = document.createElement("input");
                    hiddenField.type = "hidden";
                    hiddenField.name = "isianImages";
                    hiddenField.value = JSON.stringify(imgSrcs);
                    form.appendChild(hiddenField);
                    form.submit()
                }
                var files = 
                tinymce.init({
                    selector: '#isian',
                    plugins: 'image',
                    height : '480px',
                    images_reuse_filename :false,
                    images_upload_handler: function (blobInfo, success, failure) {
                        var xhr, formData;
                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', 'postAcceptor.php');
                        xhr.onload = function() {
                            var json;

                            if (xhr.status != 200) {
                                failure('HTTP Error: ' + xhr.status);
                                return;
                            }
                            json = JSON.parse(xhr.responseText);

                            if (!json || typeof json.location != 'string') {
                                failure('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                            success(json.location);
                        };
                        formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        xhr.send(formData);
                    },
                });
            </script>
<?php
    }
?>
