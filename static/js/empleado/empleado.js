$(document).ready(function () {
	//$("#datatable").DataTable();
	$("#tableListEmpleados").DataTable({
		ajax: {
			url: `${base_url}/empleado/getListEmpleados`,
		},
		deferRender: true,
		scrollY: 340,
		scrollX: true,
		stateSave: true,
		paging: true,
		/* select: true, */
		orderCellsTop: true,
		fixedHeader: true,
		lengthMenu: [
			[10, 20, 1000, -1],
			[10, 20, 1000, "Todos"],
		],
		dom:
			"<'row'<'col-sm-6'B><'col-sm-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
		language: {
			url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
		},
		order: [[0, "asc"]],
		columns: [
			{
				mRender: function (data, type, row) {
					return `${row.nom} ${row.ap1} ${row.ap2}`;
				},
			},
			{
				data: "correo",
			},
			{
				data: "fecha_nac",
			},
			{
				data: "nom_are",
			},
			{
				data: "id_emp",
				mRender: function (data, type, row) {
					return `
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdate" onclick = " updateEmpleado(${data})">Editar</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick = "deleteEmpleado(${data})" >Eliminar</button>
                </div>`;
				},
			},
		],
		buttons: [
			{
				extend: "excelHtml5",
				title: "Lista de Empleados",
				text: '<i class="fas fa-file-excel"></i>',
				className: "btn-sm",
			},
			{
				extend: "csvHtml5",
				title: "Lista de Empleados",
				text: '<i class="fa-solid fa-file-csv"></i>',
				className: "btn-sm",
			},
			{
				extend: "pdfHtml5",
				title: "Lista de Empleados",
				text: '<i class="fas fa-file-pdf"></i>',
				className: "btn-sm",
				orientation: "landscape",
				footer: "true",
				exportOptions: {
					columns: ":visible",
				},
			},
			{
				extend: "print",
				title: "Lista de Empleados",
				className: "btn-sm",
				text: '<i class="fa-solid fa-print"></i>',
				footer: "true",
				exportOptions: {
					columns: ":visible",
				},
			},
			{
				extend: "copy",
				title: "Lista de Empleados",
				className: "btn-sm",
				text: '<i class="fas fa-copy"></i>',
			},
			{
				extend: "colvis",
				className: "btn-sm",
				text: '<i class="fas fa-eye"></i>',
			},
			{
				extend: "print",
				text: '<i class="fas fa-print"></i>',
				className: "btn-sm",
				exportOptions: {
					modifier: {
						selected: null,
					},
				},
			},
		],
	});
});

function getListAreas() {
	let url = `${base_url}/area/getListAreas`;
	$.ajax({
		type: "GET",
		url: url,
		async: true,
		beforeSend: function () {},
		success: function (response) {
			var listAreas = `<option value = "" selected >Seleccione una area </option>`;
			response.data.forEach((element) => {
				listAreas += `<option value = "${element.id_are}" >${element.nom_are}</option>`;
			});
			document.getElementById("areaEmpAdd").innerHTML = listAreas;
      document.getElementById("areaEmpUp").innerHTML = listAreas;
		},
		error: function (error) {
			console.log(error);
		},
	});
}
getListAreas();

function updateEmpleado(id) {
    let url = `${base_url}Empleado/getEmpleadoById`
    $.ajax({
        type: "POST",
        url: url,
        data: {
          id: id,
        },
        async: true,
        beforeSend: function () {},
        success: function (response) {
            if(response.success == true){
              document.getElementById("idEmpUp").value = id;
              document.getElementById("nomEmpUp").value  = response.data.nom;
              document.getElementById("ap1EmpUp").value  = response.data.ap1;
              document.getElementById("ap2EmpUp").value  = response.data.ap2;
              document.getElementById("corEmpUp").value  = response.data.correo;
              document.getElementById("fecNacEmpUp").value  = response.data.fecha_nac;
              document.getElementById("areaEmpUp").value  = response.data.id_are;
            }
        },
        error: function (error) {
          console.log(error);
        },
      });
}





formularioUpEmpleado.addEventListener('submit', e => {
    e.preventDefault();
    const data = Object.fromEntries(new FormData(e.target));
    let url = `${base_url}Empleado/updateEmpleado`;
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: data.idEmpUp,
            nomEmp: data.nomEmpUp,
            ap1Emp: data.ap1EmpUp,
            ap2Emp: data.ap2EmpUp,
            corrEmp: data.corEmpUp,
            fechNacEmp: data.fecNacEmpUp,
            id_are: data.areaEmpUp
        },
        async: true,
        beforeSend: function () {},
        success: function (response) {
            if(response.success == true){
                Swal.fire("¡Alerta!", `${response.message}`, "success");
                $("#tableListEmpleados").DataTable().ajax.reload();
                document.getElementById('formularioUpEmpleado').reset();
            }else{
                Swal.fire("¡Alerta!", `${response.message}`, "error");
                $("#tableListEmpleados").DataTable().ajax.reload();
                document.getElementById('formularioUpEmpleado').reset();
            }
        },
        error: function (error) {
          console.log(error);
        },
      });

  }); 

formularioAddEmpleado.addEventListener("submit", (e) => {
	e.preventDefault();
	const data = Object.fromEntries(new FormData(e.target));
	let url = `${base_url}Empleado/insertEmpleado`;
	$.ajax({
		type: "POST",
		url: url,
		data: {
			nomEmp: data.nomEmpAdd,
			ap1Emp: data.ap1EmpAdd,
      ap2Emp: data.ap2EmpAdd,
      corrEmp: data.corEmpAdd,
      fechNacEmp: data.fecNacEmpAdd,
      id_are: data.areaEmpAdd,
		},
		async: true,
		beforeSend: function () {},
		success: function (response) {
			if (response.success == true) {
				Swal.fire("¡Alerta!", `${response.message}`, "success");
				$("#tableListEmpleados").DataTable().ajax.reload();
				document.getElementById("formularioAddEmpleado").reset();
			} else {
				Swal.fire("¡Alerta!", `${response.message}`, "error");
				$("#tableListEmpleados").DataTable().ajax.reload();
				document.getElementById("formularioAddEmpleado").reset();
			}
		},
		error: function (error) {
			console.log(error);
		},
	});
});


function deleteEmpleado(id) {
  let url = `${base_url}Empleado/deleteEmpleado`
  $.ajax({
      type: "POST",
      url: url,
      data: {
        id: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
          if(response.success == true){
              Swal.fire("¡Alerta!", `${response.message}`, "success");
              $("#tableListEmpleados").DataTable().ajax.reload();
          }else{
              Swal.fire("¡Alerta!", `${response.message}`, "error");
              $("#tableListEmpleados").DataTable().ajax.reload();
          }
      },
      error: function (error) {
        console.log(error);
      },
    });
}
