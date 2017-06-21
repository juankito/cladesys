<?php
	$types = array(
		'A' => 'Administrador',
		'B'	=> 'Tipo 2',
		'C' => 'Almacenero',
		'D' => 'Observador'
		);

	$inputName = array(
			'type'		=> 'text',
			'name'		=> 'username',
			'class'		=> 'form-control',
			'required'	=> 'true',
			'disabled'	=> 'disabled',
			'value'		=> $user[0]->name
		);

	$inputPass = array(
			'type'		=> 'password',
			'name'		=> 'password',
			'class'		=> 'form-control',
			'required'	=> 'true',
			'disabled'	=> 'disabled',
			'value'		=> $user[0]->password
		);

	$inputEmail = array(
			'type'		=> 'text',
			'name'		=> 'email',
			'class'		=> 'form-control',
			'required'	=> 'true',
			'disabled'	=> 'disabled',
			'value'		=> $user[0]->email
		);

	$pname = 'Nombre <a href="javascript;" id="ename"><i class="fa fa-pencil"></i></a>';
	$ppass = 'Password <a href="javascript;" id="epass"><i class="fa fa-pencil"></i></a>';
	$pmail = 'Email <a href="javascript;" id="email"><i class="fa fa-pencil"></i></a>';
	$ptype = 'Tipo de Usuario <a href="javascript;" id="etype"><i class="fa fa-pencil"></i></a>';
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
        <li><span>Editar </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">Usuario <?= $user[0]->name; ?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="formU" accept-charset="utf-8" class="horizontal-form" enctype="multipart/form-data">
                    <div class="form-body">
                        <h3 class="form-section">Información requerida</h3>
                        <div class="row">
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <?= form_label($pname,'uname'); ?>
                                    <?= form_input($inputName);?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= form_label($ppass,'uname'); ?>
                                    <?= form_input($inputPass);?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= form_label($ptype,'utype'); ?>
                                    <?= form_dropdown(
                                        'utype', 
                                        $types, 
                                        $user[0]->type,
                                        'class="select2_single form-control" disabled="disabled" required'
                                        ); 
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= form_label($pmail,'umail'); ?>
                                    <?= form_input($inputEmail);?>
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
		                </div>
		            </div>
		        <?= form_close(); ?>
		        </form>
		    </div>
		</div>
	</div>
</div>
