<!DOCTYPE html>
<html>
<head>
    <title>Usuários | Projeto para Web com PHP</title>
    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include 'includes/topo.php'; ?>
                <?php
                    include 'includes/valida_login.php';
                    if ($_SESSION['login']['usuario']['adm'] !== 1) {
                        header('Location: index.php');
                    }
                ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <?php include 'includes/menu.php'; ?>
            </div>
        </div>
        <div class="col-md-10" style="padding-top: 50px;">
            <h2>Usuários</h2>
            <?php
                require_once 'includes/funcoes.php';
                require_once 'core/conexao_mysql.php';
                require_once 'core/sql.php';
                require_once 'core/mysql.php';

                foreach ($_GET as $indice => $dado) {
                    $$indice = limparDados($dado);
                }

                $data_atual = date('Y-m-d H:i:s');

                $criterio = [];

                if (!empty($busca)) {
                    $criterio = [
                        'nome' => ['like', '%'.$busca.'%']
                    ];
                }

                $result = buscar(
                    'usuario',
                    'usuario',
                    [
                        'id',
                        'nome',
                        'email',
                        'adm',
                        'ativo',
                        'data_criacao DESC, nome ASC'
                    ],
                    $criterio
                );
            ?>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>E-mail</td>
                        <td>Ativo</td>
                        <td>Administrador</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $entidade) { ?>
                        <tr>
                            <td><?php echo $entidade['nome'] ?></td>
                            <td><?php echo $entidade['email'] ?></td>
                            <td><?php echo ($entidade['ativo'] == 1) ? 'Sim' : 'Não' ?></td>
                            <td><?php echo ($entidade['adm'] == 1) ? 'Sim' : 'Não' ?></td>
                            <td>
                                <a href="usuario_formulario.php?id=<?php echo $entidade['id'] ?>" class="btn btn-info">Atualizar</a>
                                <a href="core/usuario_repositorio.php?acao=delete&id=<?php echo $entidade['id'] ?>" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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
