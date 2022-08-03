<?php

    require_once("conexion.php");

    $ConsultaProduc = "SELECT * FROM producto";
    $ConsultaPro = mysqli_query($con, $ConsultaProduc);

    $id = mysqli_real_escape_string ($con, $_POST["clave"]);
    $nombre = mysqli_real_escape_string ($con, $_POST["nombre_cliente"]);
    $fono = mysqli_real_escape_string ($con, $_POST["fono_cliente"]);
    $rut = mysqli_real_escape_string ($con, $_POST["rut"]);
    $correo = mysqli_real_escape_string ($con, $_POST["email"]);       
    $fecha = mysqli_real_escape_string ($con, $_POST["fecha"]);
    
    while($row = mysqli_fetch_array($ConsultaPro)){
        
        if($row['id'] == $id){

            $stock = $row['stock'];

            if($stock > 0){

                $CrearReserva="INSERT INTO reserva (nombre_cliente, rut, num_cliente, email, fecha_arriendo, id_status) VALUES
                ('".$nombre."', '".$rut."', '".$fono."', '".$correo."', '".$fecha."', 1);";

                $CrearReservaSQL="INSERT INTO se_puede (id) VALUES
                ('".$id."');";

                $stoc = "UPDATE producto set stock='".$stock."'-1 WHERE id='".$id."'";

                mysqli_query($con, $stoc);
                mysqli_query($con, $CrearReserva);
                mysqli_query($con, $CrearReservaSQL);    

                unset($_POST["clave"]);
                unset($_POST["nombre_cliente"]);
                unset($_POST["rut"]);
                unset($_POST["fono_cliente"]);
                unset($_POST["email"]);
                unset($_POST["fecha"]);
                        
                echo '<script language="javascript">alert("La reserva se ha guardado exitosamente");window.location.href="../agendarReserva.php"</script>';

            }

        }
        
    }

    echo '<script language="javascript">alert("El producto para reservar no está disponible");window.location.href="../agendarReserva.php"</script>';
    
?>