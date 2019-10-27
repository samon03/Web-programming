<?php
  $file = 'G:/xampp/htdocs/demo/uploads/Samsun_Nahar.pdf'; // path of pdf
  $filename = 'Samsun_Nahar.pdf'; // name of pdf
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $filename . '"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($file);
?>
