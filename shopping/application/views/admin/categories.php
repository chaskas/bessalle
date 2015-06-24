<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation"><a href="<?php echo site_url('admin/category/new');?>" aria-controls="nueva" role="tab">Nueva</a></li>
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/categories');?>" aria-controls="categorias" role="tab">Categorías</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active" id="categorias">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category['name']; ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-xs" role="group">
                            <a href="<?php echo site_url('admin/category/edit/'.$category['id']);?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href="<?php echo site_url('admin/category/delete/'.$category['id']);?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
  </div>

</div>