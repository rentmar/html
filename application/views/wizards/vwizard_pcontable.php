<div id="content-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-12 text-center">
                <h3>NUEVO PERIODO CONTABLE</h3>
            </div>

            <?php  if(validation_errors()): ?>
                <div class="col-12 ">
                    <div class="alert alert-warning">
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
            <?php  endif; ?>

            <div class="col-12">
                <?php echo form_open('wizards/periodoContableProcesar/'); ?>
                <div id="smartwizard">
                    <ul class="nav">

                        <li>
                            <a class="nav-link" href="#paso2">
                                <strong>Inventario</strong> <br> <small>Inicio periodo contable</small>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div id="paso2" class="tab-pane" role="tabpanel">
                            <div class="form-step-0" role="form" data-toggle="validator">
                                <div class="form-group">
                                    <label for="fechainicio">Fecha de inicio:</label>
                                    <input type="date" class="form-control" id="fechainicio" name="fechainicio"
                                           required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-step-1" role="form" data-toggle="validator">
                                <div class="form-group">
                                    <label for="email">Nota:</label>
                                    <textarea  class="form-control" id="etiqueta" name="etiqueta"
                                              required ></textarea>

                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-step-2" role="form">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        Enviar
                                    </button>
                                </div>

                            </div>

                        </div>

                    </div>


                </div>
                <?php echo form_close(); ?>

            </div>
        </div>


    </div>

</div>