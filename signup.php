<?php
include 'js/tutorial.php'; ?>
<div>
  <div id="contact_form" style="margin-left:10px">
  <h1>Register</h1>
  <form name="contact" method="post">
    <table border="0" style="font-size:13px; padding:5px" id="profilep">
    <tr>
     <td><label for="fname" id="fname_label">First Name</label></td>
     <td> <input type="text" name="fname" id="fname" size="30" value="" class="text-input" /></td>
     <td> <label class="error" for="fname" id="fname_error" style="display:none">This field is required.</label></td>
     <td> <label class="error" for="fname" id="fname_error1" style="display:none">Illegal Characters used.</label>      </td>
     </td>
     </tr>
     
     <tr>
     <td> 
      <label for="lname" id="lname_label">Last Name</label></td>
     <td> <input type="text" name="lname" id="lname" size="30" value="" class="text-input" /></td>
     <td> <label class="error" for="lname" id="lname_error" style="display:none">This field is required.</label></td>
     <td> <label class="error" for="lname" id="lname_error1" style="display:none">Illegal Characters used.</label></td>
      </td>
      </tr>
      
      <tr>
      <td>
      <label for="emaill" id="email_label">Email</label></td>
     <td> <input type="text" name="emaill" id="emaill" size="30" value="" class="text-input" /></td>
     <td> <label class="error" for="emaill" id="email_error" style="display:none">This field is required.</label></td>
    <td>  <label class="error" for="emaill" id="email_error1" style="display:none">Illegel Characters used</label></td>
    <td>  <label class="error" for="emaill" id="email_error2" style="display:none">Not a valid email Address</label>  </td>
    <td>  <label class="error" for="emaill" id="email_error3" style="display:none">email already registred</label>  </td>              
      </td>
      </tr>
      
      <tr>
      <td>
     <label for="passs" id="pass_label">Password</label></td>
     <td> <input type="password" name="passs" id="passs" size="30" value="" class="text-input" /></td>
    <td>  <label class="error" for="passs" id="pass_error" style="display:none">This field is required.</label></td>
      </td>
      </tr>
      
      <tr>
      <td colspan="2" align="center">
      <input type="submit" name="submit" class="button" id="submit_btn" value="Send" />
      </td>
      </tr>
      
      </table>
  </form>
      </div>
</div>

