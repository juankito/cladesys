<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Detalle de Compra <small>Logística</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/input');">Compras</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Detalles de Compra</span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">Producto Nº <?= $product[0]->productid; ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>Detalle</th>
                                    <td><?= $product[0]->detail; ?></td>
                                </tr>
                                <tr>
                                    <th>Marca</th>
                                    <td><?= $product[0]->brand; ?></td>
                                </tr>
                                <tr>
                                    <th>Cantidad de Ingreso</th>
                                    <td><?= $product[0]->quantity; ?></td>
                                </tr>
                                <tr>
                                    <th>Lote</th>
                                    <td><?= $product[0]->lot; ?></td>
                                </tr>
                                <tr>
                                    <th>Fecha de Fabricación</th>
                                    <td><?= $product[0]->fabdate ?></td>
                                </tr>
                                <tr>
                                    <th>Fecha de Expiración</th>
                                    <td><?= $product[0]->expiredate ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h3 class="form-section">Detalles del Producto en Stock</h3>
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Id Nº</th>
                                <th>Almacén</th>
                                <th>Cantidad</th>
                                <th>Fila-Nivel</th>
                                <th>Modificación</th>
                            </thead>
                            <tbody>
                            <?php if (!empty($stock)): ?>
                                <?php foreach ($stock as $s): ?>
                                <tr>
                                    <td><?= $s->stockid; ?></td>
                                    <td><?= $s->local; ?></td>
                                    <td><?= $s->stockq; ?></td>
                                    <td><?= $s->shelf; ?></td>
                                    <td><?= explode(" ", $s->updated_at)[0]; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
