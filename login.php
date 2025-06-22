<?php
session_start(); //inicia a sessao

//seestiver logado, redireciona direto para o painel
if (isset($_SESSION['usuario'])) {
    header("Location: funcionario/painel.php");
    exit;
}

//verifica se o formulsrio foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config/database.php'; //conexão com o banco

    //Aqui foi usado o usuario e senha, conectando os dois atributos do banco
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    //consulta o banco para encontrar o funcionario
    $stmt = $pdo->prepare("SELECT * FROM funcionario WHERE nome = ? AND senha = ?");
    $stmt->execute([$usuario, $senha]);
    $funcionario = $stmt->fetch();

    //se encontrou o usuaroi, cria a sessao
    if ($funcionario) {
        $_SESSION['usuario'] = $funcionario['usuario'];
        header("Location: funcionario/painel.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>

<h2>Login Funcionário</h2>

<!--mensagem de erro, se existir-->
<?php if (isset($erro)): ?>
  <p style="color:red;"><?= $erro ?></p>
  <?php endif; ?>
  
  <!--formulario de login-->
  <!--Tentem transformar o Entrar em um botão-->
  <form method="POST">
    Usuário: <input name="usuario" required><br><br>
    Senha: <input name="senha" type="password" required><br><br>
    <a href="cadastrar_produto" type="submit">Entrar</button>
  </form>
  
