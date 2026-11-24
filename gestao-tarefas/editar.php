<?php
declare(strict_types=1);

require_once __DIR__ . '/conexao.php';
exigirLogin();

$usuarioId = usuarioAtual()['id'];
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
}

if (!$id || $id < 1) {
    header('Location: index.php');
    exit;
}

// Garante que o objetivo pertence ao usuário conectado.
$tarefa = R::findOne('tarefas', 'id = ? AND user_id = ?', [$id, $usuarioId]);

if (!$tarefa || !$tarefa->id) {
    header('Location: index.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $categoria = trim($_POST['categoria'] ?? 'Trabalho');
    $prioridade = $_POST['prioridade'] ?? 'Normal';
    $prazo = trim($_POST['prazo'] ?? '');

    if (mb_strlen($titulo) < 3) {
        $erro = 'Digite um título com pelo menos 3 caracteres.';
    } elseif ($prazo !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $prazo)) {
        $erro = 'Informe uma data válida.';
    } elseif (!in_array($prioridade, ['Baixa', 'Normal', 'Alta'], true)) {
        $erro = 'Selecione uma prioridade válida.';
    } else {
        $tarefa->titulo = $titulo;
        $tarefa->descricao = $descricao ?: null;
        $tarefa->categoria = $categoria ?: 'Trabalho';
        $tarefa->prioridade = $prioridade;
        $tarefa->prazo = $prazo ?: null;

        R::store($tarefa);
        header('Location: index.php?editada=1');
        exit;
    }
}

topo('Editar tarefa', 'index');
?>
<section class="page">
    <div class="page-heading">
        <div>
            <p class="eyebrow">Atualize seus planos</p>
            <h1>Editar tarefa</h1>
            <p>Altere as informações deste objetivo quando precisar.</p>
        </div>
    </div>

    <?php if ($erro): ?>
        <div class="flash error"><?= e($erro) ?></div>
    <?php endif; ?>

    <div class="form-layout">
        <form class="form-card" method="post" action="editar.php">
            <input type="hidden" name="id" value="<?= (int) $tarefa->id ?>">
            <h2>Detalhes da tarefa</h2>
            <p class="subhead">Faça as alterações e salve quando terminar.</p>

            <div class="field-grid">
                <div class="field full">
                    <label for="titulo">Nome da tarefa</label>
                    <input id="titulo" name="titulo" required minlength="3" maxlength="180"
                           value="<?= e((string) $tarefa->titulo) ?>">
                </div>

                <div class="field full">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao"><?= e((string) $tarefa->descricao) ?></textarea>
                </div>

                <div class="field">
                    <label for="prazo">Data de entrega</label>
                    <input id="prazo" name="prazo" type="date"
                           value="<?= e($tarefa->prazo ? (string) $tarefa->prazo : '') ?>">
                </div>

                <div class="field">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" name="categoria">
                        <?php foreach (['Trabalho', 'Pessoal', 'Estudos', 'Casa'] as $opcao): ?>
                            <option value="<?= e($opcao) ?>" <?= $tarefa->categoria === $opcao ? 'selected' : '' ?>>
                                <?= e($opcao) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field">
                    <label for="prioridade">Prioridade</label>
                    <select id="prioridade" name="prioridade">
                        <?php foreach (['Baixa', 'Normal', 'Alta'] as $opcao): ?>
                            <option value="<?= e($opcao) ?>" <?= $tarefa->prioridade === $opcao ? 'selected' : '' ?>>
                                <?= e($opcao) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a class="secondary-btn" href="index.php">Cancelar</a>
                <button class="primary-btn" type="submit">✓ Salvar alterações</button>
            </div>
        </form>

        <aside class="side-card">
            <h3>Objetivo atualizado</h3>
            <p>As alterações serão salvas na sua conta. O status de conclusão será mantido.</p>
        </aside>
    </div>
</section>
<?php rodape(); ?>
