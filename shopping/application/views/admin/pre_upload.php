<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation"><a href="<?php echo site_url('admin/product/new');?>" aria-controls="nuevo" role="tab">Nuevo</a></li>
    <li role="presentation"><a href="<?php echo site_url('admin/products');?>" aria-controls="productos" role="tab">Productos</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">

            <div class="panel panel-default">
                <?php echo form_open_multipart('admin/upload/'.$product->id) ?>
                <div class="panel-heading">
                    <h3 class="panel-title">Editar Imagen</h3>
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <?php echo $error; ?>

                        <br>
                        <input type="file" name="image" class="form-control"/>
                        <br>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-success">Siguiente</button>
                </div>
                </form>
            </div>
        </form>
    </div>
  </div>

</div>
