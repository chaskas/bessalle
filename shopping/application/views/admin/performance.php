<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="#" aria-controls="performance" role="tab">Costo / Rendimiento</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active" id="categorias">

        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Alta Densidad</th>
                            <th class="text-center">Baja Densidad</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($densities as $d): ?>
                        <tr>
                            <td class="text-center"><?php echo $d['tipo_1']; ?></td>
                            <td class="text-center"><?php echo $d['tipo_2']; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs" role="group">
                                    <a href="<?php echo site_url('admin/performance/edit/density/'.$d['id']);?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">Clase</th>
                            <th class="text-center">Alta Densidad</th>
                            <th class="text-center">Baja Densidad</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($performances as $p): ?>
                        <tr>
                            <td><?php echo $p['clase']; ?></td>
                            <td class="text-center"><?php echo $p['clase_v']; ?></td>
                            <td class="text-center"><?php echo $p['valor_1']; ?></td>
                            <td class="text-center"><?php echo $p['valor_2']; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs" role="group">
                                    <a href="<?php echo site_url('admin/performance/edit/'.$p['id']);?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center">Valor</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $color['clase']; ?></td>
                                    <td class="text-center"><?php echo $color['clase_v']; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-xs" role="group">
                                            <a href="<?php echo site_url('admin/performance/edit/color/'.$color['id']);?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center">Valor</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $oxo['clase']; ?></td>
                                    <td class="text-center"><?php echo $oxo['clase_v']; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-xs" role="group">
                                            <a href="<?php echo site_url('admin/performance/edit/oxo/'.$oxo['id']);?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
  </div>

</div>
