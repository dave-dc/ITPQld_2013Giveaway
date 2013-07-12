$(document).ready(function(){

	$('#autofill').click(function(){
		
		FB.login(function(response) {
		   if (response.authResponse) {
			 FB.api('/me', function(response) {
				
				setField($('#input_firstname'),response.first_name);
				setField($('#input_lastname'),response.last_name);
				setField($('#input_email'),response.email);
				$('#input_fbid').val(response.id);
			 });
		   } else {
			 alert('User cancelled login or did not fully authorize.');
		   }
		}, {scope: 'email'});
	});
	
	$('.friend-anim')
      .delay(1200)
      .animate({
        top:'10px'
      },300)
      .animate({
        top:'0px'
      },30)
    ;
	
	
	// Submit Form
	$('#submit').click(function(){
		var entrydate = new Date();
		entrydate.toString('MM-dd-yyyy');
		var baseurl = "http://www.facebook.com/itpqld/app_619240391420298?app_data=";
		var urlstring = '{"e":"'+$('#input_email').val()+'"}';
		
		//Shorten URL
		$.ajax({
			type: "post",
			url: "create_url.php",
			//url:"http://requestb.in/yzbs7nyz",
			data: {
				'baseurl': baseurl,
				'urlstring': urlstring
			},
			success:function(urldata){
				
				var thedata = {
					'firstname': $('#input_firstname').val(),
					'lastname': $('#input_lastname').val(),
					'email': $('#input_email').val(),
					'number': $('#input_number').val(),
					'postcode': $('#input_postcode').val(),
					'entry': $('#input_entry').val(),
					'fbid': $('#input_fbid').val(),
					'referrer': $('#input_referrer').val(),
					'time': entrydate,
					'url': urldata,
					'fullurl':fullurl
				};
				
				submitData(thedata);
				
				// Modal Popup
				$('#after_submit_share').text(urldata);
				$('#thanks').modal('show');
				
				hideForm();
			}
		});
	});
	
	$("#trigger").click(function(){
	});
	
});

function setField(item,value){
	item.val(value);
	validateField(item);
}

function submitData(data){
	$.ajax({
		type: "post",
		url: "https://zapier.com/hooks/catch/n/4zs5s/",
		//url: "http://requestb.in/yzbs7nyz",
		dataType: "json",
		data: data,
		success:function(){
			alert('Thank you');
		}
	});
}

$(document).ready(function(){

	$('input[validate], #input_entry').blur(function(e){	

		checkAll();
	});
	$('input[type="checkbox"]').change(function(e){	
		checkAll();
	});
	
	function checkAll(){
		if(allValid()){
			$("#submit").removeAttr('disabled');
		}else{
			$("#submit").attr('disabled','');
		}
	}
});

function validateField(inputfield){
	
	var type = inputfield.attr('validate');
	var value = inputfield.val();
	var msg = "";
	
	switch (type){
	
		case 'reqd':
			if(value.length==0){
				msg = "This field cannot be empty.";
			}break;
		
		case 'email':
			if(!isEmail(value)){
				msg = "Please entere a valid email.";
			}break;
		
		case 'postcode':
			if(value.length!=4 || isNaN(value)){
				msg = "Please enter a valid 4 digit postcode.";
			}break;

	}
	
	if(msg!=""){
		appendError(inputfield,msg);
		return(1);
	}else{
		removeError(inputfield);
		return(0);
	}
}

function isEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function appendError(item, message){
	var errormsg = "<strong>Error!</strong>"+ message;
	item.parent().removeClass('validated');
	item.next('.error').html(errormsg);
	item.prev('.add-on').removeClass('approve');
	item.prev('.add-on').addClass('error');
	item.prev('.add-on').children('i').addClass('icon-white');
}
function removeError(item){
	item.parent().addClass('validated');
	item.prev('.add-on').removeClass('error');
	item.prev('.add-on').addClass('approve');
	item.prev('.add-on').children('i').addClass('icon-white');
}

function allValid(){
	var errorcount = 0;
	var addtocount;
	$('input[validate], #input_entry').each(function(i){
		addtocount = validateField($(this));
		errorcount = errorcount + addtocount;
	});
	$('input[type="checkbox"]').each(function(i){
		if($(this).prop('checked')==false){
			errorcount = errorcount + 1;
		}
	});
	
	var returnval;
	if(errorcount==0){
		returnval = true;
	}else{
		returnval =  false;
	}
	
	return returnval;
}

function hideForm(){
	$('.form').hide();
	$('.entered').show();
}