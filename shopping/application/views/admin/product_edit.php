<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation"><a href="<?php echo site_url('admin/product/new');?>" aria-controls="nuevo" role="tab">Nuevo</a></li>
    <li role="presentation"><a href="<?php echo site_url('admin/products');?>" aria-controls="productos" role="tab">Productos</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">
        <?php echo form_open('admin/product/edit/'.$product->id) ?>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Editar Producto</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group text-center">
                                <br>
                                <?php if($product->image == null || $product->image == '') : ?>
                                    <?php echo img(array('src'=>'assets/images/placeholder.jpg','class'=>'img-thumbnail','height'=>180,'width'=>180)); ?>
                                <?php else : ?>
                                    <?php echo img(array('src'=>$product->image,'class'=>'img-thumbnail','height'=>180,'width'=>180)); ?>
                                <?php endif; ?>
                                <br><br><a href="<?php echo site_url('admin/pre_upload/'.$product->id); ?>" class="btn btn-warning btn-sm">Cambiar</a>
                            </div>
                        </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $product->name; ?>"><span class="error"><?php echo form_error('name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Categoría</label>
                                        <?php echo $categories; ?><span class="error"><?php echo form_error('category_id'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="description">Descripción</label>
                                        <textarea class="form-control" id="description" name="description" style="height:107px"><?php echo $product->description; ?></textarea><span class="error"><?php echo form_error('description'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="minimun">Mínimo</label>
                                                <input type="text" class="form-control" id="minimun" name="minimun" value="<?php echo $product->minimun; ?>"><span class="error"><?php echo form_error('minimun'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="unit">Unidad</label>
                                                <select name="unit" id="unit" class="form-control">
                                                    <option value="0" <?php if($product->unit == 0) echo "selected"; ?>>Kg</option>
                                                    <option value="1" <?php if($product->unit == 1) echo "selected"; ?>>Unidad</option>
                                                </select>
                                                <span class="error"><?php echo form_error('unit'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">Precios</div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price_retail">Precio Minorista</label>
                                                <input type="text" class="form-control" id="price_retail" name="price_retail" value="<?php echo $product->price_retail; ?>"><span class="error"><?php echo form_error('price_retail'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price">Precio Mayorista</label>
                                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $product->price; ?>"><span class="error"><?php echo form_error('price'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="min_wholesale">Mínimo para Precio Mayorista</label>
                                                <input type="text" class="form-control" id="min_wholesale" name="min_wholesale" value="<?php echo $product->min_wholesale; ?>"><span class="error"><?php echo form_error('min_wholesale'); ?></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">Datos de Transporte</div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="length">Largo (cm)</label>
                                            <input type="text" class="form-control" id="length" name="length" value="<?php echo $product->length; ?>">
                                            <span class="error"><?php echo form_error('length'); ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="width">Ancho (cm)</label>
                                            <input type="text" class="form-control" id="width" name="width" value="<?php echo $product->width; ?>">
                                            <span class="error"><?php echo form_error('width'); ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="height">Alto (cm)</label>
                                            <input type="text" class="form-control" id="height" name="height" value="<?php echo $product->height; ?>">
                                            <span class="error"><?php echo form_error('height'); ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="weight">Peso  (kg)</label>
                                            <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $product->weight; ?>">
                                            <span class="error"><?php echo form_error('weight'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-title">Stock</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Cantidad en Bodega: </label>
                                                    <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $product->stock; ?>" disabled>
                                                    <span class="error"><?php echo form_error('stock'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-title">Otros</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Orden</label>
                                                    <input type="text" class="form-control" id="order" name="order" value="<?php echo $product->order; ?>">
                                                    <span class="error"><?php echo form_error('order'); ?></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Destacado</label>
                                                    <select name="highlight" id="highlight" class="form-control">
                                                        <option value="0" <?php if($product->highlight == 0) echo "selected"; ?>>No</option>
                                                        <option value="1" <?php if($product->highlight == 1) echo "selected"; ?>>Si</option>
                                                    </select>
                                                    <span class="error"><?php echo form_error('highlight'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
