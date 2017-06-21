<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Productos <small>Almacén general</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/product');">Productos</a>
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
                    <span class="caption-subject bold uppercase">Producto Nº <?= $product[0]->id; ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>Categoría</th>
                                    <td><?= $product[0]->category; ?></td>
                                </tr>
                                <tr>
                                    <th>Descripción</th>
                                    <td><?= $product[0]->detail; ?></td>
                                </tr>
                                <tr>
                                    <th>Marca</th>
                                    <td><?= $product[0]->brand; ?></td>
                                </tr>
                                <tr>
                                    <th>Stock Mínimo</th>
                                    <td><?= $product[0]->minstock; ?></td>
                                </tr>
                                <tr>
                                    <th>Código de Barras</th>
                                    <td><?= $product[0]->barcode; ?></td>
                                </tr>
                                <tr>
                                    <th>Precio Unitario</th>
                                    <td><?= $stock[0]->unitprice; ?></td>
                                </tr>
                                <tr>
                                    <th>Estatus</th>
                                    <td><?= $product[0]->status; ?></td>
                                </tr>
                                <tr>
                                    <th>Última Modificación</th>
                                    <td><?= $product[0]->updated; ?></td>
                                </tr>
                                <tr>
                                    <th>Presentación</th>
                                    <td>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Paquete</th>
                                                    <th>Contiene</th>
                                                    <th>De: </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php if(!empty($pack)): ?>                           
                                            <?php foreach ($pack as $pa):?>
                                                <tr>
                                                    <td><?= $pa->id; ?></td>
                                                    <td><?= $pa->name; ?></td>
                                                    <td><?= $pa->factor; ?></td>
                                                    <td><?= $pa->parent; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <h3 class="form-section">Detalles de Stock del Producto</h3>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet-body">
                            <table class="table table-bordered table-hover" id="productDataTable">
                                <thead>
                                    <tr>
                                        <th>Almacén</th>
                                        <th>Lote</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Precio Total</th>
                                        <th>Fecha de Producción</th>
                                        <th>Fecha de Caducidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($stock)): ?>
                                <?php foreach ($stock as $s):?>
                                    <tr>
                                        <td><?= $s->name; ?></td>
                                        <td><?= $s->lot; ?></td>
                                        <td><?= $s->quantity; ?></td>
                                        <td>S/. <?= $s->unitprice; ?></td>
                                        <td>S/. <?= $s->unitprice*$s->quantity; ?></td>
                                        <td><?= explode(" ", $s->fabdate)[0]; ?></td>
                                        <td><?= $s->expiredate; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <button class="btn dark btn-outline pull-right hidden-print" onclick="window.print();">
                            <i class="fa fa-print"></i> Imprimir
                        </button>
                        <button 
                            onclick="route('logistics/product/edit/<?= $product[0]->id; ?>');"
                            class="btn green btn-outline pull-right hidden-print">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/product.js'); ?>"></script>