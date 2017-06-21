<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">Pedidos <small>Logística</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/orders');">Compras</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Lista</span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <button 
                                        id="new-input" 
                                        class="btn green btn-outline"
                                        onclick="route('logistics/orders/create');"> 
                                    <i class="fa fa-plus"></i> Registrar 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-hover" id="inputDataTable">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Almacén</th>
                            <th>Fecha</th>
                            <th>Fecha de Entrega</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $o):?>
                            <tr>
                                <td><?= $o->id; ?></td>
                                <td><?= $o->location; ?></td>
                                <td><?= $o->date; ?></td>
                                <td><?= $o->shippingdate; ?></td>
                                <td>
                                <?php if($o->status == 'request'): ?>
                                    <span class="btn btn-info">
                                        <i class="fa fa-cart-arrow-down"></i>
                                    </span>
                                <?php elseif ($o->status == 'shipped'): ?>
                                    <span class="btn btn-warning">
                                        <i class="fa fa-truck"></i>
                                    </span>
                                <?php elseif ($o->status == 'arrived'): ?>
                                    <span class="btn btn-success">
                                        <i class="fa fa-gift"></i>
                                    </span>
                                <?php elseif ($o->status == 'stored'): ?>
                                    <span class="btn btn-primary">
                                        <i class="fa fa-archive"></i>
                                    </span>
                                <?php else : ?>
                                    <span class="btn btn-danger">
                                        <i class="fa fa-ban"></i>
                                    </span>
                                </td>
                                <td>
                                    <button 
                                        onclick="route('logistics/input/show/<?= $o->id; ?>');" 
                                        class="btn dark btn-outline">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>    