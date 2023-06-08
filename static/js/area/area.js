$(document).ready(function () {
	//$("#datatable").DataTable();
	$("#tableListArea").DataTable({
		ajax: {
			url: `${base_url}area/getListAreas`,
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
				data: "nom_are",
			},
			{
				data: "num_emp",
			},
			{
				data: "id_are",
				mRender: function (data, type, row) {
					return `
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdate" onclick="updateArea(${data})">Editar</button>
                    <button type="button" class="btn btn-danger btn-sm"  onclick="deleteArea(${data})" >Eliminar</button>
                </div>`;
				},
			},
		],
		buttons: [
			{
				extend: "excelHtml5",
				title: "Lista de Servicios",
				text: '<i class="fas fa-file-excel"></i>',
				className: "btn-sm",
			},
			{
				extend: "csvHtml5",
				title: "Lista de Servicios",
				text: '<i class="fa-solid fa-file-csv"></i>',
				className: "btn-sm",
			},
			{
				extend: "pdfHtml5",
				title: "Lista de Servicios",
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
				title: "Lista de Servicios",
				className: "btn-sm",
				text: '<i class="fa-solid fa-print"></i>',
				footer: "true",
				exportOptions: {
					columns: ":visible",
				},
			},
			{
				extend: "copy",
				title: "Lista de Servicios",
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

function updateArea(id) {
    let url = `${base_url}area/getAreaById`
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
               document.getElementById("idUp").value = id;
               document.getElementById("nomAreaUp").value = response.data.nom_are;
               document.getElementById("numEmpUP").value = response.data.num_emp;
            }
        },
        error: function (error) {
          console.log(error);
        },
      });
}

function deleteArea(id) {
    let url = `${base_url}area/deleteArea`
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
                $("#tableListArea").DataTable().ajax.reload();
            }else{
                Swal.fire("¡Alerta!", `${response.message}`, "error");
                $("#tableListArea").DataTable().ajax.reload();
            }
        },
        error: function (error) {
          console.log(error);
        },
      });
}

formularioAddArea.addEventListener('submit', e =>{
  e.preventDefault();
  const data = Object.fromEntries(new FormData(e.target))
  let url = `${base_url}area/insertArea`
  $.ajax({
      type: "POST",
      url: url,
      data: {
        nomArea: data.nomAreaAdd,
        numEmp: data.numEmpAdd
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
          if(response.success == true){
              Swal.fire("¡Alerta!", `${response.message}`, "success");
              $("#tableListArea").DataTable().ajax.reload();
              document.getElementById('formularioAddArea').reset();
          }else{
              Swal.fire("¡Alerta!", `${response.message}`, "error");
              $("#tableListArea").DataTable().ajax.reload();
              document.getElementById('formularioAddArea').reset();
          }
      },
      error: function (error) {
        console.log(error);
      },
    });
  });

  formularioUpArea.addEventListener('submit', e => {
    e.preventDefault();
    const data = Object.fromEntries(new FormData(e.target));
    let url = `${base_url}area/updateArea`;
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: data.idUp,
            nomArea: data.nomAreaUp,
            numEmp: data.numEmpUp
        },
        async: true,
        beforeSend: function () {},
        success: function (response) {
            if(response.success == true){
                Swal.fire("¡Alerta!", `${response.message}`, "success");
                $("#tableListArea").DataTable().ajax.reload();
                document.getElementById('formularioUpArea').reset();
            }else{
                Swal.fire("¡Alerta!", `${response.message}`, "error");
                $("#tableListArea").DataTable().ajax.reload();
                document.getElementById('formularioUpArea').reset();
            }
        },
        error: function (error) {
          console.log(error);
        },
      });

  });