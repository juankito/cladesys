<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Almacén <small>Logística</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/stock');">Almacenes</a>
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
                    <span class="caption-subject bold uppercase">Producto #<?= $p[0]->productID; ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                    <?php if(is_null($p[0]->imagePath)): ?>
                            <img 
                            src="<?= site_url('resources/img/logistics/product/default.png'); ?>" 
                            width="250" 
                            height="250" 
                            class="center-block"
                            >
                    <?php else: ?>
                        <img 
                            src="<?= site_url('resources/img/logistics/product/'.$p[0]->imagePath); ?>" 
                            width="250" 
                            height="250" 
                            class="center-block img-thumbnail"
                        >
                    <?php endif; ?>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>Descripción</th>
                                    <td><?= $p[0]->detail; ?></td>
                                </tr>
                                <tr>
                                    <th>Stock Mínimo</th>
                                    <td><?= $p[0]->minstock; ?></td>
                                </tr>
                                <tr>
                                    <th>Estante</th>
                                    <td><?= $p[0]->shelf; ?></td>
                                </tr>
                                <tr>
                                    <th>Ubicación</th>
                                    <td><?= $p[0]->location; ?></td>
                                </tr>
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
                            onclick="route('logistics/product/edit/<?= $p[0]->id; ?>');"
                            class="btn green btn-outline pull-right hidden-print">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
