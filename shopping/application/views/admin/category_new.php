<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/category/new');?>" aria-controls="nueva" role="tab">Nueva</a></li>
    <li role="presentation"><a href="<?php echo site_url('admin/categories');?>" aria-controls="categorias" role="tab">Categorías</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">
        <?php echo form_open('admin/category/new') ?>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Nueva Categoría</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name">Nombre</label> 
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>"><span class="error"><?php echo form_error('name'); ?></span>
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