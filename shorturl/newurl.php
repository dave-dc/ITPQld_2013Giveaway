<?php
//Include config.php and functions.php
require('config.php');
require("functions.php");

$siteURL = $webURL;

//Get URL to shorten.
$url = $_POST['url'];

//Gen. unique id for short URL.
$id = substr(uniqid(), -6, $idLength);

//Get optional keyword and keyword length.
$getKey = $_POST['key'];

//Check if user entered a URL.
if (!empty($url)){
	
	//Check if user entered custom keyword.
	if (!empty($getKey)){
		//Check if keyword exists.
		$ch = file_get_contents($logURL);
		$keywordCheck = "|" . $getKey . "|";
		$pos = strpos($ch,$keyword);

		if ($pos === false) {
			//If not, write file.
			$toWrite = $getKey . "|" . $url . "|";

			//Display new URL.
			$showURL = showShortenedURL($getKey,$siteURL);
			writeLog($logURL,$toWrite);

		} else {
			//Else inform user.
			$showURL = "Sorry, but the keyword you entered is in use. Please try again with a different keyword.";
		}

	} else {

		$toWrite = $id . "|" . $url . "|";

		//Display new URL and [below] write file.
		$showURL = showShortenedURL($id,$siteURL);
		writeLog($logURL,$toWrite);
	}
	
} else {
	$showURL = "Please enter a URL.";
}

?>


<html>
<head>
	<title><?php echo $siteTitle; ?>: Shortened URL</title>
	<link rel="stylesheet" href="style.css" title="default"type="text/css">
    
    <script type="text/javascript">
	//Function to select shortened URL.
	function selectURL() {
		document.getElementById("shortURL").select();
	}
	</script>
</head>
<body onload="selectURL()">
    <div id="main">
        <div id="content">
            <p><?php echo $showURL; ?></p>
            <p>&nbsp;</p>
            <hr \>
            <p>&nbsp;</p>
            <p>Thank you for using <?php echo $siteTitle; ?>. <a href="form.php">Shorten another URL.</a></p>
        </div>
    </div>
</body>
</html>