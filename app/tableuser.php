<link rel="stylesheet" href="../assets/datatables/datatables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
// Delete data user
if (isset($_POST['btndelete'])) {

    $delete = $conn->prepare("DELETE FROM user WHERE iduser = ?");
    $delete->bindParam(1, $_POST['iduser']);
    $delete->execute();

    if ($delete->rowCount() > 0) {
        $msgdel = array("Usuario eliminado correctamente", "success");
    } else {
        $msgdel = array("Error al eliminar el usuario", "danger");
    }
}
?>
<div class="mt-5">
    <h1>Tabla de usuarios</h1>
    <!--Alerts-->
    <?php if (isset($msgdel)) { ?>
        <div class="alert alert-<?php echo $msgdel[1]; ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Alerta!</strong> <?php echo $msgdel[0]; ?>
        </div>
    <?php } ?>
    <!--Alerts-->
    <table class="table table-striped table-hover" id="tuser">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->prepare("SELECT * FROM user");
            $data->execute();

            foreach ($data as $row) {
            ?>
                <tr>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['rol']; ?></td>
                    <td>
                        <!--Boton de editar-->
                        <form action="" method="post">
                            <button type="submit" class="btn btn-outline-primary">Editar</button>
                        </form>
                        <!--Boton de eliminar-->
                        <form action="" method="post" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                            <input type="hidden" name="iduser" value="<?php echo $row['iduser']; ?>">
                            <button type="submit" class="btn btn-outline-danger" name="btndelete">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="../assets/datatables/datatables.min.js"></script>

<script>
    let table = new DataTable('#tuser', {
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },

        layout: {
            topStart: {
                buttons: [{
                        extend: 'excel',
                        text: 'Excel',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success',
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            }
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger',
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            }
                        }
                    }
                ],
            }
        }
    });

    /*
        {
    "decimal":        "",
    "emptyTable":     "No data available in table",
    "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
    "infoEmpty":      "Showing 0 to 0 of 0 entries",
    "infoFiltered":   "(filtered from _MAX_ total entries)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Show _MENU_ entries",
    "loadingRecords": "Loading...",
    "processing":     "",
    "search":         "Search:",
    "zeroRecords":    "No matching records found",
    "paginate": {
        "first":      "First",
        "last":       "Last",
        "next":       "Next",
        "previous":   "Previous"
    },
    "aria": {
        "orderable":  "Order by this column",
        "orderableReverse": "Reverse order this column"
    }
}*/
</script>