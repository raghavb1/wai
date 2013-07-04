<?php include 'db.php'; $login_query=mysql_query("SELECT email FROM users");
$login_fetch=mysql_fetch_array($login_query);
?>
<script>

  $(".button").live("click",function() {
	  $('.error').hide();
		// validate and process form
		// first hide any error messages
		
	  var fname = $("input#fname").val();
		if (fname == "") {
      $("label#fname_error").show();
      $("input#fname").focus();
      return false;
    }
	if(fname.match(/[\(\)\<\>\,\;\:\\\"\[\]]/))
	{
	 $("label#fname_error1").show();
      $("input#fname").focus();
      return false;	
	}
	
	
	 var lname = $("input#lname").val();
		if (lname == "") {
      $("label#lname_error").show();
      $("input#lname").focus();
      return false;
    }
		if(lname.match(/[\(\)\<\>\,\;\:\\\"\[\]]/))
	{
	 $("label#lname_error1").show();
      $("input#lname").focus();
      return false;	
	}
		var email = $("input#emaill").val();
    if (email == "") {
      $("label#email_error").show();
      $("input#emaill").focus();
      return false;
    }
	
	if(email.match(/[\(\)\<\>\,\;\:\\\"\[\]]/))
	{
	 $("label#email_error1").show();
      $("input#emaill").focus();
      return false;	
	}
	if(!email.match(/^[^@]+@[^@.]+\.[^@]*\w\w$/))
	{
	 $("label#email_error2").show();
      $("input#emaill").focus();
      return false;	
	}
   <?php while($login_fetch=mysql_fetch_array($login_query)){?>
    if (email=="<?php echo $login_fetch['email']; ?>"){
      $("label#email_error3").show();
      $("input#emaill").focus();
      return false;
    }	<?php } ?>
	
		var pass = $("input#passs").val();
		if (pass == "") {
      $("label#pass_error").show();
      $("input#passs").focus();
      return false;
    }
		
		var dataString ='fname='+fname+'&lname='+lname+'&email='+email+'&pass='+pass;
		//alert (dataString);return false;
        $('#contact_form').html("<div id='message'></div>");
        $('#message').html("<h2>Welcome to Who Am I</h2>")
        .append("<p>Verify your email account and become a part of the family</p>")
        .hide()
        .fadeIn(1500, function() {
          $('#message').append("");
        });		
		$.ajax({
      type: "POST",
      url: "bin/signup.php",
      data: dataString,
      success: function() {

      }
     });
    return false;
	});
</script>
