<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url("static/css/bootstrap.min.css") ?>" />
    <link rel="stylesheet" href="<?php echo base_url("static/css/style.css") ?>" />
    <link rel="stylesheet" href="<?php echo base_url("static/css/datatables.min.css") ?>">
    <meta name="theme-color">
    <script src="https://kit.fontawesome.com/937f402df2.js" crossorigin="anonymous"></script>
    <title>Areas</title>
</head>
<script>
    var base_url = "<?php echo base_url(); ?>";
</script>

<body>
    <section class="container">
        <div class="container-fluid px-4" style="margin-top: 80px;">
            <div class="row g-3">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <a href="<?php echo base_url("home/index"); ?>" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
                                <h1 style="text-align: center;">Lista de Areas</h1>
                            </div>
                            <form id="formularioAddArea"  enctype="multipart/form-data" class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" id="nomAreaAdd" name="nomAreaAdd" placeholder="Ingrese el nombre del area" class="form-control" aria-describedby="Nomnbre del area" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" step="any" id="numEmpAdd" name="numEmpAdd" placeholder="Ingrese el numero de empleados del area" class="form-control" aria-describedby="Numero de empleados" required>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Agregar Area <i class="fas fa-plus"> </i></button>
                                </div>

                            </form>
                            <br>
                            <br>
                            <div class="row g-3">
                                <div class="col-md-12 mt-2">
                                    <table id="tableListArea" class="table table-striped nowrap table-sm " style="width:100%;">
                                        <thead style="background-color: #222059; color: white;">
                                            <tr>
                                                <th>NOMBRE</th>
                                                <th># EMPLEADOS</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL PARA ACTUALIZAR INFORMACION -->

    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Area</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioUpArea" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nomAreaUp" class="form-label">Nombre Area</label>
                            <input type="hidden" id="idUp" name="idUp">
                            <input type="text" id="nomAreaUp" name="nomAreaUp" placeholder="Ingrese el nombre del area" class="form-control" aria-describedby="Nomnbre del area" required>
                        </div>
                        <div class="mb-3">
                            <label for="numEmpUP" class="form-label">Numero de Empleados</label>
                            <input type="number" step="any" id="numEmpUP" name="numEmpUp" placeholder="Ingrese el numero de empleados del area" class="form-control" aria-describedby="Numero de empleados" required>
                        </div>
                        <div style="display: flex; justify-content: right;">
                            <button type="submit" class="btn btn-warning">Actualizar <i class = "fas fa-edit"></i></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url("static/js/jquery-3.6.3.min.js") ?>"></script>
    <script src="<?php echo base_url("static/js/bootstrap.min.js") ?>"></script>
    <script src="<?php echo base_url("static/js/datatables.min.js") ?>"></script>
    <script src="<?php echo base_url("static/js/area/area.js") ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>