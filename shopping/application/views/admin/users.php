<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation"><a href="<?php echo site_url('admin/user/new');?>" aria-controls="nueva" role="tab">Nuevo</a></li>
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/users');?>" aria-controls="users" role="tab">Usuarios</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active" id="categorias">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fono</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($users)) : ?>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user->billing_rut; ?></td>
                    <td><?php echo $user->billing_name; ?></td>
                    <td><?php echo $user->billing_email; ?></td>
                    <td><?php echo $user->billing_phone; ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-xs" role="group">
                            <a href="<?php echo site_url('admin/user/edit/'.$user->id);?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href="<?php echo site_url('admin/user/delete/'.$user->id);?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
                <?php else : ?>
                    <tr><td colspan = "5"><center><br>No existen Usuarios.</center></td></tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
  </div>

</div>
