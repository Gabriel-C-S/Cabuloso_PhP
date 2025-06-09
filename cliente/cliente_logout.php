<?php
session_start();

// Remove apenas o carrinho da sessão
unset($_SESSION['carrinho']);

// Opcional: destruir toda a sessão
// session_destroy();

header("Location: index.php"); // Volta para a loja
exit;
