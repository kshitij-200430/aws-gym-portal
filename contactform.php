<?php
// This contact Us Form wont work with Local Host but it will work on Live Server
if(isset($_REQUEST['submit'])) {
 // Checking for Empty Fields
 if(($_REQUEST['name'] == "") || ($_REQUEST['subject'] == "") || ($_REQUEST['email'] == "") || ($_REQUEST['message'] == "")){
  // msg displayed if required field missing
  $msg = '<div id="warningMsg" class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {
  $msg = '<div id="successMsg" class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Sent Successfully </div>';
 }
}
?>

<!--Start Contact Us Row-->
<div class="col-md-8">
 <!--Start Contact Us 1st Column-->
 <form action="" method="post">
  <input type="text" class="form-control" name="name" placeholder="Name"><br>
  <input type="text" class="form-control" name="subject" placeholder="Subject"><br>
  <input type="email" class="form-control" name="email" placeholder="E-mail"><br>
  <textarea class="form-control" name="message" placeholder="How can we help you?" style="height:150px;"></textarea><br>
  <input class="btn btn-primary" type="submit" value="Send" name="submit"><br><br>
  <?php if(isset($msg)) {echo $msg; } ?>
 </form>
</div>
<div  class="col-md-4 bg-primary text-light text-center p-4" style="min-height: 150px; max-height: 200px;">
        <h4>Profitness Gym</h4>
        <p>Pro-fitness,
          Opposite McDonalds,
          Warje Pune-58<br/>
          phone: +91 9575983647<br/>
          www.profitness.com
        </p>
     </div>
</div>
</div> <!-- End Contact Us 1st Column-->

<script>
// JavaScript to hide the success and warning messages after 5 seconds
setTimeout(function() {
    var successMsg = document.getElementById('successMsg');
    var warningMsg = document.getElementById('warningMsg');
    
    if (successMsg) {
        successMsg.style.display = 'none';
    }
    if (warningMsg) {
        warningMsg.style.display = 'none';
    }
}, 5000); // 5000 milliseconds = 5 seconds
</script>