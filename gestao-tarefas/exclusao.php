<?php
require_once __DIR__ . '/conexao.php';

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$tarefa = R::load('tarefas', $id);

if (!$tarefa->id) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    R::trash($tarefa);
    header('Location: index.php?excluida=1');
    exit;
}

topo('Excluir tarefa', 'exclusao');
?>
<section class="page">
    <div class="delete-box form-card">
        <p class="eyebrow">Ação irreversível</p>
        <h1>Excluir esta tarefa?</h1>
        <p class="delete-description">Essa ação não poderá ser desfeita.</p>

        <div class="warning">
            <strong><?= e($tarefa->titulo) ?></strong>
            <?php if ($tarefa->descricao): ?>
                <br><?= e($tarefa->descricao) ?>
            <?php endif; ?>
        </div>

        <form class="delete-actions" method="post">
            <input type="hidden" name="id" value="<?= (int) $tarefa->id ?>">
            <a class="secondary-btn" href="index.php">Cancelar</a>
            <button class="danger-btn" type="submit">Excluir tarefa</button>
        </form>
    </div>
</section>
<?php rodape(); ?>
