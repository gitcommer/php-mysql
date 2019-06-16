<?php
//register.php

if(isset($_POST["submit"])) {
  $reg_date = date("Y-m-d h:i:sa");
  $link=mysqli_connect("localhost","root","", "sinugba");
  $resUsername=mysqli_query($link,"select * from admin where username='$_POST[username]'"); //name="username" and name="pwd"
  if (mysqli_num_rows($resUsername)) {
      echo '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Oops!</strong> this username '. $_POST['username'] .' allready exists.
            </div>';
  } else {

      $resContact=mysqli_query($link,"select * from admin where contact='$_POST[cnt]'"); //name="username" and name="pwd"
      if (mysqli_num_rows($resContact)) {
          echo '<div class="alert alert-dismissible alert-danger">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Oops!</strong> this contact number '. $_POST['cnt'] .' allready exists.
                </div>';
      } else {
          $v1=rand(1111,9999);
          $v2=rand(1111,9999);
          $v3=$v1.$v2;
          $v3=md5($v3);
          $fnm=$_FILES["product_img"]["name"];
          $dst="./product_image/".$v3.$fnm;
          $dst1="product_image/".$v3.$fnm;
          //$admin_id=$_SESSION["id"];
          move_uploaded_file($_FILES["product_img"]["tmp_name"],$dst);
          mysqli_query($link,"insert into admin values('','none','$_POST[purpose]','$dst1','$_POST[username]','$_POST[pwd]','$_POST[fname]',
                                                          '$_POST[lastname]','none','$_POST[bday]','$_POST[cnt]','$_POST[gnder]','$reg_date',1)");
                                                          //i update lang ng mga none sa customer and employee register page
          ?>
          <script type="text/javascript">
              alert("Thank for registering with us. You may now login your account.");
              window.location="login.php";
          </script>
          <?php
      }
    }
}
?>