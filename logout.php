<?php
session_start();//inicia a sessao
session_destroy();//finaliza a sessao
header("Location: index.php");//manda pra pagina inicial
exit;
