<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Categorías <small>Logística</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/category');">Categorías</a>
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
                                            id="newCategory" 
                                            class="btn green btn-outline"
                                            onclick="create();"> 
                                        	<i class="fa fa-plus"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="portlet-body">
				<table class="table table-bordered table-hover" id="categoryDataTable">
					<thead>
						<tr>
						    <th>No</th>
                            <th>Categoría</th>
                            <th>Opciones</th>
						</tr>
					</thead>
					<tbody>
                <?php if(!empty($category)): ?>  
					<?php foreach ($category as $a):?>
						<tr>
							<td><?= $a->id; ?></td>
							<td><?= $a->name; ?></td>
							<td>
								<button 
                                    class="btn yellow btn-outline"
                                    onclick="edit('<?= $a->id; ?>');">
											<i class="fa fa-edit"></i>
								</button>
								<button 
                                    class="btn red btn-outline"
                                    onclick="destroy('<?= $a->id; ?>');">
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
<script src="<?= site_url('resources/js/logistics/category.js'); ?>"></script>
<script>
function create(){
    swal({
        title: 'Nueva categoría usuaria',
        input: 'text',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Agregar',
        cancelButtonText: 'Cancelar',
        inputAttributes: {
            'maxlength': 50
        },
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value) {
                    var newCategory = {name:value.toUpperCase().trim()};
                    $.post("<?php echo site_url("logistics/category/store"); ?>",newCategory,function(data){

                        redirect('logistics/category');

                        if (data == 1) {
                            swal({
                              title: '¡Éxito!',
                              type: 'success',
                              html: 'Se ha agregado '+data+ ' nueva categoría',
                              timer: 3000
                            }).catch(swal.noop)
                        }
                        else{
                            swal({
                                title: '¡Error!',
                                type: 'error',
                                text: 'No se agregó ningun registro, intente de nuevo'
                            }).catch(swal.noop)
                        } 
                    });
                    resolve()
                } else {
                    reject('¡No se ha escrito nada!')
                }
            })
        }
    }).catch(swal.noop)
}

function edit(id){

    $.post("<?= site_url(); ?>"+'logistics/category/edit/'+id, function(data){

        if (data === 'false') {
            swal({
                title: '¡Error!',
                type: 'error',
                html: 'Necesitas ayuda?'
            }).catch(swal.noop)

            return;
        }
        else{
            data = eval(data);
            swal({
                title: 'Editar categoría #'+id,
                input: 'text',
                showCancelButton: true,
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                inputAttributes: {
                    'maxlength': 50
                },
                inputValue: data[0].name,
                inputValidator: function (value) {
                    return new Promise(function (resolve, reject) {

                        if (value) {

                            var newCategory = {name:value.toUpperCase().trim()};

                            $.post("<?= site_url(); ?>"+'logistics/category/update/'+id,newCategory,function(answ){

                                redirect('logistics/category');

                                if (answ == 1) {
                                    swal({
                                      title: '¡Éxito!',
                                      type: 'success',
                                      html: 'Se ha editado '+answ+ ' registro',
                                      timer: 3000
                                    }).catch(swal.noop)
                                }
                                else{
                                    swal({
                                        title: '¡Error!',
                                        type: 'error',
                                        html: 'Se ha editado '+answ+ ' registros'
                                    }).catch(swal.noop)
                                }
                            });
                            resolve()
                        } else {
                            reject('¡Datos vacíos!')
                        }
                    })
                }
            }).catch(swal.noop)
        }
    });
}

function destroy(id){
    swal({
        title: '¿Eliminar categoría #'+id+'?',
        text: "Recuerde que no podrá revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/category/destroy/'+id, function(data){

            redirect('logistics/category');

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
                timer: 2500
            }).catch(swal.noop)
        }
    })
}
</script>