<?php
require_once __DIR__ . '/conexao.php';

if (usuarioAtual()) {
    header('Location: index.php');
    exit;
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = mb_strtolower(trim($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';
    $confirmacao = $_POST['confirmacao'] ?? '';

    if (mb_strlen($nome) < 2) {
        $erro = 'Informe seu nome (pelo menos 2 caracteres).';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Informe um e-mail válido.';
    } elseif (strlen($senha) < 8) {
        $erro = 'A senha deve ter pelo menos 8 caracteres.';
    } elseif ($senha !== $confirmacao) {
        $erro = 'As senhas não coincidem.';
    } elseif (R::findOne('usuarios', 'email = ?', [$email])) {
        $erro = 'Já existe uma conta cadastrada com esse e-mail.';
    } else {
        $usuario = R::dispense('usuarios');
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = password_hash($senha, PASSWORD_DEFAULT);
        R::store($usuario);

        session_regenerate_id(true);
        $_SESSION['usuario_id'] = (int) $usuario->id;
        $_SESSION['usuario_nome'] = $nome;
        $_SESSION['usuario_email'] = $email;
        header('Location: index.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Criar conta · Metas</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page">
<main class="auth-card">
    <a class="auth-brand" href="cadastro.php"><span class="brand-mark">✓</span> Metas</a>
    <p class="eyebrow">Comece a se organizar</p>
    <h1>Criar sua conta</h1>
    <p class="auth-description">Cadastre-se para ter suas próprias tarefas.</p>
    <?php if ($erro): ?><div class="flash error"><?= e($erro) ?></div><?php endif; ?>
    <form method="post">
        <div class="field">
            <label for="nome">Nome</label>
            <input id="nome" name="nome" required maxlength="120" autocomplete="name" value="<?= e($_POST['nome'] ?? '') ?>" placeholder="Seu nome">
        </div>
        <div class="field">
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" required autocomplete="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="seu@email.com">
        </div>
        <div class="field">
            <label for="senha">Senha</label>
            <input id="senha" name="senha" type="password" required minlength="8" autocomplete="new-password" placeholder="Mínimo de 8 caracteres">
        </div>
        <div class="field">
            <label for="confirmacao">Confirmar senha</label>
            <input id="confirmacao" name="confirmacao" type="password" required minlength="8" autocomplete="new-password" placeholder="Digite a senha novamente">
        </div>
        <button class="primary-btn auth-submit" type="submit">Criar conta</button>
    </form>
    <p class="auth-footer">Já tem uma conta? <a href="login.php">Fazer login</a></p>
</main>
</body>
</html>
