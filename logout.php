<?php
require_once './bootstrap.php';

session_start();
session_unset();
session_destroy();
redirect('login');