<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation"><a href="<?php echo site_url('admin/user/new');?>" aria-controls="nueva" role="tab">Nuevo</a></li>
    <li role="presentation"><a href="<?php echo site_url('admin/users');?>" aria-controls="users" role="tab">Usuarios</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">
        <?php echo form_open('admin/user/edit/'.$user->id, array('id' => 'myform')) ?>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Editar Usuario</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Datos de Facturación</h4>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group has-feedback">
                            <label for="billing_rut">RUT:</label>
                            <input type="text" name="billing_rut" id="billing_rut" class="form-control" value="<?php echo $user->billing_rut; ?>"><span class="error"><?php echo form_error('billing_rut'); ?></span>
                        </div>
                        <div class="col-md-8 form-group">
                            <label for="billing_business">Giro:</label>
                            <input type="text" name="billing_business" id="billing_business" class="form-control" value="<?php echo $user->billing_business; ?>"><span class="error"><?php echo form_error('billing_business'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="billing_name">Razón Social:</label>
                            <input type="text" name="billing_name" id="billing_name" class="form-control" value="<?php echo $user->billing_name; ?>"><span class="error"><?php echo form_error('billing_name'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="billing_email">Email:</label>
                            <input type="email" name="billing_email" id="billing_email" class="form-control" value="<?php echo $user->billing_email; ?>"><span class="error"><?php echo form_error('billing_email'); ?></span>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="billing_phone">Teléfono:</label>
                            <input type="text" name="billing_phone" id="billing_phone" class="form-control" value="<?php echo $user->billing_phone; ?>"><span class="error"><?php echo form_error('billing_phone'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="billing_region">Región:</label>
                            <select id="billing_region" name="billing_region" class="form-control" value="<?php echo $user->billing_region; ?>" onchange="setBillingRegion()">
                                <option value>Seleccione</option>
                            </select><span class="error"><?php echo form_error('billing_region'); ?></span>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="billing_provincia">Provincia:</label>
                            <select id="billing_provincia" name="billing_provincia" class="form-control" value="<?php echo $user->billing_provincia; ?>" onchange="setBillingProvincia()">
                                <option value>Seleccione</option>
                            </select><span class="error"><?php echo form_error('billing_provincia'); ?></span>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="billing_comuna">Comuna:</label>
                            <select id="billing_comuna" name="billing_comuna" class="form-control" value="<?php echo $user->billing_comuna; ?>">
                                <option value>Seleccione</option>
                            </select><span class="error"><?php echo form_error('billing_comuna'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label for="billing_address1">Dirección:</label>
                            <input type="text" name="billing_address1" id="billing_address1" class="form-control" value="<?php echo $user->billing_address1; ?>"><span class="error"><?php echo form_error('billing_address1'); ?></span>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="billing_address2">Block/Depto/Casa:</label>
                            <input type="text" name="billing_address2" id="billing_address2" class="form-control" value="<?php echo $user->billing_address2; ?>"><span class="error"><?php echo form_error('billing_address2'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Datos de Envío</h4>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="form-inline">
                                <div class="checkbox"><input type="checkbox" id="sameAsBilling" name="sameAsBilling" onchange="sameAsBillingDo()"><label for="sameAsBilling"> &nbsp; ¿Datos de envío iguales a Facturación?</label></div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group has-feedback">
                            <label for="shipping_rut">RUT:</label>
                            <input ng-rut type="text" name="shipping_rut" id="shipping_rut" class="form-control" value="<?php echo $user->shipping_rut; ?>"><span class="error"><?php echo form_error('shipping_rut'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="shipping_name">Nombre Completo:</label>
                            <input type="text" name="shipping_name" id="shipping_name" class="form-control" value="<?php echo $user->shipping_name; ?>"><span class="error"><?php echo form_error('shipping_name'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="shipping_email">Email:</label>
                            <input type="email" name="shipping_email" id="shipping_email" class="form-control" value="<?php echo $user->shipping_email; ?>"><span class="error"><?php echo form_error('shipping_email'); ?></span>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="shipping_phone">Teléfono:</label>
                            <input type="text" name="shipping_phone" id="shipping_phone" class="form-control" value="<?php echo $user->shipping_phone; ?>"><span class="error"><?php echo form_error('shipping_phone'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="shipping_region">Región:</label>
                            <select id="shipping_region" name="shipping_region" class="form-control" value="<?php echo $user->shipping_region; ?>" onchange="setShippingRegion()">
                                <option value>Seleccione</option>
                            </select><span class="error"><?php echo form_error('shipping_region'); ?></span>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="shipping_provincia">Provincia:</label>
                            <select id="shipping_provincia" name="shipping_provincia" class="form-control" value="<?php echo $user->shipping_provincia; ?>" onchange="setShippingProvincia()">
                                <option value>Seleccione</option>
                            </select><span class="error"><?php echo form_error('shipping_provincia'); ?></span>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="shipping_comuna">Comuna:</label>
                            <select id="shipping_comuna" name="shipping_comuna" class="form-control" value="<?php echo $user->shipping_comuna; ?>">
                                <option value>Seleccione</option>
                            </select><span class="error"><?php echo form_error('shipping_comuna'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label for="shipping_address1">Dirección:</label>
                            <input type="text" name="shipping_address1" id="shipping_address1" class="form-control" value="<?php echo $user->shipping_address1; ?>"><span class="error"><?php echo form_error('shipping_address1'); ?></span>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="shipping_address2">Block/Depto/Casa:</label>
                            <input type="text" name="shipping_address2" id="shipping_address2" class="form-control" value="<?php echo $user->shipping_address2; ?>"><span class="error"><?php echo form_error('shipping_address2'); ?></span>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
  </div>

</div>

<script type="text/javascript">

    $.getJSON( "<?php echo base_url('index.php/region'); ?>", function( data ) {
        $.each( data, function( key, val ) {
            $('#billing_region').append("<option value="+val.REGION_ID+">"+val.REGION_NOMBRE+"</option>");
            $('#shipping_region').append("<option value="+val.REGION_ID+">"+val.REGION_NOMBRE+"</option>");
        });
        $('#billing_region').val(<?php echo $user->billing_region; ?>);
        $('#shipping_region').val(<?php echo $user->shipping_region; ?>);
    });

    $.getJSON( "<?php echo base_url('index.php/provincia/'.$user->billing_region); ?>", function( data ) {
        $.each( data, function( key, val ) {
            $('#billing_provincia').append("<option value="+val.PROVINCIA_ID+">"+val.PROVINCIA_NOMBRE+"</option>");
            $('#billing_provincia').val(<?php echo $user->billing_provincia; ?>);
        });
    });

    $.getJSON( "<?php echo base_url('index.php/provincia/'.$user->shipping_region); ?>", function( data ) {
        $.each( data, function( key, val ) {
            $('#shipping_provincia').append("<option value="+val.PROVINCIA_ID+">"+val.PROVINCIA_NOMBRE+"</option>");
            $('#shipping_provincia').val(<?php echo $user->shipping_provincia; ?>);
        });
    });

    $.getJSON( "<?php echo base_url('index.php/comuna/'.$user->billing_provincia); ?>", function( data ) {
        $.each( data, function( key, val ) {
            $('#billing_comuna').append("<option value="+val.COMUNA_ID+">"+val.COMUNA_NOMBRE+"</option>");
        });
        $('#billing_comuna').val(<?php echo $user->billing_comuna; ?>);
    });

    $.getJSON( "<?php echo base_url('index.php/comuna/'.$user->shipping_provincia); ?>", function( data ) {
        $.each( data, function( key, val ) {
            $('#shipping_comuna').append("<option value="+val.COMUNA_ID+">"+val.COMUNA_NOMBRE+"</option>");
        });
        $('#shipping_comuna').val(<?php echo $user->shipping_comuna; ?>);
    });

    function setShippingRegion(){

        var id_region = $('#shipping_region').val();

        if(!id_region) {
            $('#shipping_provincia').empty().append("<option value>Seleccione</option>");
            $('#shipping_comuna').empty().append("<option value>Seleccione</option>");
            return false;
        }

        $.getJSON( "<?php echo base_url('index.php/provincia'); ?>/"+id_region, function( data ) {
            $('#shipping_provincia').empty().append("<option value>Seleccione</option>");
            $.each( data, function( key, val ) {
                $('#shipping_provincia').append("<option value="+val.PROVINCIA_ID+">"+val.PROVINCIA_NOMBRE+"</option>");
            });
        });
    }

    function setBillingRegion(){

        var id_region = $('#billing_region').val();

        if(!id_region) {
            $('#billing_provincia').empty().append("<option value>Seleccione</option>");
            $('#billing_comuna').empty().append("<option value>Seleccione</option>");
            return false;
        }

        $.getJSON( "<?php echo base_url('index.php/provincia'); ?>/"+id_region, function( data ) {
            $('#billing_provincia').empty().append("<option value>Seleccione</option>");
            $.each( data, function( key, val ) {
                $('#billing_provincia').append("<option value="+val.PROVINCIA_ID+">"+val.PROVINCIA_NOMBRE+"</option>");
            });
        });
    }

    function setShippingProvincia(){

        var id_provincia = $('#shipping_provincia').val();

        if(!id_provincia) {
            $('#shipping_comuna').empty().append("<option value>Seleccione</option>");
            return false;
        }

        $.getJSON( "<?php echo base_url('index.php/comuna'); ?>/"+id_provincia, function( data ) {
            $('#shipping_comuna').empty().append("<option value>Seleccione</option>");
            $.each( data, function( key, val ) {
                $('#shipping_comuna').append("<option value="+val.COMUNA_ID+">"+val.COMUNA_NOMBRE+"</option>");
            });
        });
    }

    function setBillingProvincia(){

        var id_provincia = $('#billing_provincia').val();

        if(!id_provincia) {
            $('#billing_comuna').empty().append("<option value>Seleccione</option>");
            return false;
        }

        $.getJSON( "<?php echo base_url('index.php/comuna'); ?>/"+id_provincia, function( data ) {
            $('#billing_comuna').empty().append("<option value>Seleccione</option>");
            $.each( data, function( key, val ) {
                $('#billing_comuna').append("<option value="+val.COMUNA_ID+">"+val.COMUNA_NOMBRE+"</option>");
            });
        });
    }

    function sameAsBillingDo(){

        if($('#sameAsBilling').is(":checked")) {

            $('#shipping_rut').val($('#billing_rut').val());

            $('#shipping_name').val($('#billing_name').val());

            $('#shipping_email').val($('#billing_email').val());

            $('#shipping_phone').val($('#billing_phone').val());

            $('#shipping_region').val($('#billing_region').val());
            $.getJSON( "<?php echo base_url('index.php/provincia'); ?>/"+$('#billing_region').val(), function( data ) {
                $('#shipping_provincia').empty().append("<option value>Seleccione</option>");
                $.each( data, function( key, val ) {
                    $('#shipping_provincia').append("<option value="+val.PROVINCIA_ID+">"+val.PROVINCIA_NOMBRE+"</option>");
                });
                $('#shipping_provincia').val($('#billing_provincia').val());
            });

            $.getJSON( "<?php echo base_url('index.php/comuna'); ?>/"+$('#billing_provincia').val(), function( data ) {
                $('#shipping_comuna').empty().append("<option value>Seleccione</option>");
                $.each( data, function( key, val ) {
                    $('#shipping_comuna').append("<option value="+val.COMUNA_ID+">"+val.COMUNA_NOMBRE+"</option>");
                });
                $('#shipping_comuna').val($('#billing_comuna').val());
            });

            $('#shipping_address1').val($('#billing_address1').val());

            $('#shipping_address2').val($('#billing_address2').val());


        } else {

            $('#shipping_rut').val('');
            $('#shipping_name').val('');
            $('#shipping_email').val('');
            $('#shipping_phone').val('');
            $('#shipping_region').val('');
            $('#shipping_provincia').val('');
            $('#shipping_comuna').val('');
            $('#shipping_address1').val('');
            $('#shipping_address2').val('');

        }

    }

</script>
