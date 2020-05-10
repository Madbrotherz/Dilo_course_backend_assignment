<?php

SESSION_START();

SESSION_UNSET($_SESSION);

unset($_SESSION['nik']);

unset($_SESSION['token']);

SESSION_DESTROY();

header("Location: http://localhost/course_backend/");

?>