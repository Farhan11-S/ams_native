<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        echo '
        <style type="text/css">
            table {
                background: #fff;
                padding: 5px;
            }
            tr, td {
                border: table-cell;
                border: 1px  solid #444;
            }
            tr,td {
                vertical-align: top!important;
            }
            #right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
            .isi {
                height: 300px!important;
            }
            .disp {
                text-align: center;
                padding: 1.5rem 0;
                margin-bottom: .5rem;
            }
            .logodisp {
                float: left;
                position: relative;
                width: 110px;
                height: 110px;
                margin: 0 0 0 1rem;
            }
            #lead {
                width: auto;
                position: relative;
                margin: 25px 0 0 75%;
            }
            .lead {
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: -10px;
            }
            .tgh {
                text-align: center;
            }
            #nama {
                font-size: 2.1rem;
                margin-bottom: -1rem;
            }
            #alamat {
                font-size: 16px;
            }
            .up {
                text-transform: uppercase;
                margin: 0;
                line-height: 2.2rem;
                font-size: 1.5rem;
            }
            .status {
                margin: 0;
                font-size: 1.3rem;
                margin-bottom: .5rem;
            }
            #lbr {
                font-size: 20px;
                font-weight: bold;
            }
            .separator {
                border-bottom: 2px solid #616161;
                margin: -1.3rem 0 1.5rem;
            }
            @media print{
                body {
                    font-size: 12px;
                    color: #212121;
                }
                nav {
                    display: none;
                }
                table {
                    width: 100%;
                    font-size: 12px;
                    color: #212121;
                }
                tr, td {
                    border: table-cell;
                    border: 1px  solid #444;
                    padding: 8px!important;

                }
                tr,td {
                    vertical-align: top!important;
                }
                #lbr {
                    font-size: 20px;
                }
                .isi {
                    height: 200px!important;
                }
                .tgh {
                    text-align: center;
                }
                .disp {
                    text-align: center;
                    margin: -.5rem 0;
                }
                .logodisp {
                    float: left;
                    position: relative;
                    width: 80px;
                    height: 80px;
                    margin: .5rem 0 0 .5rem;
                }
                #lead {
                    width: auto;
                    position: relative;
                    margin: 15px 0 0 75%;
                }
                .lead {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-bottom: -10px;
                }
                #nama {
                    font-size: 20px!important;
                    font-weight: bold;
                    text-transform: uppercase;
                    margin: -10px 0 -20px 0;
                }
                .up {
                    font-size: 17px!important;
                    font-weight: normal;
                }
                .status {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-bottom: -.1rem;
                }
                #alamat {
                    margin-top: -15px;
                    font-size: 13px;
                }
                #lbr {
                    font-size: 17px;
                    font-weight: bold;
                }
                .separator {
                    border-bottom: 2px solid #616161;
                    margin: -1rem 0 1rem;
                }

            }
        </style>

        <body onload="window.print()">

        <!-- Container START -->
            <div id="colres">
                <div class="disp">';
                    $query2 = mysqli_query($config, "SELECT institusi, nama, status, alamat, logo FROM tbl_instansi");
                    list($institusi, $nama, $status, $alamat, $logo) = mysqli_fetch_array($query2);
                        echo '<img class="logodisp" src="./upload/'.$logo.'"/>';
                        echo '<h6 class="up">'.$institusi.'</h6>';
                        echo '<h5 class="up" id="nama">'.$nama.'</h5><br/>';
                        echo '<span id="alamat">'.$alamat.'</span>';

                    echo '
                </div>
                <div class="separator"></div>';

                $id = mysqli_real_escape_string($config, $_REQUEST['id']);
                $query = mysqli_query($config, "SELECT * FROM tbl_notulen WHERE id='$id'");

                if(mysqli_num_rows($query) > 0){
                    while($row = mysqli_fetch_array($query)){
                    echo '<table style="border-style: hidden;" id="tbl">
                    <tbody>';
                    echo '
                            <tr>
                                <td class="tgh" id="lbr" colspan="5">NOTULEN</td>
                            </tr>
                            <tr>
                                <td id="right" width="25%"><strong>Tema Rapat</strong></td>
                                <td id="left" style="border-right: none;" width="40%">: '.$row['tema'].'</td>
                            </tr>
                            <tr><td id="right"><strong>Tanggal</strong></td>
                                <td id="left" colspan="2">: '.indoDate($row['tanggal']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Waktu</strong></td>
                                <td id="left" colspan="2">: '.date('H:i', strtotime($row['mulai'])).' - '.date('H:i', strtotime($row['mulai'])).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Nama Pimpinan</strong></td>
                                <td id="left" colspan="2">: '.$row['nama_pimpinan'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Notulis</strong></td>
                                <td id="left" colspan="2">: '.$row['notulis'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Peserta</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['peserta']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Kegiatan Rapat</strong></td>
                                <td id="left" colspan="2">: </td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:20px;">1.Sambutan Inspektur dan Arahan</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['sambutan_inspektur']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:20px;">2. Sambutan Sekretaris dan Arahan</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['sambutan_sekretaris']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:20px;">3. Diskusi</strong></td>
                                <td id="left" colspan="2"></td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:30px;">a. Laporan Irban Wilayah I</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['laporan_irban_1']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:30px;">b. Laporan Irban Wilayah II</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['laporan_irban_2']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:30px;">c. Laporan Irban Wilayah III</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['laporan_irban_3']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:30px;">d. Laporan Irban Wilayah IV</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['laporan_irban_4']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:30px;">e. Kasubbag Program & Keuangan</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['kasubbag_program_keuangan']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:30px;">f. Kasubbag Evaluasi dan Pelaporan</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['kasubbag_evaluasi_laporan']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:30px;">g. Kasubbag Umum dan Kepegawaian</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['kasubbag_umum_kepegawaian']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:30px;">h. Tindak Lanjut</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['tindak_lanjut']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong style="margin-left:20px;">4.Penutup</strong></td>
                                <td id="left" colspan="2">: '.nl2br($row['penutup']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Dibuat Tanggal</strong></td>
                                <td id="left" style="border-right: none;" colspan="2">: '.indoDate($row['CREATED_AT']).'</td>
                            </tr>
                            <tr>';
                            echo '</tbody>
                            </table>
                            <div id="lead">
                                <p>Pimpinan Rapat</p>
                                <p class="lead">'.$row['nama_pimpinan'].'</p>
                                <div style="height: 50px;"></div>';
                            } 
            echo '
            </div>
        </div>
        <div class="jarak2"></div>
    <!-- Container END -->

    </body>';
    }
}
?>