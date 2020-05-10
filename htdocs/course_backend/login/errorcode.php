<?php

$error_code = null;

$error_code['SUCCESS'] = 0;

$error_code['INCOMPLETE_AUTH_DATA']     = 1000;

$error_code['INCORRECT_AUTH_DATA']      = 1001;

$error_code['EXPIRED_AUTH_DATA']        = 1002;

echo $error_code['SUCCESS'];

?>