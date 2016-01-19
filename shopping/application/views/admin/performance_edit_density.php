<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/performance');?>" aria-controls="rendimiento" role="tab">Costo / Rendimiento</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">
        <?php echo form_open('admin/performance/edit/density/'.$performance->id) ?>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Editar Costo / Rendimiento</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Alta Densidad</label>
                                <input type="text" class="form-control" id="tipo_1" name="tipo_1" value="<?php echo $performance->tipo_1; ?>"><span class="error"><?php echo form_error('tipo_1'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Baja Densidad</label>
                                <input type="text" class="form-control" id="tipo_2" name="tipo_2" value="<?php echo $performance->tipo_2; ?>"><span class="error"><?php echo form_error('tipo_2'); ?></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
  </div>

</div>
