<?php
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<style>
    .bg-info {
        background-color: #111e60 !important;
    }

    .bg-danger {
        background-color: #a30101 !important;
    }

    .bg-success {
        background-color: #126a26 !important;
    }

    .bg-dark {
        background-color: #4f0868 !important;
    }
</style>
<div class="row">
<?php
    if (Yii::$app->user->can('UsuarioEstandarAccess') || Yii::$app->user->can('UsuarioSupervisorAccess') || Yii::$app->user->can('MasterAccess')) {
    ?>
    <div class="col-lg-6 col-md-12 col-sm-12">
        <a href="index.php?r=tbl-incidencias/index">
            <div class="small-box bg-success text-white p-2">
                <div class="inner">
                    <h3>Incidencias</h3>
                    <p>Administrar incidencias</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book text-white"></i>
                </div>
                <a href="index.php?r=tbl-incidencias/index" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </a>
    </div>
    <?php
    }
    ?>


    <?php
    if (Yii::$app->user->can('MasterAccess')) {
    ?>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="index.php?r=tbl-comisiones/index">
                <div class="small-box bg-info text-white p-2">
                    <div class="inner">
                        <h3>Instituciones de gobierno</h3>
                        <p>Administrar instituciones</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-gavel text-white"></i>
                    </div>
                    <a href="index.php?r=tbl-comisiones/index" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="index.php?r=tbl-tipo-incidencias/index">
                <div class="small-box bg-danger text-white p-2">
                    <div class="inner">
                        <h3>Tipos de incidencias</h3>
                        <p>Administrar tipos de incidencias</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fire text-white"></i>
                    </div>
                    <a href="index.php?r=tbl-tipo-incidencias/index" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="index.php?r=usuarios/index">
                <div class="small-box bg-dark text-white p-2">
                    <div class="inner">
                        <h3>Usuarios</h3>
                        <p>Administrar usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <a href="index.php?r=usuarios/index" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </a>
        </div>
    <?php
    }
    ?>
</div>