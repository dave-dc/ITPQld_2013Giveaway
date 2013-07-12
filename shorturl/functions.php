<?php

//Function to get URL of current page.
function getURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}


//Function to display shortened URL.
function showShortenedURL($shortKey,$domainURL){
	$showInfo = "Success! Visit your URL at  <input type=\"text\" id=\"shortURL\" size=\"" . (strlen($domainURL.$shortKey)+1) . "\" value=\"" . $domainURL . "?" . $shortKey . "\" readonly />.<br \><br \>HTML:<br \><pre>" . htmlspecialchars("<a href=\"" . $domainURL . "?" . $shortKey . "\">" . $domainURL . "?" . $shortKey . "</a>") . "</pre><br \><br \>BB Code:<br \><pre>" . htmlspecialchars("[url=" . $domainURL . "?" . $shortKey . "]" . $domainURL . "?" . $shortKey . "[/url]") . "</pre><br \><br \>Wiki:<br \><pre>" . htmlspecialchars("[" . $domainURL . "?" . $shortKey . "]") . "</pre>";
	return $showInfo;
}


//Function to write log file.
function writeLog($fileURL,$txt){
	$fh = fopen($fileURL, "a");
	fwrite($fh, $txt);
	fclose($fh);
}

?>