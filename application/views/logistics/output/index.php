<template id="output_index">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <router-link to="/create">
                                        <button id="new-input" class="btn green btn-outline"> <i class="fa fa-plus"></i> Registrar </button>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-bordered table-hover" id="inputDataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TICKET</th>
                                <th>ORIGEN</th>
                                <th>DESTINO</th>
                                <th>FECHA</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in lista">
                                <td>{{item.id}} </td>
                                <td>{{item.ticketName}} </td>
                                <td>{{item.storageNameOut}} </td>
                                <td>{{item.storageNameIn}} </td>
                                <td>{{item.added_at}} </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>
</template>
<template id="output_create">
    
    <div class="row">
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <pre>{{$data}} </pre>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="portlet light">
                <div class="portlet-body form">
                    <form id="formInput" accept-charset="utf-8" class="horizontal-form">
                        <div class="form-body">
                            <h3 class="form-section">Cabecera</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Comprobante</label>
                                        <select class="form-control" v-model="output.ticketId">
                                        <?php foreach($tickets as $item): ?>
                                            <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Origen</label>
                                        <select class="form-control" v-model="output.storageIdOut">
                                        <?php foreach($locations as $item): ?>
                                            <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Destino</label>
                                        <select class="form-control" v-model="output.storageIdIn">
                                        <?php foreach($locations as $item): ?>
                                            <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Fecha</label>
                                        <input type="date" v-model="output.date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <template>
                                <h3 class="form-section">Detalles de Salida</h3>
                                <div class="row">
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        
                                        <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Agregar Detalle</a>
                                        <div class="modal fade" id="modal-id">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">Agregar Nuevo Detalle</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Producto</label>
                                                            <select v-model="outputNew.product" class="form-control">
                                                            <?php foreach($products as $item): ?>
                                                                <option value='{"id": "<?= $item->id; ?>", "detail": "<?= $item->detail; ?>"}'><?= $item->detail; ?></option>
                                                            <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Precio Unitario</label>
                                                            <input type="number" class="form-control" v-model="outputNew.unitPrice">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Cantidad</label>
                                                            <input type="number" class="form-control" v-model="outputNew.quantity">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <button @click="agregarOutput" class="btn btn-primary">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <table class="table table-condensed table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio Unitario</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(od, index) in outputdetail">
                                                    <td>{{index+1}} </td>
                                                    <td>{{od.product.detail}} </td>
                                                    <td class="text-right">{{od.quantity}} </td>
                                                    <td class="text-right">{{od.unitPrice}} </td>
                                                    <td class="text-right">{{od.quantity * od.unitPrice}} </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-right" colspan="4">Total</th>
                                                    <th class="text-right">{{getOutputTotal}} </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <table class="table table-bordered table-hover">
                                            
                                        </table>
                                        
                                     </div>
                                </div>
                            </template>
                        </div>
                    </form>            
                </div>
            </div>
        </div>
    </div>
</template>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" id="main">
        <h3 class="page-title"> SALIDAS - REGISTROS <small>Logística</small></h3>
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
                <li><span>Registrar </span></li>
            </ul>
        </div>
        <p>
            <!-- use router-link component for navigation. -->
            <!-- specify the link by passing the `to` prop. -->
            <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
            <router-link to="/">/</router-link>
            <router-link to="/create">create</router-link>
            <router-link to="/bar">Go to Bar</router-link>
        </p>
        <!-- route outlet -->
        <!-- component matched by the route will render here -->
        <router-view></router-view>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
