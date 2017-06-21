<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Proveedores <small>Almacén general</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/supplier');">Proveedores</a>
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
                                    id="new-supplier" 
                                    class="btn green btn-outline"
                                    onclick="route('logistics/supplier/create');"
                                > 
                                     <i class="fa fa-plus"></i> Nuevo 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-hover" id="supplierDataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Empresa</th>
                            <th>Contacto</th>
                            <th>Documento</th>
                            <th>Número</th>
                            <th>Detalles</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($supplier)): ?>
                        <?php foreach ($supplier as $s):?>
                            <tr>
                                <td><?= $s->supplierid; ?></td>
                                <td><?= $s->companyname; ?></td>
                                <td><?= $s->contactname; ?></td>
                                <td><?= $s->abbreviation; ?></td>
                                <td><?= $s->idn_number; ?></td>
                                <td style="text-align: center;">
                                    <button 
                                        onclick="show('<?= $s->supplierid; ?>');" 
                                        class="btn dark btn-outline">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;">
                                    <button 
                                        onclick="edit('<?= $s->supplierid; ?>');"
                                        class="btn yellow btn-outline">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                                <td style="text-align: center;">
                                    <button
                                        onclick="destroy('<?= $s->supplierid; ?>');" 
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
<script src="<?= site_url('resources/js/logistics/supplier.js'); ?>"></script>
<script>
function show(id) {

    $.post("<?= site_url(); ?>"+'logistics/supplier/show/'+id, function(data){

        if (data == '') {
            swal({
                title: '¡Error!',
                type: 'error',
                html: 'What the hell r u trying to do?'
            }).catch(swal.noop)

            redirect('logistics/supplier');
        } else {
            loading('open');
            $('#main').html(data);
            loading('close');
        }
    });
}

function edit(id) {

    $.post("<?= site_url(); ?>"+'logistics/supplier/edit/'+id, function(data){

        if (data == '') {
            swal({
                title: '¡Error!',
                type: 'error',
                html: 'What the hell r u trying to do?'
            }).catch(swal.noop)

            redirect('logistics/supplier');
        } else {
            loading('open');
            $('#main').html(data);
            loading('close');
        }
    });
}

function destroy(id){
    swal({
        title: '¿Eliminar el proveedor #'+id+'?',
        text: "Recuerde que no podrá revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/supplier/destroy/'+id, function(data){

            redirect('logistics/supplier');

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