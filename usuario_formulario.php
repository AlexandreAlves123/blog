<!DOCTYPE html>
<html>
<head>
    <title>Usuário | Projeto para Web com PHP</title>
    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include 'includes/topo.php'; ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <?php include 'includes/menu.php'; ?>
            </div>
        </div>
        <div class="col-md-10" style="padding-top: 50px;">
            <?php
                require_once 'includes/funcoes.php';
                require_once 'core/conexao_mysql.php';
                require_once 'core/sql.php';
                require_once 'core/mysql.php';

                if (isset($_SESSION['login'])) {
                    $id = (int)$_SESSION['login']['usuario']['id'];

                    $criterio = [
                        'id' => $id
                    ];

                    $retorno = buscar(
                        'usuario',
                        'usuario',
                        [
                            'id',
                            'nome',
                            'email'
                        ],
                        $criterio
                    );

                    $entidade = $retorno[0];
                }
            ?>
            <h2>Usuário</h2>
            <form action="core/usuario_repositorio.php" method="post">
                <input type="hidden" name="acao" value="<?php echo (isset($id) ? 'update' : 'insert') ?>">
                <input type="hidden" name="id" value="<?php echo (isset($id) ? $id : '') ?>">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo (isset($entidade['nome']) ? $entidade['nome'] : '') ?>">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo (isset($entidade['email']) ? $entidade['email'] : '') ?>">
                </div>
                <?php if (!isset($_SESSION['login'])) { ?>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>
                    <div class="form-group">
                        <label for="confirmar_senha">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha">
                    </div>
                <?php } ?>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php include 'includes/rodape.php'; ?>
        </div>
    </div>
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>
