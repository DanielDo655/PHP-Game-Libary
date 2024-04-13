<?php   
session_start();

$logged = false;
$login ='login';  

if(!isset ($_SESSION['user_id']))
{
  $login ='login';
  $logged = false;
  $nachricht = 'nicht eingloggt';  
}
else 
{
  $logged = true;
 $login = 'logout';
 $nachricht = 'eingloggt';  
}

$action = '';
$disabled = true;
    if ($logged) {
      $disabled = False;  
      $action = "Logout.php";
    } else {
        $action = "LoginPage.php";
        $disabled = true;
    }

?>
<!DOCTYPE html>

<html>

<head>
  <title>Hello!</title>
         <h1>willkommen</h1>
</head>

<body>

<form>
<button type= "submit" formaction="insertuser.php">Registrieren</button>
<button type= "submit"  <?php if ($disabled){ ?>disabled<?php  }?>  formaction="InsertGame.php">Spiel Hinzuf&uuml;gen</button>
<button type= "submit" formaction=<?php echo $action;?>><?php echo $login ?></button>
</form>

</body>

<?php


$c = oci_connect ("iaf","iaf","localhost/orcl");
if (!$c)
{
    $e = oci_error();
    trigger_error('could not connect to database:'.$e['message'],E_USER_ERROR);

}

?>
