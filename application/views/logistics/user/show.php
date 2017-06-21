<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Usuarios <small>Logística</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/user');">Usuarios</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Detalles</span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">Usuario #<?= $user[0]->user; ?></span>
                </div>
            </div>
            <div class="porlet-body">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>Usuario</th>
                                    <td><?= $user[0]->user; ?></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td><?= $user[0]->password; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $user[0]->email; ?></td>
                                </tr>
                                <tr>
                                    <th>Categoría</th>
                                <?php if($user[0]->type == 'A'): ?>
                                    <td>Administrador</td>
                                <?php elseif ($user[0]->type == 'B'): ?>
                                    <td>Tipo 2</td>
                                <?php elseif ($user[0]->type == 'C'): ?>
                                    <td>Almacenero</td>
                                <?php elseif ($user[0]->type == 'B'): ?>
                                    <td>Observador</td>
                                <?php endif; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h3 class="form-section">Almacenes a Cargo</h3>
                <div class="row">
                    <table class="table table-bordered table-hover" id="brandDataTable">
                        <thead>
                            <tr>
                                <th>Nº </th>
                                <th>Almacén</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php if(!empty($location)): ?>
                        <?php foreach($location as $l): ?>
                            <tr>
                                <td><?= $l->id; ?></td>
                                <td><?= $l->location; ?></td>
                                <td>
                                    <button
                                        class="btn black btn-outline">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <button class="btn dark btn-outline pull-right hidden-print" onclick="window.print();">
                        <i class="fa fa-print"></i> Imprimir
                    </button>
                    <button 
                        onclick="route('logistics/user/edit/<?= $user[0]->user; ?>');"
                        class="btn green btn-outline pull-right hidden-print">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>