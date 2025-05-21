<!DOCTYPE html>
<html lang="en">
<?php
include 'menu.inc.php';
draw_headerhtml("Job Enquiries");
?>

<body>

<p>Looking for a postion?</p>
<p>Fill out the form and we'll get back to you if interested</p>
<form method="post" action="processEOI.php" novalidate="novalidate">
<fieldset>
    <legend>Applicant Details:</legend>                                                                                                         <!--  this is a legend labeling the applicant details part of the form -->
    <label for="jobRefNum">Job reference number</label>                                                                                         <!--  this is the label for the job reference box, input for the job reference box underneath-->
    <input type="text" id="jobRefNum" name="jobRefNum" required pattern="[A-Za-z0-9]+" maxlength="5" minlength="5" placeholder="eg: 12345">     
    <p>                                                                                                                                         
    <label for="firstName">First name</label>                                                                                                   <!--  this is the label for the first name box, input for the first name box underneath-->
    <input type="text" id="firstName" name="firstName" required pattern="[A-Za-z]+" maxlength="20">                                             
    <label for="lastName">Last name</label>                                                                                                     <!--  this is the label for the last name box, input for the last name box underneath-->
    <input type="text" id="lastName" name="lastName" required pattern="[A-Za-z]+" maxlength="20">                                               
    </p>                                                                                                                                        
    <label for="DOB">Date of Birth</label>                                                                                                      <!--  this is the label for the Date of Birth with Date box underneath-->
    <input type="date" id="DOB" name="DOB" required>                                                                                            
</fieldset>

<fieldset>
<legend>Gender</legend>                                                                                                           <!-- gender legend, radio buttons with validation under it -->
<p>
    <input type="radio" name="Gender" value="Woman" required>                                                                                                  
    <label>Woman</label>                                                                                                    
    <input type="radio" name="Gender" value="Man" required >                                                                                                  
    <label>Man</label>                                                                                                  
    <input type="radio" name="Gender" value="Other" required >                                                                                                  
    <label>Other</label>                                                                                                                                                                                                    
</p>
</fieldset>

<fieldset>
    <legend>Address</legend>                                                                                                       <!-- address legend -->
<p>
    <label for="strAdd">Street Address</label>                                                                                     <!-- label for street address, text box with validation under it -->                           
    <input type="text" id="strAdd" name="strAdd" required pattern="[A-Za-z0-9 ]+" maxlength="40" >                                                                                                  
</p>
<p>
    <label for="suburb">Suburb/Town</label>                                                                                        <!-- label for suburb or town, text box with validation under it -->           
    <input type="text" id="suburb" name="suburb" required pattern="[A-Za-z0-9]+" maxlength="40" >                                                                                                   
</p>
<p>    
<label for="State">State</label>                                                                                                    <!-- label for State, drop down select box underneath -->
    <select id="State" name="State" required>                                                                                                  
       <option value="">Please Select</option>                                                                                                  
       <option value="VIC">VIC</option>                                                                                                  
       <option value="QLD">QLD</option>                                                                                                  
       <option value="NSW">NSW</option>                                                                                                  
       <option value="NT">NT</option>                                                                                                  
       <option value="WA">WA</option>                                                                                                  
       <option value="TAS">TAS</option>                                                                                                  
       <option value="ACT">ACT</option>                                                                                                  
       <option value="SA">SA</option>                                                                                                  
   </select>
   <label for="postcode">Postcode</label>                                                                                           <!-- label for postcode, text box with validation under it -->                                          
   <input type="text" id="postcode" name="postcode" required pattern="\d[0-9]+" maxlength="4" >                                                                                                  
</p>
</fieldset>
<fieldset>
<legend>Contact Details</legend>                                                                                                    <!-- contact details --> 

<label for="emailField">Email</label>                                                                                               <!-- label for email, email box with validation under it -->
<input type="email" id="emailField" name="emailField" required >                                                                                                   

<label for="pNumber">Phone Number</label>                                                                                           <!-- label for phone number, text box with validation under it -->
<input type="text" id="pNumber" name="pNumber" required pattern="\d[0-9 ]+" maxlength="12" minlength="8">                                                                                                  

</fieldset>

<fieldset>
    <legend>Skills</legend>                                                                                                  
    <p>
       <label for="Skill1">Skill1</label>                                                                                                  
       <input type="checkbox" id="Skill1" name="skill[]" value="Skill1" checked>                                                                       <!-- checkbox, only skill1 is automatically checked -->                           
       <label for="Skill2">Skill2</label>
       <input type="checkbox" id="Skill2" name="skill[]" value="Skill2">
       <label for="Skill3">Skill3</label>
       <input type="checkbox" id="Skill3" name="skill[]" value="Skill3">
       <label for="Skill4">Skill4</label>
       <input type="checkbox" id="Skill4" name="skill[]" value="Skill4">
       <label for="otherSkill">Other Skills</label>
       <input type="checkbox" id="otherSkill" name="skill[]" value="otherSkill">
   </p>
    <label for="otherskill">Other Skills:</label>                                                                                                  
    <br>
    <textarea id="otherskill" name="otherskill" placeholder="if you selected other skill, please write a short description" rows="4" cols="40"></textarea>          <!-- comment area to write about your other skills -->


</fieldset>

<input type="submit" value="Apply">                                <!-- submits the form -->
<input type="reset" value="Reset">                              <!-- resets the form -->
        

</form>


<?php draw_footerhtml(); ?>

</body>
        
</html>
        