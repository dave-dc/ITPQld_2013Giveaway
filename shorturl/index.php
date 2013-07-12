<?php
//Include config.php and functions.php
require('config.php');
require("functions.php");

//Get URL extension.
$url = getURL();
$string = parse_url($url, PHP_URL_QUERY);

//Check if extension exists, otherwise redirect to main page.
if ($string != ""){
		//Get log contents.
		$query = file_get_contents($logURL);
		//Format URL extension.
		$userKey = "|" . $string . "|";
		//Check for formatted URL extension in log file.
		$keyExists = strpos($query,$userKey);
		
		//If extension doesn't exist, send user to main page with 'exist=false'.
		if ($keyExists===false){
			$geturl = $webURL . "form.php?exist=false";
		} else {
			//Else parse log file for URL associated with extension.
			$urlpos = strpos($query,$userKey);
			$pos11 = strpos($query,"|",$urlpos+1);
			$pos1 = $pos11 + 1;
			$pos2 = strpos($query,"|",$pos1);
			$strlength = $pos2 - $pos1;
			$geturl = substr($query,$pos1,$strlength);
		}
} else {
	//Redirect to real main page (form.php).
	$geturl = $webURL . "form.php";
}

?>
<html>
<head>
	<title>Redirecting...</title>
	<meta http-equiv="Refresh" content="0; url=<?php echo $geturl; ?>" />
	<link rel="stylesheet" href="style.css" title="default"type="text/css">
</head>
<body>
    <div id="main">
        <div id="content">
            You are being redirected to <a href="<?php echo $geturl; ?>"><?php echo $geturl; ?></a>...
        </div>
    </div>
</body>
</html>