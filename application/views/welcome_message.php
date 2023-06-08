<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url("static/css/bootstrap.min.css") ?>" />
    <link rel="stylesheet" href="<?php echo base_url("static/css/style.css") ?>" />
    <link rel="stylesheet" href="<?php echo base_url("static/css/datatables.min.css") ?>">
    <meta name="theme-color">
    <script src="https://kit.fontawesome.com/937f402df2.js" crossorigin="anonymous"></script>
	<title>Home</title>
</head>

<body>
	<head>
	</head>
	<main class="container-fluid">
		<section style="margin: 1rem;">
			<h1 class="text-center">Seleccion de modulos</h1>
		</section>
		<section class="row g-3" style="display: flex; justify-content: center; margin: 1rem;">
			<div class="card col-md-3" style="padding: 5px; margin: 5px;">
				<div class="card-body">
					<h2>Módulo de empleados</h2>
					<p>Aqui se puede ver la tabla de empleados, agregar, editar e eliminarlos</p>
					<div style="display: flex; justify-content: right;">
						<a href="<?php echo base_url('empleado/index'); ?>" class="btn btn-primary">Ir <i class="fas fa-arrow-right"></i></a>
					</div>
				</div>
			</div>
			<div class="card col-md-3" style="padding: 5px; margin: 5px;">
				<div class="card-body">
					<h2>Módulo de áreas</h2>
					<p>Aqui se puede ver la tabla de empleados, agregar, editar e eliminarlos</p>
					<div style="display: flex; justify-content: right;">
						<a href="<?php echo base_url('area/index'); ?>" class="btn btn-primary">Ir <i class="fas fa-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</section>
	</main>
</body>

</html>