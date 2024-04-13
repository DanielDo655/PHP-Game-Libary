<!<ol>
    <li></li>
</ol>DOCTYPE html>

<html>

<head>
  <title>Login</title>
  <form method="POST">
      UserName:<input required name ='p_username' type='text'>
      Email:   <input required name ='p_emailadresse' type='text'>
      Passwort:  <input required name ='p_passowrt' type='text'>

  </form>
</head>

<body>

<?php
if (isset ($_POST ['p_username'])) {
   $username =  $_POST['p_username'];
   $email =  $_POST['p_emailadresse'];
   $passwort =  $_POST['p_passwort'];

   $c = oci_connect("iaf", "iaf", "localhost/orcl");
   $sql = "call add_user('$username','$Email','$passwort')";
   $s1 = oci_parse($c, $sql);
   oci_execute($s1);
   oci_commit($c);
}
?>

</body>
</html>