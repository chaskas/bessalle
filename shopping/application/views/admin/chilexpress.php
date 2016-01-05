<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="#" aria-controls="chilexpress" role="tab">Chilexpress</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active" id="chilexpress">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">Lugar</th>
                    <th class="text-center">1.5 Kg</th>
                    <th class="text-center">3 Kg</th>
                    <th class="text-center">6 Kg</th>
                    <th class="text-center">10 Kg</th>
                    <th class="text-center">15 Kg</th>
                    <th class="text-center">Kg Adicional</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transport as $t): ?>
                <tr>
                    <td colspan="9"><?php echo  $t['nombre']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-center"><?php echo $t['1K50']; ?></td>
                    <td class="text-center"><?php echo $t['3K']; ?></td>
                    <td class="text-center"><?php echo $t['6K']; ?></td>
                    <td class="text-center"><?php echo $t['10K']; ?></td>
                    <td class="text-center"><?php echo $t['15K']; ?></td>
                    <td class="text-center"><?php echo $t['ADIC']; ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-xs" role="group">
                            <a href="<?php echo site_url('admin/transport/chilexpress/'.$t['id']);?>" class="btn btn-default" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>
  </div>

</div>
