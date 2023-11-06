<?php


session_start();
session_unset();
session_destroy();

header("Location: http://localhost:8100/index.php");