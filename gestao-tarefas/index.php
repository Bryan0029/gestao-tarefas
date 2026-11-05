<?php
require_once __DIR__ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alternar'])) {
    $tarefa = R::load('tarefas', (int) $_POST['id']);

    if ($tarefa->id) {
        $tarefa->concluida = $tarefa->concluida ? 0 : 1;
        R::store($tarefa);
    }

    header('Location: index.php');
    exit;
}

$filtro = $_GET['filtro'] ?? 'todas';
$ordem = 'ORDER BY concluida ASC, prazo IS NULL ASC, prazo ASC, criada_em DESC';

if ($filtro === 'pendentes') {
    $consulta = 'WHERE concluida = 0 ' . $ordem;
} elseif ($filtro === 'concluidas') {
    $consulta = 'WHERE concluida = 1 ' . $ordem;
} else {
    $consulta = $ordem;
}

$tarefas = R::findAll('tarefas', $consulta);
$total = R::count('tarefas');
$concluidas = R::count('tarefas', 'concluida = 1');
$pendentes = $total - $concluidas;
$percentual = $total ? round(($concluidas / $total) * 100) : 0;

topo('Minhas tarefas', 'index');
?>
<section class="page">
    <div class="page-heading">
        <div>
            <p class="eyebrow">Visão geral</p>
            <h1>Minhas tarefas</h1>
            <p>Organize seu dia e mantenha o foco no que importa.</p>
        </div>
        <a class="primary-btn" href="inclusao.php">＋ Nova tarefa</a>
    </div>

    <?php if (isset($_GET['sucesso'])): ?>
        <div class="flash success">Tarefa adicionada com sucesso.</div>
    <?php endif; ?>

    <?php if (isset($_GET['excluida'])): ?>
        <div class="flash success">Tarefa excluída.</div>
    <?php endif; ?>

    <div class="stats">
        <div class="stat-card accent">
            <span class="label">Seu progresso</span>
            <strong>
                <?= $concluidas ?>
                <small style="font:500 13px 'DM Sans';opacity:.75">/ <?= $total ?></small>
            </strong>
            <div class="progress">
                <span style="width:<?= $percentual ?>%"></span>
            </div>
            <small style="display:block;margin-top:9px;opacity:.75">
                <?= $percentual ?>% concluído
            </small>
        </div>

        <div class="stat-card">
            <span class="label">Pendentes</span>
            <strong><?= $pendentes ?></strong>
            <span class="stat-note">para resolver</span>
        </div>

        <div class="stat-card">
            <span class="label">Concluídas</span>
            <strong><?= $concluidas ?></strong>
            <span class="stat-note">bom trabalho</span>
        </div>
    </div>

    <div class="task-card">
        <div class="filters">
            <a class="filter <?= $filtro === 'todas' ? 'active' : '' ?>" href="?filtro=todas">
                Todas (<?= $total ?>)
            </a>
            <a class="filter <?= $filtro === 'pendentes' ? 'active' : '' ?>" href="?filtro=pendentes">
                Pendentes (<?= $pendentes ?>)
            </a>
            <a class="filter <?= $filtro === 'concluidas' ? 'active' : '' ?>" href="?filtro=concluidas">
                Concluídas (<?= $concluidas ?>)
            </a>
        </div>

        <?php if (!$tarefas): ?>
            <div class="empty">
                <strong>Nenhuma tarefa por aqui</strong>
                <span>Adicione uma nova tarefa para começar.</span>
            </div>
        <?php else: ?>
            <table class="task-table">
                <thead>
                    <tr>
                        <th>Tarefa</th>
                        <th>Categoria</th>
                        <th>Prioridade</th>
                        <th>Prazo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarefas as $tarefa): ?>
                        <tr>
                            <td>
                                <div class="task-title <?= $tarefa->concluida ? 'completed' : '' ?>">
                                    <form method="post" action="index.php">
                                        <input type="hidden" name="id" value="<?= (int) $tarefa->id ?>">
                                        <button
                                            class="check <?= $tarefa->concluida ? 'done' : '' ?>"
                                            name="alternar"
                                            title="Alternar conclusão"
                                        ><?= $tarefa->concluida ? '✓' : '' ?></button>
                                    </form>
                                    <div>
                                        <strong><?= e($tarefa->titulo) ?></strong>
                                        <?php if ($tarefa->descricao): ?>
                                            <small><?= e(mb_strimwidth($tarefa->descricao, 0, 72, '…')) ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td><span class="pill"><?= e($tarefa->categoria) ?></span></td>
                            <td>
                                <span class="pill <?= $tarefa->prioridade === 'Alta' ? 'high' : ($tarefa->prioridade === 'Baixa' ? 'low' : '') ?>">
                                    <?= e($tarefa->prioridade) ?>
                                </span>
                            </td>
                            <td class="task-date">
                                <?= $tarefa->prazo ? e(date('d/m/Y', strtotime((string) $tarefa->prazo))) : 'Sem prazo' ?>
                            </td>
                            <td>
                                <a class="icon-button" href="exclusao.php?id=<?= (int) $tarefa->id ?>">⌫</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>
<?php rodape(); ?>
