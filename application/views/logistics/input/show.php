<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Compras <small>Logística</small></h3>
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
        <li><span>Detalles</span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-body">
                <div class="invoice">
                    <div class="row invoice-logo">
                        <div class="col-xs-6 invoice-logo-space">
                            <img src="<?= site_url('resources/img/charisma-logo.png'); ?>" class="img-responsive" alt="Logo"> 
                        </div>
                        <div class="col-xs-6">
                            <p> Compra: <?= $input[0]->id; ?> /
                                <?= date('d M Y', strtotime($input[0]->date)); ?>
                                <span class="muted">Charisma Nissi Puno</span>
                            </p>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6 nvoice-payment">
                            <h3>Detalles de compra:</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <strong>Documento de Emisión de Venta:</strong>
                                    <?= $input[0]->ticket; ?> - <?= $input[0]->ticketnumber; ?> 
                                </li>
                                <li><strong>Estado :</strong> 
                                    <?php if($input[0]->status == 2): ?>
                                        <span class="label label-primary uppercase">
                                            Aceptado
                                        </span>
                                    <?php elseif ($input[0]->status == 1): ?>
                                        <span class="label label-warning uppercase">
                                            En espera
                                        </span>
                                    <?php else: ?>
                                        <span class="label label-danger uppercase">
                                            Cancelado
                                        </span>
                                    <?php endif; ?>
                                    <input type="hidden" id="status" value="<?= $input[0]->status; ?>">
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <h3>Acerca del Proveedor:</h3>
                            <ul class="list-unstyled">
                                <li><strong>Empresa:</strong> <?= $input[0]->companyname; ?> </li>
                                <li><strong>Contacto:</strong> <?= $input[0]->contactname; ?> </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Descripción </th>
                                        <th> Marca </th>
                                        <th> Cantidad </th>
                                        <th> Precio unitario </th>
                                        <th> Sub total</th>
                                        <th> Lote </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($detail as $d): ?>
                                    <tr>
                                        <td></td>
                                        <td> <?= $d->detail; ?> </td>
                                        <td> <?= $d->brand; ?></td>
                                        <td> <?= $d->quantity; ?> </td>
                                        <td> S/ <?= $d->unitprice; ?> </td>
                                        <td> S/ <?= ($d->quantity * $d->unitprice) ?> </td>
                                        <td> <?= $d->lot; ?> </td>
                                        <td><button 
		                                    class="btn dark btn-outline"
		                                    onclick="route('logistics/input/viewdetail/<?= $d->productid; ?>');">
											<i class="fa fa-eye"></i>
											</button>
										</td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="well">
                                <address>
                                    <strong>Loop, Inc.</strong>
                                    <br> 795 Park Ave, Suite 120
                                    <br> San Francisco, CA 94107
                                </address>
                            </div>
                        </div>
                        <div class="col-xs-8 invoice-block">
                            <ul class="list-unstyled amounts">
                                <li><strong>Total:</strong> S/ <?= $input[0]->total; ?> </li>
                            </ul>
                            <br>
                            <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Imprimir
                                    <i class="fa fa-print"></i>
                            </a>
                        </div>
                        <div class="form-actions right" id="validate">
                            <button type="button" class="btn default" id="icancel" onclick="cancelshop('<?= $input[0]->id; ?>');">
                                <i class="fa fa-times-circle-o"></i>Cancelar Compra
                            </button>
                            <button type="button" class="btn green" id="iapprove" onclick="approveshop('<?= $input[0]->id; ?>');">
                                <i class="fa fa-save"></i> Aprobar Compra
                            </button>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    
    $("#validate").hide();

    evaluate();
});

function evaluate(){
    status   = $("#status").val();
    //alert('status: '+status);
    if(status == 1){
        $("#validate").show();
    }
    else {
        $("#validate").hide();
    }
}

function approveshop(id){
    swal({
        title: '¿Aprobará la compra Nº '+id+'?',
        text: "No se podrán revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allwoOutsideClick: false,
        confirmButtonText: 'Sí, Aprobar',
        cancelButtonText: 'No, Regresar'
    }).then(function(){
        $.post("<?= site_url(); ?>"+'logistics/input/approve/'+id, function(data){
            redirect('logistics/input');

            if(data == id){
                swal({
                    title: 'Se aprobó la compra.',
                    type: 'success',
                    html: 'La compra Nº '+data+' ahora está en stock.',
                    timer: 5000
                }).catch(swal.noop)
            }
            else{
                swal({
                    title: '¡Error!',
                    type: 'error',
                    html: data
                }).catch(swal.noop)
            }
        })
    })
}

function cancelshop(id){
    swal({
        title: '¿Cancelará la compra Nº '+id+'?',
        text: "No se podrán revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allwoOutsideClick: false,
        confirmButtonText: 'Sí, Cancelar',
        cancelButtonText: 'No, Regresar'
    }).then(function(){
        $.post("<?= site_url(); ?>"+'logistics/input/cancel/'+id, function(data){
            redirect('logistics/input');

            if(data == 1){
                swal({
                    title: 'Se canceló la compra.',
                    type: 'warning',
                    html: 'La compra Nº '+data+' se ha cancelado.',
                    timer: 5000
                }).catch(swal.noop)
            }
            else{
                swal({
                    title: '¡Error!',
                    type: 'error',
                    html: data
                }).catch(swal.noop)
            }
        })
    }, function(dismiss) {
        if(dismiss === 'cancel'){
            swal({
                title: 'Atención',
                text: 'No se realizó ningun cambio',
                type: 'info',
                timer: 3000
            }).catch(swal.noop)
        }
    })

}

</script>