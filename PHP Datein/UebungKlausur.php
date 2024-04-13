<!DOCTYPE html>

<html>

<head>
  <title>Hello!</title>
         <h1>willkommen</h1>
</head>

<body>

<form>
<button type= "submit" formaction="insertuser.php">Registrieren</button>

<button type= "submit" formaction="InsertGame.php">Spiel Hinzuf&uuml;gen</button>
<button type= "submit" formaction="LoginPage.php">login</button>
</form>

<?php



$c = oci_connect ("iaf","iaf","localhost/orcl");
if (!$c)
{
    $e = oci_error();
    trigger_error('could not connect to database:'.$e['message'],E_USER_ERROR);

}

?>
