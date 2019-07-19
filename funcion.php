<?php

    require "conexion.php";
    
    // RUTA DEL ARCHIVO XML
    $archivo = simplexml_load_file("/Applications/XAMPP/htdocs/PruebasCanal/empresas.xml");
    
    // BORRAMOS LA TABLA en CASO DE QUE EXISTA ANTES
    $sql_delete = "DROP TABLE empresas";
    $mysqli->query($sql_delete);
    
    // CREAMOS LA TABLA
    $sql = "CREATE TABLE empresas(idEmpresa int primary key auto_increment, nombre varchar(50), telefono varchar(15), email varchar(30))";
    
    if($mysqli->query($sql) === TRUE) {
        echo "La tabla se creo correctamente <br> <br>";
    } else {
        echo "Hubo un error al crear la tabla: " . $mysqli->error . "<br> <br>";
    }
    
    // CICLO PARA LEER EL XML E INSERTAR EN LA TABLA
    foreach($archivo as $empresa) {
        echo "DATOS DEL XML <br>";
        echo "Nombre: " . $empresa->NOMBRE . "<br>";
        echo "Telefono: " . $empresa->TELEFONO . "<br>";
        echo "Email: " . $empresa->EMAIL . "<br>";
        echo "<br>";
        
        // INSERTA LOS DATOS
        $sql_insert = "INSERT INTO empresas VALUES('', '$empresa->NOMBRE', '$empresa->TELEFONO', '$empresa->EMAIL')";
        
        if($mysqli->query($sql_insert) === TRUE) {
            echo "Se inserto correctamente la informacion <br> <br>";
        } else {
            echo "Hubo un error al insertar en la tabla: ". $mysqli->error . "<br> <br>";
        }
        
    }
    
    $mysqli->close();
    
    
?>
