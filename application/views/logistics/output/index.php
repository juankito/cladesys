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
                    <div id="locationDataTable_wrapper" class="dataTables_wrapper no-footer">
                        <div class="row">
                            <!--This section is disabled for not compatible-->
                            <div class="col-md-12">
                                <div class="dt-buttons"><a class="dt-button buttons-print btn purple-plum" tabindex="0" aria-controls="locationDataTable"
                                        title="Imprimir"><span><i class="icon-printer"></i></span></a><a class="dt-button buttons-pdf buttons-html5 btn red-sunglo"
                                        tabindex="0" aria-controls="locationDataTable" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>
                                    <a class="dt-button buttons-excel buttons-html5 btn green-meadow" tabindex="0" aria-controls="locationDataTable" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a>
                                    <a class="dt-button buttons-collection buttons-colvis btn grey-cascade" tabindex="0" aria-controls="locationDataTable"><span><i class="fa fa-th-list"></i></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12"></div>
                            <div class="col-md-6 col-sm-12">
                                <div id="locationDataTable_filter" class="dataTables_filter"><label>Buscar <input class="form-control input-sm input-small input-inline" placeholder="" aria-controls="locationDataTable" type="search" v-model="searchOutput" @change="get()"></label></div>
                            </div>
                        </div>
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
                                <template  v-for="item in lista">
                                    <template v-if="item.status == 1">
                                        <tr>
                                            <td>{{item.id}} </td>
                                            <td>{{item.ticketName}} </td>
                                            <td>{{item.storageNameOut}} </td>
                                            <td>{{item.storageNameIn}} </td>
                                            <td>{{item.added_at}} </td>
                                            <td>
                                                <router-link :to="'/detail/' + item.id">
                                                    <button class="btn dark btn-outline">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </router-link>
                                                <a @click="deleteOutput(item.id)">
                                                    <button class="btn btn-warning" title="Eliminar">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="output_detail">
    <div>
        
        <div class="panel panel-default">
            <div class="panel-body">
               <div v-for="(item, key, index) in datos.cabecera">
                   <strong>{{key}}: </strong> {{item}}
               </div>
               <hr>
               <table class="table table-bordered table-hover">
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
                        <tr v-for="(od, index) in datos.detalles">
                            <td>{{index+1}} </td>
                            <td>{{od.detail}} </td>
                            <td class="text-right">{{od.quantity}} </td>
                            <td class="text-right">{{od.unitprice}} </td>
                            <td class="text-right">{{od.quantity * od.unitPrice}} </td>
                        </tr>
                        <tr>
                            <th class="text-right" colspan="4">Total</th>
                            <th class="text-right">{{getOutputTotal}} </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<template id="output_create">

    <div class="row">
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
                                        <input type="date" v-model="output.date" class="form-control" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <template>
                                <h3 class="form-section">Detalles de Salida</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <a class="btn btn-primary" data-toggle="modal" href='#modal-id'><i class="fa fa-plus"></i> Agregar Detalle</a>
                                        <hr>
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
                                                        <button @click="agregarOutput" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-hover" v-show="outputdetail.length != 0">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio Unitario</th>
                                                    <th>Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(od, index) in outputdetail">
                                                    <td>{{index+1}} </td>
                                                    <td>{{od.product.detail}} </td>
                                                    <td class="text-right">{{od.quantity}} </td>
                                                    <td class="text-right">{{od.unitPrice}} </td>
                                                    <td class="text-right">{{od.quantity * od.unitPrice}} </td>
                                                    <td>
                                                        <!--<button @click="outputNew = od" class="btn btn-warning" title="Editar" data-toggle="modal" href='#modal-id'>
                                                            <i class="fa fa-edit"></i> 
                                                        </button>-->
                                                        <button @click="outputdetail.splice(index, 1)" class="btn btn-danger" title="Eliminar">
                                                            <i class="fa fa-trash"></i> 
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-right" colspan="4">Total</th>
                                                    <th class="text-right">{{getOutputTotal}} </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-primary" @click="registrar()">
                                            <i class="fa fa-save"></i> Guardar Registro
                                        </button>
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
        <!--<p>
            <router-link to="/">/</router-link>
            <router-link to="/create">create</router-link>
            <router-link to="/bar">Go to Bar</router-link>
        </p>-->
        <router-view></router-view>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->