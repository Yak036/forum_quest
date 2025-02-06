// Configuración de DataTables
function initializePracticesTable() {
    $('#practicesTable').DataTable({
        responsive: true,
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        },
        pageLength: 10,
        order: [[1, 'asc']], // Ordenar por fecha por defecto
        columnDefs: [
            {
                targets: -1,
                orderable: false,
                searchable: false
            }
        ]
    });
}

// Función para eliminar práctica
function deletePractice(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Deseas eliminar esta practica?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emit('deletePractice', id);
        }
    });
}

// Inicializar cuando el documento esté listo
$(document).ready(function() {
    initializePracticesTable();
    
    // Escuchar eventos de Livewire
    document.addEventListener('livewire:load', function() {
        Livewire.on('showAlert', params => {
            Swal.fire({
                icon: params.type,
                title: params.title,
                text: params.message,
                confirmButtonColor: '#D97706'
            });
        });
    });
});
