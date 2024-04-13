<form method = "POST">
Titel:  <input required name='p_titel' type="text" />  </br></br>
Genre:   <input required name='p_genre' type="text" /> </br></br>
Description:  <input required name='p_description' type="text" /> </br></br>
Platform:    <input required name='p_platform' type="text" />  </br></br>
Release:    <input required name='p_release' type="date" />   </br></br>


<button type="submit"  > Game Anlegen </button>


</form>
<form >
<button type= "submit" formaction="UebungKlausur.php">Startseite</button>
</form>

<?php
session_start();

if (isset ($_POST ['p_titel'])) {
   $titel =  $_POST['p_titel'];
   $genre =  $_POST['p_genre'];
   $description =  $_POST['p_description'];
   $platform =  $_POST['p_platform'];
   $release =   $_POST['p_release'];
   $user_id = $_SESSION['user_id'];
   $c = oci_connect("iaf", "iaf", "localhost/orcl");
   $sql = "call add_games('$titel','$genre','$description','$platform',TO_date('$release','YYYY-MM-DD'),'$user_id')";
   $s1 = oci_parse($c, $sql);
   oci_execute($s1);
   oci_commit($c);
}
?>