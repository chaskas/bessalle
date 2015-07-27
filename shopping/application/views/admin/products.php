<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation"><a href="<?php echo site_url('admin/product/new');?>" aria-controls="nuevo" role="tab">Nuevo</a></li>
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/products');?>" aria-controls="categorias" role="tab">Productos</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active" id="categorias">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Producto</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product->category_name; ?></td>
                    <td><?php echo $product->name; ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-xs" role="group">
                            <a href="<?php echo site_url('admin/product/edit/'.$product->id);?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href="<?php echo site_url('admin/product/delete/'.$product->id);?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
  </div>

</div>