<!DOCTYPE html>
<html>
<head>
    <title>Post | Projeto para Web com PHP</title>
    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include 'includes/topo.php'; ?>
                <?php include 'includes/valida_login.php'; ?>
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

                foreach ($_GET as $indice => $dado) {
                    $$indice = limparDados($dado);
                }

                if (!empty($id)) {
                    $id = (int)$id;

                    $criterio = [
                        'id' => $id
                    ];

                    $retorno = buscar(
                        'post',
                        'post',
                        [
                            'id',
                            'titulo',
                            'texto',
                            'data_postagem'
                        ],
                        $criterio
                    );

                    $entidade = $retorno[0];
                }
            ?>
            <h2>Post</h2>
            <form method="post" action="core/post_repositorio.php">
                <input type="hidden" name="acao" value="<?php echo (empty($id) ? 'insert' : 'update') ?>">
                <input type="hidden" name="id" value="<?php echo (empty($id) ? '' : $id) ?>">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" require="required" value="<?php echo (isset($entidade['titulo']) ? $entidade['titulo'] : '') ?>">
                </div>
                <div class="form-group">
                    <label for="texto">Texto</label>
                    <textarea class="form-control" id="texto" name="texto" rows="5" require="required"><?php echo (isset($entidade['texto']) ? $entidade['texto'] : '') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="data_postagem">Postar em</label>
                    <?php
                        $data = (empty($entidade['data_postagem'])) ? '' : explode(' ', $entidade['data_postagem']);
                        $hora = (empty($entidade['data_postagem'])) ? '' : $data[1];
                        $data = (empty($entidade['data_postagem'])) ? '' : $data[0];
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="data_postagem" name="data_postagem" value="<?php echo $data ?>">
                        </div>
                        <div class="col-md-3">
                            <input type="time" class="form-control" id="hora_postagem" name="hora_postagem" value="<?php echo $hora ?>">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-success" type="submit">Salvar</button>
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
