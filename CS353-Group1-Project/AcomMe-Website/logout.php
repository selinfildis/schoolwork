<?php

include "header.php";
include "navbar.php";
session_destroy();
header("Location: index.php");
exit;

