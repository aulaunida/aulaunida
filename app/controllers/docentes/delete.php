<?php
include ('../../../app/config.php');
session_start();

$id_docente = $_POST['id_docente'];

try {
    $sentencia = $pdo->prepare("DELETE FROM docentes WHERE id_docente = :id_docente");
    $sentencia->bindParam(':id_docente', $id_docente);

    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Se eliminó el docente de manera correcta.";
        $_SESSION['icono'] = "success";
        $_SESSION['timer'] = 6000;
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true;
    } else {
        throw new Exception("No se pudo eliminar el docente por un error desconocido.");
    }
} catch (PDOException $e) {
    if ($e->getCode() === '23000') {
        $_SESSION['mensaje'] = "No es posible eliminar el docente, tiene registros dependientes.";
        $_SESSION['icono'] = "warning";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar docente, comuníquese con el administrador.";
        $_SESSION['icono'] = "error";
    }
    $_SESSION['timer'] = 6000;
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true;
}

header('Location: ' . APP_URL . "/admin/docentes/index.php");
exit;
