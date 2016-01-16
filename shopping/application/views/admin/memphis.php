<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="#" aria-controls="chilexpress" role="tab">Memphis</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active" id="chilexpress">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">Lugar</th>
                    <th class="text-center">5 Kg</th>
                    <th class="text-center">10 Kg</th>
                    <th class="text-center">15 Kg</th>
                    <th class="text-center">20 Kg</th>
                    <th class="text-center">30 Kg</th>
                    <th class="text-center">40 Kg</th>
                    <th class="text-center">50 Kg</th>
                    <th class="text-center">60 Kg</th>
                    <th class="text-center">70 Kg</th>
                    <th class="text-center">80 Kg</th>
                    <th class="text-center">90 Kg</th>
                    <th class="text-center">100 Kg</th>
                    <th class="text-center">2000 Kg</th>
                    <th class="text-center">5000 Kg</th>
                    <th class="text-center">10000 Kg</th>
                    <th class="text-center">Kg Adicional</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transport as $t): ?>
                <tr>
                    <td colspan="18"><?php echo  $t['nombre']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-center"><?php echo $t['5']; ?></td>
                    <td class="text-center"><?php echo $t['10']; ?></td>
                    <td class="text-center"><?php echo $t['15']; ?></td>
                    <td class="text-center"><?php echo $t['20']; ?></td>
                    <td class="text-center"><?php echo $t['30']; ?></td>
                    <td class="text-center"><?php echo $t['40']; ?></td>
                    <td class="text-center"><?php echo $t['50']; ?></td>
                    <td class="text-center"><?php echo $t['60']; ?></td>
                    <td class="text-center"><?php echo $t['70']; ?></td>
                    <td class="text-center"><?php echo $t['80']; ?></td>
                    <td class="text-center"><?php echo $t['90']; ?></td>
                    <td class="text-center"><?php echo $t['100']; ?></td>
                    <td class="text-center"><?php echo $t['2000']; ?></td>
                    <td class="text-center"><?php echo $t['5000']; ?></td>
                    <td class="text-center"><?php echo $t['10000']; ?></td>
                    <td class="text-center"><?php echo $t['SUP']; ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-xs" role="group">
                            <a href="<?php echo site_url('admin/transport/memphis/'.$t['id']);?>" class="btn btn-default" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>
  </div>

</div>
