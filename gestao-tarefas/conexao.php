<?php
declare(strict_types=1);

require_once __DIR__ . '/class/rb.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = getenv('DB_PORT') ?: '3306';
$name = getenv('DB_NAME') ?: 'gestao_tarefas';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

R::setup(
    "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4",
    $user,
    $pass
);

R::exec(
    'CREATE TABLE IF NOT EXISTS usuarios (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(120) NOT NULL,
        email VARCHAR(190) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL,
        criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB'
);

R::exec(
    'CREATE TABLE IF NOT EXISTS tarefas (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT UNSIGNED NOT NULL,
        titulo VARCHAR(180) NOT NULL,
        descricao TEXT NULL,
        categoria VARCHAR(80) NOT NULL DEFAULT "Trabalho",
        prioridade ENUM("Baixa", "Normal", "Alta") NOT NULL DEFAULT "Normal",
        prazo DATE NULL,
        concluida TINYINT(1) NOT NULL DEFAULT 0,
        criada_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        atualizada_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_tarefas_usuario (user_id),        INDEX idx_tarefas_status (concluida),
        INDEX idx_tarefas_prazo (prazo)
    ) ENGINE=InnoDB'
);

// Atualiza instalações anteriores sem alterar os dados ou o visual do projeto.
$colunaUsuario = R::getCell("SHOW COLUMNS FROM tarefas LIKE 'user_id'");
if (!$colunaUsuario) {
    R::exec('ALTER TABLE tarefas ADD user_id INT UNSIGNED NULL AFTER id');
    R::exec('ALTER TABLE tarefas ADD INDEX idx_tarefas_usuario (user_id)');
}

function usuarioAtual(): ?array
{
    if (empty($_SESSION['usuario_id'])) {
        return null;
    }

    return [
        'id' => (int) $_SESSION['usuario_id'],
        'nome' => (string) ($_SESSION['usuario_nome'] ?? 'Usuário'),
        'email' => (string) ($_SESSION['usuario_email'] ?? ''),
    ];
}

function exigirLogin(): void
{
    if (!usuarioAtual()) {
        header('Location: login.php');
        exit;
    }
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function topo(string $titulo, string $pagina): void
{
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= e($titulo) ?> · Metas</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <input class="menu-toggle-checkbox" type="checkbox" id="menu-toggle">

        <div class="app-shell">
            <aside class="sidebar">
                <a class="brand" href="index.php">
                    <span class="brand-mark">✓</span>
                    <span>Metas</span>
                </a>

                <nav class="nav-list">
                    <a class="nav-link <?= $pagina === 'index' ? 'active' : '' ?>" href="index.php">
                        <span>▦</span>
                        Minhas tarefas
                    </a>
                    <a class="nav-link <?= $pagina === 'inclusao' ? 'active' : '' ?>" href="inclusao.php">
                        <span>＋</span>
                        Nova tarefa
                    </a>
                </nav>

                <div class="sidebar-bottom">
                    <div class="mini-help">
                        <span class="help-icon">?</span>
                        <div>
                            <strong>Organize seu dia</strong>
                            <small>Um passo de cada vez.</small>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="main-content">
                <header class="topbar">
                    <label class="menu-button" for="menu-toggle">☰</label>
                    <div class="breadcrumb">
                        <span>Workspace</span>
                        <b>/</b>
                        <strong><?= e($titulo) ?></strong>
                    </div>
                    <div class="account" style="display:flex;align-items:center;gap:12px">
                        <span style="font-size:12px;color:#687386"><?= e(usuarioAtual()['nome'] ?? '') ?></span>
                        <a href="logout.php" style="font-size:12px;color:#687386;text-decoration:none">Sair</a>
                        <span class="avatar">✓</span>
                    </div>
                </header>
    <?php
}

function rodape(): void
{
    ?>
            </main>
        </div>
    </body>
    </html>
    <?php
}
