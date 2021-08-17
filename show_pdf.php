<?php

ob_start();
//cek session
session_start();
if(empty($_SESSION['admin'])){
  $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
  header("Location: ./");
  die();
} else {
  require_once 'include/config.php';
  require_once 'include/functions.php';
  $config = conn($host, $username, $password, $database);
  if(isset($_REQUEST['file_id'])){
    $id = $_REQUEST['file_id'];
    $query = "SELECT filename, path  FROM tbl_files WHERE id='$id'";
    $query = mysqli_query($config, $query);
    if($query && mysqli_num_rows($query) > 0) { 
      list($filename, $path) = mysqli_fetch_array($query);
      // The location of the PDF file
      // on the server
      $fullpath = $path . $filename;
        
      // Header content type
      header("Content-type: application/pdf");
      header("Content-Disposition: inline; filename=$filename");
      header("Content-Length: " . filesize($fullpath));
        
      // Send the file to the browser.
      readfile($fullpath);
    } else {
      get_back();
    }
  } else {
    get_back();
  }
} 

function get_back() {
  echo '<script language="javascript">window.history.back();</script>';
  die();
}
?> 