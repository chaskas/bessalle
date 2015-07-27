<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation"><a href="<?php echo site_url('admin/product/new');?>" aria-controls="nuevo" role="tab">Nuevo</a></li>
    <li role="presentation"><a href="<?php echo site_url('admin/products');?>" aria-controls="productos" role="tab">Productos</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">
        
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Editar Imagen</h3>
                </div>
                <div class="panel-body">
                    <?php echo form_open_multipart('admin/upload/'.$product->id) ?>
                    
                    <div class="text-center">
                        <?php if($product->image == null || $product->image == '') : ?>
                            <?php echo $error; ?>
                            <?php echo img(array('src'=>'assets/images/placeholder.jpg','class'=>'img-thumbnail')); ?>
                        <?php else : ?>
                            <?php echo img(array('src'=>$product->image,'class'=>'img-thumbnail')); ?>
                        <?php endif; ?>
                        <br><br>
                        <input type="file" name="image" class="form-control"/>
                        <br>
                        <button type="submit" class="btn btn-warning btn-sm">Subir</button>
                    </div>
                    </form>
                    
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
  </div>

</div>