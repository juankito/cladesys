<?php
	foreach ($packing as $key  => $value){
		$pak[] = $value->packingid;
		if ($value->factor == 1){
			$pav[] = $value->name;
		} else {
			$pav[] = $value->name." de ".$value->factor." ".$value->parent."S";
		}
	}

	foreach ($pack as $key => $value) {
		$pkk[] = $value->packsid;
		$pkv[] = $value->name;
	}

	$packings =  array_combine($pak, $pav);
	$packs = array_combine($pkk, $pkv);

	$inputFactor = array(
			'type'		=> 'number',
			'name'		=> 'factortimes',
			'class'		=> 'form-control',
			'required'	=> 'true',
			'min'		=> '0',
			'step'		=> '1',
		);

	$creater = 'Paquete <a href="javascript:;" id="creater" onclick="create();"><i class="fa fa-pencil"></i></a>';
?>

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Productos <small>Logística</small></h3>
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
        <li><span>Registrar </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-body form">
                <form id="formPack" accept-charset="utf-8" class="horizontal-form" enctype="multipart/form-data">
                    <div class="form-body">
                        <h3 class="form-section">Creando Nuevo Empaquetado</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?= form_label($creater,'packs'); ?>
                                        <?= form_dropdown('packs', $packs, '','class="select2_single form-control" required'); ?>
                                    </div>
                                </div>
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <?= form_label('Contiene','factorC'); ?>
	                                    <?= form_input($inputFactor);?>
	                                </div>
	                             </div>
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <?= form_label('A','packings'); ?>
	                                    <?= form_dropdown('packings', $packings, '','class="select2_single form-control" required'); ?>
	                                </div>
	                            </div>
                            </div>
                    </div>
                    <div class="form-actions right">
                        <button type="reset" class="btn default">
                            <i class="fa fa-times-circle-o"></i> Cancelar
                        </button>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-save"></i> Registrar
                        </button>
                    </div>
                <?= form_close(); ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/packing.js'); ?>"></script>
<script>
$(document).ready(function(){

    $("#formPack").submit(function(e){
        format('#formPack');
        e.preventDefault();
        var formData = new FormData($("#formPack")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/packing/store"); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                redirect('logistics/packing/create');

                if ($.isNumeric(data)) {
                    swal({
                      title: '¡Éxito!',
                      type: 'success',
                      html: 'Producto #'+data+ ' registrado',
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
            }
        });
    });
});
function create(){
    swal({
        title: 'Nueva Paquete',
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
                    var newPack = {name:value.toUpperCase().trim()};
                    $.post("<?php echo site_url("logistics/packing/storepack"); ?>",newPack,function(data){

                        redirect('logistics/packing');

                        if (data == 1) {
                            swal({
                              title: '¡Éxito!',
                              type: 'success',
                              html: 'Se ha agregado '+data+ ' nueva Paquete',
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
                    reject('¡No has escrito nada!')
                }
            })
        }
    }).catch(swal.noop)
}
</script>