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
                                	id="new-product" 
                                	class="btn green btn-outline"
                                	onclick="route('logistics/product/create');"
                                > 
                                     <i class="fa fa-plus"></i> Nuevo 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
				<table class="table table-bordered table-hover" id="productDataTable">
					<thead>
						<tr>
							<th>Nº</th>
							<th>Categoría</th>
							<th>Descripcion</th>
							<th>Marca</th>
							<th>Codigo de Barras</th>
							<th>Ver</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
					<?php if (!empty($product)): ?>
					<?php foreach ($product as $p):?>
						<tr>
							<td><?= $p->id; ?></td>
							<td><?= $p->category; ?></td>
							<td><?= $p->detail; ?></td>
							<td><?= $p->brand; ?></td>					
							<td><?= $p->barcode; ?></td>
							<td>
								<button 
                                    onclick="route('logistics/product/show/<?= $p->id; ?>');" 
                                    class="btn dark btn-outline">
                                    <i class="fa fa-info-circle"></i>
                                </button>
                            </td>
                            <td>
								<button 
									onclick="route('logistics/product/edit/<?= $p->id; ?>');"
									class="btn yellow btn-outline">
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td>
								<button
									onclick="destroy('<?= $p->id; ?>');" 
									class="btn red btn-outline">
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
<script src="<?= site_url('resources/js/logistics/product.js'); ?>"></script>
<script>
function destroy(id){
	swal({
	  	title: '¿Eliminar el producto #'+id+'?',
	  	text: "Recuerde que no podrá revertir los cambios",
	  	type: 'question',
	  	showCancelButton: true,
	  	showLoaderOnConfirm: true,
	  	allowOutsideClick: false,
	  	confirmButtonText: 'Eliminar',
	  	cancelButtonText: 'Cancelar'

	}).then(function () {

		$.post("<?= site_url(); ?>"+'logistics/product/destroy/'+id, function(data){

			redirect('logistics/product');

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