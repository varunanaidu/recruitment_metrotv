<?php
$sslEnabled = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? TRUE : FALSE;
echo 'SSL : ' . ($sslEnabled ? 'on' : 'off');