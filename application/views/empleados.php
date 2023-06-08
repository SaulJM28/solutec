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
    <title>Empleados</title>
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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInsert">Agregar <i class ="fas fa-plus"></i></button>
                            </div>
                            <br>
                            <br>
                            <div class="row g-3">
                                <div class="col-md-12 mt-2">
                                    <table id="tableListEmpleados" class="table table-striped nowrap table-sm " style="width:100%;">
                                        <thead style="background-color: #222059; color: white;">
                                            <tr>
                                                <th>NOMBRE</th>
                                                <th>CORREO</th>
                                                <th>FECHA NAC</th>
                                                <th>AREA</th>
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
    <!-- MODAL AGREGAR INFORMACION -->
    <div class="modal fade" id="modalInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Insertar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioAddEmpleado" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nomEmpAdd" class="form-label">Nombre</label>
                            <input type="text" id="nomEmpAdd" name="nomEmpAdd" placeholder="Ingrese el nombre del empleado" class="form-control" aria-describedby="Nomnbre del empleado" required>
                        </div>
                        <div class="mb-3">
                            <label for="ap1EmpAdd" class="form-label">Primer Apellido</label>
                            <input type="text"  id="ap1EmpAdd" name="ap1EmpAdd" placeholder="Ingrese el primer apellido del empleado" class="form-control" aria-describedby="Primer apellido del empleado" required>
                        </div>
                        <div class="mb-3">
                            <label for="ap2EmpAdd" class="form-label">Segundo Apellido</label>
                            <input type="text" id="ap2EmpAdd" name="ap2EmpAdd" placeholder="Ingrese el segundo apellido del empleado" class="form-control" aria-describedby="Segundo apellido del empleado" required>
                        </div>
                        <div class="mb-3">
                            <label for="corEmpAdd" class="form-label">Correo</label>
                            <input type="email"  id="corEmpAdd" name="corEmpAdd" placeholder="Ingrese el correo del empleado" class="form-control" aria-describedby="Correo del empleado" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecNacEmpAdd" class="form-label">Fecha Nacimineto</label>
                            <input type="date" step="any" id="fecNacEmpAdd" name="fecNacEmpAdd" placeholder="Ingrese la fecha de nacimiento del empleado" class="form-control" aria-describedby="Fecha de nacimiento" required>
                        </div>
                        <div class="mb-3">
                            <label for="areaEmpAdd" class="form-label">Area</label>
                            <select name="areaEmpAdd" id="areaEmpAdd" class="form-select"></select>
                        </div>
                        <div style="display: flex; justify-content: right;">
                            <button type="submit" class="btn btn-success">Agregar <i class = "fas fa-plus"></i></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>



    <!-- MODAL PARA ACTUALIZAR INFORMACION -->

    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Area</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="formularioUpEmpleado" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nomEmpUp" class="form-label">Nombre</label>
                            <input type="hidden" id="idEmpUp" name = "idEmpUp">
                            <input type="text" id="nomEmpUp" name="nomEmpUp" placeholder="Ingrese el nombre del empleado" class="form-control" aria-describedby="Nomnbre del empleado" required>
                        </div>
                        <div class="mb-3">
                            <label for="ap1EmpUp" class="form-label">Primer Apellido</label>
                            <input type="text"  id="ap1EmpUp" name="ap1EmpUp" placeholder="Ingrese el primer apellido del empleado" class="form-control" aria-describedby="Primer apellido del empleado" required>
                        </div>
                        <div class="mb-3">
                            <label for="ap2EmpUp" class="form-label">Segundo Apellido</label>
                            <input type="text" id="ap2EmpUp" name="ap2EmpUp" placeholder="Ingrese el segundo apellido del empleado" class="form-control" aria-describedby="Segundo apellido del empleado" required>
                        </div>
                        <div class="mb-3">
                            <label for="corEmpUp" class="form-label">Correo</label>
                            <input type="email"  id="corEmpUp" name="corEmpUp" placeholder="Ingrese el correo del empleado" class="form-control" aria-describedby="Correo del empleado" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecNacEmpUp" class="form-label">Fecha Nacimineto</label>
                            <input type="date" step="any" id="fecNacEmpUp" name="fecNacEmpUp" placeholder="Ingrese la fecha de nacimiento del empleado" class="form-control" aria-describedby="Fecha de nacimiento" required>
                        </div>
                        <div class="mb-3">
                            <label for="areaEmpUp" class="form-label">Area</label>
                            <select name="areaEmpUp" id="areaEmpUp" class="form-select"></select>
                        </div>
                        <div style="display: flex; justify-content: right;">
                            <button type="submit" class="btn btn-warning">Editar <i class = "fas fa-edit"></i></button>
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
    <script src="<?php echo base_url("static/js/empleado/empleado.js") ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>