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
    	$query = mysqli_query($config, "SELECT * FROM tbl_rapat WHERE id='$id'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){
    		  echo '
                <!-- Row form Start -->
				<div class="row jarak-card">
				    <div class="col m12">
                    <div class="card">
                        <div class="card-content">
				        <table>
				            <thead class="red lighten-5 red-text">
				                <div class="confir primary-text"><i class="material-icons md-36">details</i>
				                Detail Rapat</div>
				            </thead>

				            <tbody>
				                <tr>
				                    <td width="13%">ID</td>
				                    <td width="1%">:</td>
				                    <td width="86%">'.$row['id'].'</td>
				                </tr>
                                <tr>
				                    <td width="13%">Notulis</td>
				                    <td width="1%">:</td>
				                    <td width="86%">'.$row['notulis'].'</td>
				                </tr>
				                <tr>
				                    <td width="13%">Nama Rapat</td>
				                    <td width="1%">:</td>
				                    <td width="86%">'.$row['nama'].'</td>
				                </tr>
                                <td width="13%">Nama Pimpinan Rapat</td>
                                <td width="1%">:</td>
                                <td width="86%">'.$row['nama_pimpinan'].'</td>
                                </tr>
    			                <tr>
    			                    <td width="13%">Tanggal Rapat</td>
    			                    <td width="1%">:</td>
    			                    <td width="86%">'.$row['tanggal'].'</td>
    			                </tr>
                                <tr>
                                    <td width="13%">Waktu</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$row['waktu'].'</td>
                                </tr>
    			            </tbody>
    			   		</table>
                        </div>
    	            </div>
                </div>
            </div>
            <!-- Row form END -->';   	    
        }
    }
}
?>
