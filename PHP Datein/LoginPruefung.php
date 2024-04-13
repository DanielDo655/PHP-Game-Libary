<?php
// Establish database connection
$c = oci_connect("iaf", "iaf", "localhost/orcl");
if (!$c) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Start session
session_start();


if(isset($_POST['p_username']) && isset($_POST['p_passwort']) && isset($_POST['p_emailadress'])) {
    // Sanitize inputs to prevent SQL injection
    $username = $_POST['p_username'];
    $password = $_POST['p_passwort'];
    $email = $_POST['p_emailadress'];
    

    // Prepare SQL query with placeholders
    $sql = "SELECT user_id FROM tbl_userProfile WHERE username = :username AND passwort = :passwort AND emailadress = :email ";

    // Prepare statement
    $s = oci_parse($c, $sql);

    // Bind variables
    oci_bind_by_name($s, ":username", $username);
    oci_bind_by_name($s, ":passwort", $password);
    oci_bind_by_name($s, ":email", $email);
    
    // Execute statement
    oci_execute($s);

    // Fetch row
    $row = oci_fetch_array($s, OCI_NUM);
    $user_id = $row[0];
   
    if ($row) {

        $user_id = $row[0];
        $_SESSION["user_id"] = $user_id;
        $_SESSION["login"] = true;
        echo("es funktioniert");
        
    } else {

        echo "Falsche Anmeldedaten. Bitte überprüfen Sie Ihre Eingaben.";
    }
}

?>

<?php
if(isset($_SESSION["login"])) {
    echo $row;
    header('location:UebungKlausur.php');
   exit();
} else {
    echo "shit";
    header ('location:LoginPage.php');
    exit();
}
?>
