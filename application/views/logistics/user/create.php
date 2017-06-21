<?php 
    foreach ($location as $key => $value) {
        $lok[] = $value->id;
        $lov[] = $value->name;
    }

    $locations = array_combine($lok, $lov);

    $inputName = array(
        'type'      => 'text',
        'name'      => 'user',
        'class'     => 'form-control',
        'required'  => 'true'
        );
    $inputPassword1 = array(
        'type'      => 'password',
        'name'      => 'password',
        'class'     => 'form-control',
        'required'  => 'true',
        'minlength' => '8',
        'maxlength' => '32'
        );
    $inputPassword2 = array(
        'type'      => 'password',
        'name'      => 'password2',
        'class'     => 'form-control',
        'required'  => 'true',
        'minlength' => '8',
        'maxlength' => '32'
        );
    $inputEmail = array(
        'type'      => 'text',
        'name'      => 'email',
        'class'     => 'form-control',
        'required'  => 'true'
        );
?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Usuarios <small>Logística</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;" onclick="route('logistics/user');">Usuarios</a>
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
                <form id="formU" accept-charset="utf-8" class="horizontal-form" enctype="multipart/form-data">
                    <div class="form-body">
                        <h3 class="form-section">Información requerida</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= form_label('Nombre', 'user'); ?>
                                    <?= form_input($inputName); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Tipo de Usuario</label>
                                <select id="userType" class="form-control">
                                    <option value="A">Administrador</option>
                                    <option value="B">Tipo 2</option>
                                    <option value="C">Almacenero</option>
                                    <option value="D">Solo Vista</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <?= form_label('Password', 'password1'); ?>
                                <?= form_input($inputPassword1); ?>
                            </div>
                            <div class="form-group">
                                <?= form_label('Confirme su Password', 'password2'); ?>
                                <?= form_input($inputPassword2); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <?= form_label('Email', 'email'); ?>
                                <?= form_input($inputEmail); ?>
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
                    </div>
                <?=  form_close(); ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/user.js'); ?>"></script>
<script>
$(document).ready(function(){
    $("#formP").submit(function(e){
        format('#formU');
        e.preventDefault();
        var formData = new FormData($("#formU")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/user/store"); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                redirect('logistics/user/create');

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
</script>