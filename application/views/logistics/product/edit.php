<?php 
    foreach ($category as $key => $value) {
        $cak[] = $value->id;
        $cav[] = $value->name;
    }

    foreach ($brand as $key => $value) {
        $brk[] = $value->id;
        $brv[] = $value->name;
    }

    foreach ($pack as $key => $value) {
        $pak[] = $value->id;
        $pav[] = $value->name." de ".$value->factor." ".$value->parent."s.";
    }

    $categories = array_combine($cak, $cav);
    $brands = array_combine($brk, $brv);
    $packs = array_combine($pak, $pav);

    $inputDetail = array(

        'type'      => 'text',
        'name'      => 'detail',
        'class'     => 'form-control',
        'required'  => 'true',
        'disabled'  => 'disabled',
        'value'     => $product[0]->detail
        );

    $inputBarcode = array(

        'type'      => 'text',
        'name'      => 'barcode',
        'class'     => 'form-control',
        'required'  => 'true',
        'disabled'  => 'disabled',
        'value'     => $product[0]->barcode
        );

    $inputMinstock = array(

        'type'      => 'number',
        'name'      => 'minimum',
        'class'     => 'form-control',
        'required'  => 'true',
        'min'       => '0',
        'step'      => '1',
        'disabled'  => 'disabled',
        'value'     => $product[0]->minstock
        );

    $status = array(
        'good'   => 'BUENO',
        'average' => 'REGULAR',
        'bad'    => 'MALO'
    );

    $tcate = 'Categoría <a href="javascript:;" id="category"><i class="fa fa-pencil"></i></a>';
    $tbran = 'Marca <a href="javascript:;" id="brand"><i class="fa fa-pencil"></i></a>';
    $tpack = 'Presentación <a href="javascript:;" id="pack"><i class="fa fa-pencil"></i></a>';
    $tdeta = 'Detalle <a href="javascript:;" id="detail"><i class="fa fa-pencil"></i></a>';
    $tbarc = 'Código de Barras <a href="javascript:;" id="barcode"><i class="fa fa-pencil"></i></a>';
    $tmini = 'Stock Mínimo <a href="javascript:;" id="minstock"><i class="fa fa-pencil"></i></a>';
    $tstat = 'Estado <a href="javascript:;" id="status"><i class="fa fa-pencil"></i></a>';

 ?>

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
        <li><span>Editar </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">Producto #<?= $product[0]->id; ?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="formP" accept-charset="utf-8" class="horizontal-form" enctype="multipart/form-data">
                    <div class="form-body">
                        <h3 class="form-section">Información requerida</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($tcate, 'category'); ?>
                                        <?= form_dropdown(
                                            'category', 
                                            $categories, 
                                            $product[0]->categoryid,
                                            'class="select2_single form-control" disabled="disabled" required'
                                            ); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($tbran, 'brand'); ?>
                                        <?= form_dropdown(
                                            'brand', 
                                            $brands, 
                                            $product[0]->brandid,
                                            'class="select2_single form-control" disabled="disabled" required'
                                            ); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($tdeta, 'detail'); ?>
                                        <?= form_input($inputDetail); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($tmini,'minstock'); ?>
                                        <?= form_input($inputMinstock);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($tpack, 'pack'); ?>
                                        <?= form_dropdown(
                                            'pack', 
                                            $packs, 
                                            $product[0]->packingid,
                                            'class="select2_single form-control" disabled="disabled" required'
                                            ); ?>
                                    </div>
                                </div>
                            </div>
                        <h3 class="form-section">Información adicional</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($tbarc, 'barcode'); ?>
                                        <?= form_input($inputBarcode); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($tstat, 'status'); ?>
                                        <?= form_dropdown(
                                            'status', 
                                            $status, 
                                            $product[0]->status,
                                            'class="select2_single form-control" disabled="disabled" required'
                                            );
                                        ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="form-actions right">
                        <button type="reset" class="btn default">
                            <i class="fa fa-times-circle-o"></i> Cancelar
                        </button>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-save"></i> Guardar
                        </button>
                    </div>
                <?=  form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/product.js'); ?>"></script>
<script>
$(document).ready(function(){

    var msg = 'Editar / Cancelar';

    //Since here this work for the tooltips. First it checks sends a message that indicates the purpose.
    //Then it changes the attribute of the input from dissabled to enabled to be editted.
    //They are programmed in order of appearance.
    $('#category').tooltip({title: msg});
    $('#category').click(function() {
        $("select[name='category']").each(function() {
            if ($(this).attr('disabled')){
                $(this).removeAttr('disabled');
                document.getElementById('category').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('category').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });
    $('#brand').tooltip({title: msg});
    $('#brand').click(function() {
        $("select[name='brand']").each(function() {
            if ($(this).attr('disabled')){
                $(this).removeAttr('disabled');
                document.getElementById('brand').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('brand').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });
    $('#detail').tooltip({title: msg});
    $('#detail').click(function() {
        $("input[name='detail']").each(function() {
            if ($(this).attr('disabled')){
                $(this).removeAttr('disabled');
                document.getElementById('detail').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('detail').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });
    $('#minstock').tooltip({title: msg});
    $('#minstock').click(function() {
        $("input[name='minimum']").each(function() {
            if ($(this).attr('disabled')){
                $(this).removeAttr('disabled');
                document.getElementById('minstock').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('minstock').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });
    $('#pack').tooltip({title: msg});
    $('#pack').click(function() {
        $("select[name='pack']").each(function() {
            if ($(this).attr('disabled')){
                $(this).removeAttr('disabled');
                document.getElementById('pack').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('pack').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });
    $('#barcode').tooltip({title: msg});
    $('#barcode').click(function() {
        $("input[name='barcode']").each(function() {
            if ($(this).attr('disabled')){
                $(this).removeAttr('disabled');
                document.getElementById('barcode').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('barcode').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });
    $('#status').tooltip({title: msg});
    $('#status').click(function() {
        $("select[name='status']").each(function() {
            if ($(this).attr('disabled')){
                $(this).removeAttr('disabled');
                document.getElementById('status').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'distatussabled'});
                document.getElementById('status').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });
    //This creates a format from the document in order to send the details to the controller to be input
    //in the data base.
    $("#formP").submit(function(e){
        format('#formP');
        e.preventDefault();
        var formData = new FormData($("#formP")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/product/update/".$product[0]->id); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                if ($.isNumeric(data)) {
                    swal({
                      title: '¡Información!',
                      type: 'info',
                      html: 'Producto #'+data+ ' actualizado correctamente',
                      timer: 5000
                    }).catch(swal.noop)

                    redirect('logistics/product/show/'+data);
                }
                else{
                    redirect('logistics/product/edit/<?= $product[0]->id; ?>');
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
</script>