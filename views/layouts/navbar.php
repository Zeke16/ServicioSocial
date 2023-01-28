<?php

use yii\helpers\Html;

?>
<style>
    .main-header {
        background-color: #c5ccd6;
        border-bottom: #000 1px solid;
    }

    .main-header h3,
    .main-header ul li,
    .main-header ul li a {
        color: #000;
    }
</style>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <h3> Sistema de control de incidencias </h3>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="<?= Yii::$app->request->hostInfo . Yii::$app->user->identity->imagen ?>" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?= Yii::$app->user->identity->username ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="<?= Yii::$app->request->hostInfo . Yii::$app->user->identity->imagen ?>" class="img-circle elevation-2" alt="User Image">
                    <p>
                        <?= Yii::$app->user->identity->nombres . ' ' . Yii::$app->user->identity->apellidos ?>
                        <small>
                            USUARIO
                        </small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <?= Html::a('Ver Perfil', ['/usuarios/view', 'id_usuario' => Yii::$app->user->identity->id], ['data-method' => 'post', 'class' => 'btn btn-flat rounded rounded border border-dark']) ?>
                    <?= Html::a('Cerrar Sesión', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-flat rounded border border-dark float-right']) ?>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
    </ul>


</nav>