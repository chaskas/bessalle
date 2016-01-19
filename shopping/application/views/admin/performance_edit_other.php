<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/performance');?>" aria-controls="rendimiento" role="tab">Costo / Rendimiento</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">
        <?php echo form_open('admin/performance/edit/other/'.$performance->id) ?>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Editar Costo / Rendimiento</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"><?php echo $performance->clase; ?></label>
                                <input type="text" class="form-control" id="clase_v" name="clase_v" value="<?php echo $performance->clase_v; ?>"><span class="error"><?php echo form_error('clase_v'); ?></span>
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
