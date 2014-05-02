<form action="#" method="post">
username <input type="text" name="name"><br>
password <input type="text" name="clearTextPassword"><br>
<input type="submit">
</form>

<?php

// Password to be encrypted for a .htpasswd file
$clearTextPassword = 'adam';

// Encrypt password
$password = crypt($clearTextPassword, base64_encode($clearTextPassword));

// Print encrypted password
echo $password;
?>