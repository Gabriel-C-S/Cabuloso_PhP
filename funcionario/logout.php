<?php
session_start();
session_destroy(); // apaga dados da sessão (logout)
header("Location: login.php"); //manda para a tela de login
