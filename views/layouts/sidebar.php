<?php

use yii\helpers\Url;
?>
<style>
    .brand-link {
        margin-top: 1px;
        border-bottom: 1px solid #4f5962;
        border-right: 1px solid #000;
    }

    .brand-link span,
    .nav-sidebar .nav-link p,
    .nav-sidebar .nav-link i {
        color: #fff;
    }

    .brand-link span:hover {
        color: #007bff;
    }

    #tipo-incidencias {
        color: orangered;
    }
    .bg-primary, .card-primary>.card-header{
        background-color: #111e60!important;
    }
    .btn-primary{
        background-color: #111e60!important;
        border: #111e60!important;
    }
    /*.nav-pills .nav-link.active{
    }*/
</style>

<aside class="main-sidebar elevation-4" style="z-index: 1040 !important; background-color: #111e60 !important; border-right: 1px solid #000;">
    <!-- Brand Logo -->
    <a href="<?= Url::home() ?>" class="brand-link">
        <img src="logo2.png" alt="Logo" class="brand-image-xl logo-xs m-0">
        <img src="logo2.png" alt="Logo" class="brand-image-xs logo-xl" style="left: 12px">
        <span class="brand-text font-weight-light" style="margin-left: 45px;"><b>Control de incidencias</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) >
        <div-- class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div-->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview" role="menu" data-accordion="false">

                <!------- DASHBOARD ------->
                <?php if (Yii::$app->controller->id == 'site' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                    $li = "nav-item active";
                    $id = "tipo-incidencias";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item ";
                    $id = '';
                    $a = "nav-link ";
                }

                if (
                    Yii::$app->user->can('MasterAccess') || Yii::$app->user->can('UsuarioEstandarAccess')
                    || Yii::$app->user->can('UsuarioConsultorAccess') || Yii::$app->user->can('UsuarioSupervisorAccess')
                ) {
                ?>
                    <li class="<?= $li ?>"><a class="<?= $a ?>" href="<?php echo Url::toRoute(['/site/index']); ?>"><i class="nav-icon fas fa-home" id="<?=$id?>"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                <?php } ?>
                <!------- END DASHBOARD ------->

                <!------- COMISIONES ------->
                <?php if (Yii::$app->controller->id == 'tbl-comisiones') {
                    $li = "nav-item active";
                    $a = "nav-link active";
                    $id = "tipo-incidencias";
                } else {
                    $li = "nav-item";
                    $a = "nav-link";
                    $id = '';
                }

                if (Yii::$app->user->can('MasterAccess')) {
                ?>
                    <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/tbl-comisiones/index']); ?>"><i class="nav-icon fas fa-ambulance" id="<?=$id?>"></i>
                            <p>Instituciones</p>
                        </a></li>
                <?php } ?>
                <!------- FIN COMISIONES ------->

                <!------- TIPOS DE INCIDENCIAS ------->
                <?php if (Yii::$app->controller->id == 'tbl-tipo-incidencias') {
                    $li = "nav-item active";
                    $a = "nav-link active";
                    $id = "tipo-incidencias";
                } else {
                    $li = "nav-item";
                    $a = "nav-link";
                    $id = '';
                }

                if (Yii::$app->user->can('MasterAccess')) {
                ?>

                    <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/tbl-tipo-incidencias/index']); ?>"><i class="nav-icon fas fa-fire" id="<?=$id?>"></i>
                            <p>Tipos de incidencias</p>
                        </a></li>
                <?php } ?>
                <!------- FIN TIPOS DE INCIDENCIAS ------->

                <!------- TIPOS DE INCIDENCIAS ------->
                <?php if (Yii::$app->controller->id == 'tbl-incidencias') {
                    $li = "nav-item active";
                    $a = "nav-link active";
                    $id = "tipo-incidencias";
                } else {
                    $li = "nav-item";
                    $a = "nav-link";
                    $id = '';
                }

                if (Yii::$app->user->can('MasterAccess') || Yii::$app->user->can('UsuarioEstandarAccess') || Yii::$app->user->can('UsuarioSupervisorAccess')) {
                ?>
                    <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/tbl-incidencias/index']); ?>"><i class="nav-icon fas fa-fire" id="<?=$id?>"></i>
                            <p>Incidencias</p>
                        </a></li>
                <?php } ?>
                
                <!------- FIN INCIDENCIAS ------->

                <!------- MENU USUARIOS ------->
                <?php


                if (Yii::$app->controller->id == 'usuarios' || Yii::$app->controller->id == 'route' || Yii::$app->controller->id == 'permission' || Yii::$app->controller->id == 'role' || Yii::$app->controller->id == 'assignment') {
                    $li = "nav-item has-treeview active menu-open";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item has-treeview";
                    $a = "nav-link";
                }

                if (Yii::$app->user->can('MasterAccess')) {
                ?>
                    <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="#"><i class="nav-icon fas fa-users"></i>
                            <p>Usuarios <i class="right fas fa-angle-left"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (Yii::$app->controller->id == 'usuarios' && in_array(\Yii::$app->controller->action->id, ['index', 'signup'])) {
                                $li = "nav-item active";
                                $a = "nav-link active";
                            } else {
                                $li = "nav-item";
                                $a = "nav-link";
                            }
                            ?>
                            <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/usuarios/index']); ?>"><i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Gestionar usuarios </p>
                                </a></li>

                            <?php if (Yii::$app->controller->id == 'route' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                                $li = "nav-item active";
                                $a = "nav-link active";
                            } else {
                                $li = "nav-item";
                                $a = "nav-link";
                            }
                            ?>
                            <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/rbac/route']); ?>"><i class="nav-icon far fa-circle text-blue"></i>
                                    <p>Gestionar rutas </p>
                                </a></li>

                            <?php if (Yii::$app->controller->id == 'permission' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                                $li = "nav-item active";
                                $a = "nav-link active";
                            } else {
                                $li = "nav-item";
                                $a = "nav-link";
                            }
                            ?>
                            <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/rbac/permission']); ?>"><i class="nav-icon far fa-circle text-purple"></i>
                                    <p>Gestionar permisos </p>
                                </a></li>

                            <?php if (Yii::$app->controller->id == 'role' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                                $li = "nav-item active";
                                $a = "nav-link active";
                            } else {
                                $li = "nav-item";
                                $a = "nav-link";
                            }
                            ?>
                            <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/rbac/role']); ?>"><i class="nav-icon far fa-circle text-green"></i>
                                    <p>Gestionar roles </p>
                                </a></li>

                            <?php if (Yii::$app->controller->id == 'assignment' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                                $li = "nav-item active";
                                $a = "nav-link active";
                            } else {
                                $li = "nav-item";
                                $a = "nav-link";
                            }
                            ?>
                            <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/rbac/assignment']); ?>"><i class="nav-icon far fa-circle text-yellow"></i>
                                    <p>Asignar rol </p>
                                </a></li>
                        </ul>
                    </li>
                    <!------- FIN MENU USUARIOS ------->

                    <!------- MENU DEVS ------->
                    <?php if (Yii::$app->controller->id == 'gii' || Yii::$app->controller->id == 'debug') {
                        $li = "nav-item has-treeview active menu-open";
                        $a = "nav-link active";
                    } else {
                        $li = "nav-item has-treeview";
                        $a = "nav-link";
                    } ?>
                    <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="#"><i class="nav-icon fas fa-file-code"></i>
                            <p>Devs <i class="right fas fa-angle-left"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (Yii::$app->controller->id == 'gii') {
                                $li = "nav-item active";
                                $a = "nav-link active";
                            } else {
                                $li = "nav-item";
                                $a = "nav-link";
                            }
                            ?>
                            <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/gii']); ?>"><i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Gii </p>
                                </a></li>

                            <?php if (Yii::$app->controller->id == 'debug') {
                                $li = "nav-item active";
                                $a = "nav-link active";
                            } else {
                                $li = "nav-item";
                                $a = "nav-link";
                            }
                            ?>
                            <li class="<?= $li; ?>"><a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/debug']); ?>"><i class="nav-icon far fa-circle text-blue"></i>
                                    <p>Debug </p>
                                </a></li>
                        </ul>
                    </li>
                    <!------- FIN MENU DEVS ------->

                <?php

                }
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>