<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Medidas <small>Almacén general</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/packing');">Medidas</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Lista </span></li>
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
                                    id="newPack" 
                                    class="btn green btn-outline"
                                    onclick="route('logistics/packing/create');"> 
                                	<i class="fa fa-plus"></i> Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        	<div class="portlet-body">
				<table class="table table-bordered table-hover" id="packDataTable">
					<thead>
						<tr>
							<th>Nº</th>
							<th>Paquete</th>
                            <th>Contiene</th>
                            <th>De: </th>
                            <th>Opciones</th>
						</tr>
					</thead>
                    <tbody>
                <?php if(!empty($packing)): ?>                           
					<?php foreach ($packing as $pack):?>
						<tr>
							<td><?= $pack->packingid; ?></td>
							<td><?= $pack->name; ?></td>
                            <td><?= $pack->factor; ?></td>
                            <td><?= $pack->parent; ?></td>
							<td>
								<button 
                                    class="btn yellow btn-outline" 
                                    onclick="route('logistics/packing/edit/<?= $pack->packingid; ?>');">
									<i class="fa fa-edit"></i>
								</button>
								<button 
                                    class="btn red btn-outline"
                                    onclick="destroy('<?= $pack->packingid; ?>');">
									<i class="fa fa-trash"></i>
								</button>
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

<script src="<?= site_url('resources/js/logistics/packing.js'); ?>"></script>
<!-- sometime later, probably inside your on load event callback -->
<script>
    function destroy(id){
        swal({
            title: '¿Eliminar el Pacquete Nº '+id+'?',
            text: "Recuerde que no podrá revertir los cambios",
            type: 'question',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'

        }).then(function () {
        $.post("<?= site_url(); ?>"+'logistics/packing/destroy/'+id, function(data){

            redirect('logistics/packing');

            if (data == 1) {
                swal({
                      title: '¡Atención!',
                      type: 'warning',
                      html: 'Se ha eliminado '+data+ ' registro',
                      timer: 5000
                }).catch(swal.noop)
            }
            else{
                swal({
                    title: '¡Error!',
                    type: 'error',
                    html: 'Se ha eliminado '+data+ ' registros'
                }).catch(swal.noop)
            }             
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal({
                title: 'Cancelado',
                text: 'No se realizó ningún cambio',
                type:'info',
                timer: 3000
            }).catch(swal.noop)
        }
    })
}
</script>