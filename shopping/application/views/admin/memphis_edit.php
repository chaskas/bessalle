<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="#" aria-controls="categorias" role="tab">Memphis</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">
        <?php echo form_open('admin/transport/memphis/'.$memphis['id']) ?>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Editar Memphis</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $memphis['nombre']; ?>"><span class="error"><?php echo form_error('nombre'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">0 - 5 KG</label>
                                <input type="text" class="form-control" id="5" name="5" value="<?php echo $memphis['5']; ?>"><span class="error"><?php echo form_error('5'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">5 - 10 KG</label>
                                <input type="text" class="form-control" id="10" name="10" value="<?php echo $memphis['10']; ?>"><span class="error"><?php echo form_error('10'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">10 - 15 KG</label>
                                <input type="text" class="form-control" id="15" name="15" value="<?php echo $memphis['15']; ?>"><span class="error"><?php echo form_error('15'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">15 - 20 KG</label>
                                <input type="text" class="form-control" id="20" name="20" value="<?php echo $memphis['20']; ?>"><span class="error"><?php echo form_error('20'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">20 - 30 KG</label>
                                <input type="text" class="form-control" id="30" name="30" value="<?php echo $memphis['30']; ?>"><span class="error"><?php echo form_error('30'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">30 - 40 KG</label>
                                <input type="text" class="form-control" id="40" name="40" value="<?php echo $memphis['40']; ?>"><span class="error"><?php echo form_error('40'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">40 - 50 KG</label>
                                <input type="text" class="form-control" id="50" name="50" value="<?php echo $memphis['50']; ?>"><span class="error"><?php echo form_error('50'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">50 - 60 KG</label>
                                <input type="text" class="form-control" id="60" name="60" value="<?php echo $memphis['60']; ?>"><span class="error"><?php echo form_error('60'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">60 - 70 KG</label>
                                <input type="text" class="form-control" id="70" name="70" value="<?php echo $memphis['70']; ?>"><span class="error"><?php echo form_error('70'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">70 - 80 KG</label>
                                <input type="text" class="form-control" id="80" name="80" value="<?php echo $memphis['80']; ?>"><span class="error"><?php echo form_error('80'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">80 - 90 KG</label>
                                <input type="text" class="form-control" id="90" name="90" value="<?php echo $memphis['90']; ?>"><span class="error"><?php echo form_error('90'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">90 - 100 KG</label>
                                <input type="text" class="form-control" id="100" name="100" value="<?php echo $memphis['100']; ?>"><span class="error"><?php echo form_error('100'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">100 - 2000 KG</label>
                                <input type="text" class="form-control" id="2000" name="2000" value="<?php echo $memphis['2000']; ?>"><span class="error"><?php echo form_error('2000'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">2000 - 5000 KG</label>
                                <input type="text" class="form-control" id="5000" name="5000" value="<?php echo $memphis['5000']; ?>"><span class="error"><?php echo form_error('5000'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">5000 - 10000 KG</label>
                                <input type="text" class="form-control" id="10000" name="10000" value="<?php echo $memphis['10000']; ?>"><span class="error"><?php echo form_error('10000'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">ADIC</label>
                                <input type="text" class="form-control" id="SUP" name="SUP" value="<?php echo $memphis['SUP']; ?>"><span class="error"><?php echo form_error('SUP'); ?></span>
                            </div>
                        </div>
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
