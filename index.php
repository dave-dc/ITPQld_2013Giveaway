<?php
$debug=false;

require_once("facebooksdk/src/facebook.php");

$config = array();
$config['appId'] = '619240391420298';
$config['secret'] = 'b44b95371947252a5e59e083ea958371';

$facebook = new Facebook($config);

$user = $facebook->getUser();

$signed_request = $facebook->getSignedRequest();
$app_data = json_decode(stripslashes(base64_decode($signed_request['app_data'])));
$like_status = $signed_request['page']['liked'];

//Simulate Like Status
//$like_status=1;//Liked
//$like_status=0;//Not Liked
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="style.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="functions.js"></script>
</head>
<body>
	<div id="fb-root"></div>
	<script>
	  window.fbAsyncInit = function() {
		// init the FB JS SDK
		FB.init({
		  appId      : '<?=$config['appId']?>',					// App ID from the app dashboard
		  channelUrl : '//server.dirtychook.com/itpqldfb/channel.html', // Channel file for x-domain comms
		  status     : true,									// Check Facebook Login status
		  xfbml      : true										// Look for social plugins on the page
		});

		// Additional initialization code such as adding Event Listeners goes here
	  };

	  // Load the SDK asynchronously
	  (function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "//connect.facebook.net/en_US/all.js";
		 fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
	<?php //Debug ?>
	<?php if($debug): echo "<pre>"; ?>
	<?php print_r($signed_request); ?>
	<?php print_r($app_data); ?>
	<?php echo "</pre>"; endif; ?>
	
	<?php //Page Content ?>
	<div class="wrapper">
		<?php if (!$like_status) :?>
		<div class="fangate">
			<img src="images/fangate.png" />
		</div>
		<?php endif; ?>
		<div class="header">
			<img class="main-image" src="images/comp_top.png" alt="" />
			<img class="friend-anim" src="images/friend_anim_in.png" alt="" />
		</div>
		<div class="draws padded">
			<p><strong>We're going to draw a winner every two weeks, but remember each draw is a new competition - so you'll need to enter again if you want a chance to win. But don't worry, we'll send you a reminder when the next draw is open.</strong></p>
			<div class="draw-1">
				<p><span>Draw 1 - Wednesday, 23rd July @ 9am</span> - Entries close midnight Tuesday 22nd July.</p>
			</div>
			<div class="draw-2">
				<p><span>Draw 2 - Wednesday, 6th August @ 9am</span> - Entries close midnight Tuesday 5th July.</p>
			</div>
			<div class="draw-3">
				<p><span>Draw 3 - Wednesday, 20th August @ 9am</span> - Entries close midnight Tuesday 19th July.</p>
			</div>
		</div>
		<?php if ($like_status) :?>
		<div class="form padded">
				<div class="section section-1">
					<h1>What Would You Do With A Personal Best Tax Return?</h1>
					<p>What would you do with a personal best tax return in 2013? Maybe it's a holiday, a new iPad or just a romantic night out for two.</p>
					<div class="inputfield validated">
						<textarea id="input_entry" name="input_entry" class="small-ta" placeholder="With my personal best tax return I would..." validate="reqd"></textarea>
						<div class="error">Error Message</div>
					</div>
				</div>
				<div class="section section-2">
					<h1>Leave us your contact details</h1>
					<p>There's nothing worse than winning $500 cash and not knowing!</p>
					<button type="button" id="autofill" class="btn btn-small btn-inverse">
						<i class="icon-arrow-down icon-white"></i> 
						Autofill from Facebook
					</button>
					<br />
					<div class="inputfield input-prepend validated">
						 <span class="add-on"><i class="icon-user"></i></span>
						 <input id="input_firstname" name="input_firstname" type="text" placeholder="Your First Name" validate="reqd"/>
						 <div class="error">Error Message</div>
					</div>
					<div class="inputfield input-prepend validated">
						 <span class="add-on"><i class="icon-user"></i></span>
						 <input id="input_lastname" name="input_lastname" type="text" placeholder="Your Last Name" validate="reqd" />
						 <div class="error">Error Message</div>
					</div>
					<div class="inputfield input-prepend validated">
						 <span class="add-on"><i class="icon-envelope"></i></span>
						 <input id="input_email" name="input_email" type="text" placeholder="Your Email" validate="email"/>
						 <div class="error">Error Message</div>
					</div>
					<div class="inputfield input-prepend validated">
						 <span class="add-on"><i class="icon-th"></i></span>
						 <input id="input_number" name="input_number" type="text" placeholder="Contact Number" validate="reqd"/>
						 <div class="error">Error Message</div>
					</div>
					<br />
					<div class="inputfield input-prepend validated">
						 <span class="add-on"><i class="icon-map-marker"></i></span>
						 <input id="input_postcode" name="input_postcode" type="text" placeholder="Post Code" validate="postcode" />
						 <div class="error">Error Message</div>
					</div>
				</div>
				<div class="section section-3">
					<h1>Enter the Competition</h1>
					<p>Please make sure you read the <a href="#viewterms" role="button" data-toggle="modal">Terms and Conditions</a>.</p>
					<label class="checkbox">
					  <input id="terms" name="terms" type="checkbox"> I agree to the <a href="#viewterms" role="button" data-toggle="modal">Terms and Conditions</a>. All the details I have provided above are current & accurate.
					</label>
					<label class="checkbox">
					  <input id="marketing" name="marketing" type="checkbox"> I would like to receive similar promotions from ITP in the future.
					</label>
				</div>
				<div class="<?php if(!$debug) echo "noshow"; ?>">
				<input type="text" id="input_fbid" name="input_fbid">
				<input type="text" id="input_referrer" value="<?=$app_data->e?>" name="input_referrer">
				</div>
				<div class="section submit">
					<button id="submit" type="button" class="btn btn-large" disabled><i class="icon-thumbs-up"></i> Enter the Competition</button>
					<?php if($debug){ ?><button id="trigger" type="button" class="btn btn-large"><i class="icon-thumbs-up"></i> Trigger</button><?php }?>
				</div>
		</div>
		<div class="entered padded" style="display:none;">
			We see you've entered, nice work. Now get out there and tell everyone, if they win so do you!
		</div>
	</div>
	<div id="viewterms" class="modal hide fade">
		<div class="modal-header">
			<h4>Terms & Conditions</h4>
		</div>
		<div class="modal-body">
			<?php echo(file_get_contents('terms.html'));?>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>
	<div id="thanks" class="modal hide fade">
		<div class="modal-body">
			<p>Thanks for your entry, we're processing your request now.</p>
			<p>In the meantime, why not share your unique URL with friends for more chances to win!</p>
			<h3 id="after_submit_share"></h3>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>
	<?php endif; ?>
</body>
</html>