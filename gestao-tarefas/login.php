<?php
require_once __DIR__ . '/conexao.php';

if (usuarioAtual()) {
    header('Location: index.php');
    exit;
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mb_strtolower(trim($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';

    $usuario = R::findOne('usuarios', 'email = ?', [$email]);
    if ($usuario && password_verify($senha, $usuario->senha)) {
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = (int) $usuario->id;
        $_SESSION['usuario_nome'] = (string) $usuario->nome;
        $_SESSION['usuario_email'] = (string) $usuario->email;
        header('Location: index.php');
        exit;
    }
    $erro = 'E-mail ou senha inválidos.';
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Entrar · Metas</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page">
<main class="auth-card">
    <a class="auth-brand" href="login.php"><span class="brand-mark">✓</span> Metas</a>
    <p class="eyebrow">Bem-vindo de volta</p>
    <h1>Entrar na sua conta</h1>
    <p class="auth-description">Acesse suas tarefas e continue de onde parou.</p>
    <?php if ($erro): ?><div class="flash error"><?= e($erro) ?></div><?php endif; ?>
    <form method="post">
        <div class="field">
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" required autocomplete="email" placeholder="seu@email.com">
        </div>
        <div class="field">
            <label for="senha">Senha</label>
            <input id="senha" name="senha" type="password" required autocomplete="current-password" placeholder="Sua senha">
        </div>
        <button class="primary-btn auth-submit" type="submit">Entrar</button>
    </form>
    <p class="auth-footer">Ainda não tem uma conta? <a href="cadastro.php">Criar usuário</a></p>
</main>
</body>
</html>
