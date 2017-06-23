<?php
    foreach ($supplier as $key => $value) {
        $suk[] = $value->supplierid;
        $suv[] = $value->companyname;
    }

    foreach ($ticket as $key => $value) {
        $tik[] = $value->ticketid;
        $tiv[] = $value->name;
    }

    foreach ($product as $key => $value) {
        $prk[] = $value->productid;
        $prv[] = $value->detail;
    }

    $suppliers = array_combine($suk, $suv);
    $tickets = array_combine($tik, $tiv);
    $products = array_combine($prk, $prv);

    $inputnumber = array(
        'type'      => 'number',
        'name'      => 'ticketnumber',
        'class'     => 'form-control',
        'required'  => 'true',
        'min'       => '0',
        'step'      => '1'
        );

    $inputregdate = array(
        'type'      => 'date',
        'name'      => 'regdate',
        'class'     => 'form-control',
        'required'  => 'true'
        );

    $inputquantity = array(
        'type'      => 'number',
        'name'      => 'iquantity',
        'class'     => 'form-control',
        'min'       => '0',
        'step'      => '1',
        'id'        => 'iquantity'
        );

    $inputunitprice = array(
        'type'      => 'number',
        'name'      => 'iunitprice',
        'class'     => 'form-control',
        'min'       => '0',
        'step'      => '0.01',
        'id'        => 'iunitprice'
        );

    $inputlote = array(
        'type'      => 'text',
        'name'      => 'inslot',
        'class'     => 'form-control',
        'id'        => 'inslot'
        );

    $inputexpire = array(
        'type'      => 'date',
        'name'      => 'expiredate',
        'class'     => 'form-control',
        'id'        => 'expiredate',
        );
?>

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Detalle de Compras <small>Logística</small></h3>
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
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-body form">
                <form id="formInput" accept-charset="utf-8" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Cabecera</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Proveedor', 'supplier'); ?>
                                        <?= form_dropdown(
                                            'supplier', 
                                            $suppliers, 
                                            '', 
                                            'class=" select-2-single form-control" required'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?= form_label('Comprobante','ticket'); ?>
                                        <?= form_dropdown(
                                            'ticket', 
                                            $tickets, '',
                                            'class="select-2-single form-control" required'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?= form_label('Número *','ticketnumber'); ?>
                                        <?= form_input($inputnumber);?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?= form_label('Fecha *','regdate'); ?>
                                        <?= form_input($inputregdate);?>
                                    </div>
                                </div>
                            </div>
                        <h3 class="form-section">Productos</h3>    
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Producto *', 'product'); ?>
                                        <?= form_dropdown(
                                            'product', 
                                            $products, 
                                            '', 
                                            'class="select-2-single form-control" id="askitem"'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Cantidad *', 'quantity'); ?>
                                        <?= form_input($inputquantity);?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Precio Unitario *', 'price'); ?>
                                        <?= form_input($inputunitprice);?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Fecha de Expiración', 'expiredate'); ?>
                                        <?= form_input($inputexpire);?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Lote', 'lote');?>
                                        <?= form_input($inputlote); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <button  type="button" id="btn_add" class="btn btn-primary btn-block">
                                        Agregar producto
                                    </button>
                                </div>
                            </div>
                        <h3 class="form-section">Detalles</h3>    
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-scrollable">
                                    <table id="details" class="table table-bordered table-hover">
                                        <thead>
                                            <th>Quitar</th>
                                            <th>Producto</th>
                                            <th>Lote</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Sub Total</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>TOTAL</th>
                                            <th><h4 id="total">S/ 0.00</h4></th>  
                                        </tfoot>
                                        
                                    </table>
                                 </div>
                            </div>
                    </div>
                    <div class="form-actions right" id="savetab">
                        <button type="reset" class="btn default">
                            <i class="fa fa-times-circle-o"></i> Cancelar
                        </button>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-save"></i> Registrar
                        </button>
                    </div>
                <?=  form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/input.js'); ?>"></script>
<script>
$(document).ready(function(){

    $("#formInput").submit(function(e){
        format('#formInput');
        e.preventDefault();
        var formData = new FormData($("#formInput")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/input/store"); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                redirect('logistics/input');

                if ($.isNumeric(data)) {
                    swal({
                      title: '¡Éxito!',
                      type: 'success',
                      html: 'Compra Nº'+data+' registrado',
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
</script>