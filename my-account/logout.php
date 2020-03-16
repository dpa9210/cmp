<?php
session_start();
session_unset();
session_destroy();
header('Refresh:0; url=index.php?reply='.urlencode(base64_encode("Logout successful.")));
?>
