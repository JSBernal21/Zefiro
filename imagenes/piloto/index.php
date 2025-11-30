<?php
header('HTTP/1.1 302 Found');
if ($_SERVER['REMOTE_ADDR'] == "::1") {
    header('Location: /proyecto2API');
} else {
    header('Location: /');
}
exit;
?>