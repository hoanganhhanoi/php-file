<?php
	 
	$file = $_POST["filename"];

	if (file_exists($file)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/force-download');
	    header('Content-Disposition: attachment; filename='.basename($file));
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    /*ob_clean();
	    flush();
	    readfile($file);*/
	    readfile_chunked($file);
	}

	function readfile_chunked($filename,$retbytes=true) { 
	   	$chunksize = 1*(1024*1024); // how many bytes per chunk 
	   	$buffer = ''; 
	   	$cnt =0; 
	   	// $handle = fopen($filename, 'rb'); 
	   	$handle = fopen($filename, 'rb'); 
	   	if ($handle === false) { 
	       	return false; 
	   	} 
	   	while (!feof($handle)) { 
	       	$buffer = fread($handle, $chunksize); 
	       	echo $buffer; 
	       	ob_flush(); 
	       	flush(); 
	       	if ($retbytes) { 
	           	$cnt += strlen($buffer); 
	       	}
	   	}

	    $status = fclose($handle); 
	   	if ($retbytes && $status) { 
	       	return $cnt; // return num. bytes delivered like readfile() does. 
	   	} 
	    return $status;
	}
?>