<form method="POST">
    Username: <input required name="p_username" type="text" /> <br><br>
    Email Address: <input required name="p_emailadress" type="text" /> <br><br>
    Password: <input required name="p_passwort" type="password" /> <br><br>
    <button type="submit">Add User</button>
</form>

<form>
    <button type="submit" formaction="UebungKlausur.php">Startseite</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['p_username'];
    $emailadresse = $_POST['p_emailadress'];
    $passwort = $_POST['p_passwort'];  //password_hash($_POST['p_passwort'], PASSWORD_DEFAULT);  

    $c = oci_connect("iaf", "iaf", "localhost/orcl");
    if (!$c) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    }

    $sql_check = "SELECT COUNT(*) AS count FROM tbl_userProfile WHERE username = :username OR emailadress = :emailadresse";
    $stmt_check = oci_parse($c, $sql_check);
    oci_bind_by_name($stmt_check, ':username', $username);
    oci_bind_by_name($stmt_check, ':emailadresse', $emailadresse);
    oci_execute($stmt_check);
    $row = oci_fetch_assoc($stmt_check);
    $user_exists = $row['COUNT'];

    if ($user_exists > 0) {
        echo "User already exists!";
    } else {
        $sql = "BEGIN add_user(:username, :emailadresse, :passwort); END;";
        $S2 = oci_parse($c, $sql);
        oci_bind_by_name($S2, ':username', $username);
        oci_bind_by_name($S2, ':emailadresse', $emailadresse);
        oci_bind_by_name($S2, ':passwort', $passwort);
        oci_execute($S2);
        oci_commit($c);
        oci_close($c);

        echo "User added successfully!";
    }
}
?>
