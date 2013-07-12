<?php
//Include config.php and functions.php
require("config.php");
require("functions.php");

//Check if directory /install exists.
if (file_exists("install") && is_dir("install")) {
	die("ERROR. Directory /install still exists! Please go throught the installation process in the directory /install. If you have installed 2short, delete the directory /install.");
}

//Get URL and check for no URL.
$url = getURL();
$exist = strpos($url,"exist=false");

//Set display style of <div>.
if ($exist===false){
	$divStyle = "none";
} else {
	$divStyle = "block";
}
?>

<html>
<head>
	<meta name="description" content="<?php echo $metaDescription; ?>" />
	<meta name="keywords" content="<?php echo $metaKeywords; ?>" />
	<title><?php echo $siteTitle; ?></title>
	<link rel="stylesheet" href="style.css" title="default"type="text/css">
    <script type="text/javascript">document.shortenURL.url.focus();</script>
</head>
<body>
    <div id="main">
        <br \><h1><?php echo $siteTitle; ?></h1><br \><br \>
        <div id="content">
            <div style="display:<?php echo $divStyle; ?>">
                <br \>
                <h3>The URL you entered does not exist.</h3>
                <p>This means that there is no shortened URL with the given keyword. It has never been used.<br \><br \>Please make sure you entered the correct URL. If the problem persists, contact <?php echo $contact; ?>, or contact the poster of the link.</p>
                <br \>
            </div>

            <h3>Shorten a URL</h3>
            <form id="shortenURL" method="post" action="newurl.php">
            <label for="url">URL: </label><input type="text" size=50 name="url" id="url" value="" /><br \><br \>
            <label for="key">Keyword (optional): </label><input type="text" size=25 name="key" id="key" /><br \><br \>
            <input type="submit" value="Shorten"/>
            </form>

            <br \><br \><h3>What is this?<br \><br \></h3>
            <div id="about">
                <p><?php echo $siteDescription; ?></p>
			</div>
            <br \>
    	</div>
    </div>
</body>
</html>