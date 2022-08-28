<body>

<link rel="stylesheet" href="./css/buscador.css">


<script type="text/javascript">
        function confirmDelete(){
           var respuesta = confirm("¿Estás seguro que desea eliminar este producto de la lista?");
           if(respuesta == true){
               return true;
           }
           else{
               return false;
           } 
        }
    </script>


<?php require('./header.php'); ?>
<?php require_once("./modelos/conexion.php");?>

<div class="container mt-5">

    <a id="top"></a>


        <div class="row justify-content-center">

            <div class="col-md-12 mt-3">

            <div>
                    <h2>Listado de trajes/vestidos y accesorios</h2>
                </div>

                <div class="buscar">

                <form action="./buscadorEnlistar.php" method="POST" onsubmit="return buscador();">

                    <input type="text" name="palabra" id="pal" class="src" placeholder="Escriba aquí el producto a buscar">

                </form>

                </div>
                    <h6>Buscar por rango de precios</h6>

                    <form action="buscadorPreciosEnlistar.php" method="POST">
                        <div class="input-group">
                        <span class="input-group-text">$</span>
                                <input type="number" name="min" placeholder="Ej: 15000">
                                <span class="input-group-text">-</span>
                                <input type="number" name="max" placeholder="Ej: 30000">
                                    <button type="submit" class="btn btn-light">
                                        <img height="20" width="20" src="./lmnts_grfcs/search.png">
                                    </button>
                        </div>
                            
                    </form>
                </div>

                <hr>

                <div class="resp-table">

                    <table class="table table-striped table-bordered">
                    
                        <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Título</th>
                        <th>Imagen</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Color</th>
                        <th>Talla</th>
                        <th>Género</th>
                        <th>Estado</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                        </tr>
                        
                        <tr>

                        <?php   
                        
                        if(!empty($_POST['max']) && !empty($_POST['min'])){

                        include("./modelos/enlistarTrajesBackend.php");
                        $maximo = mysqli_real_escape_string($con, strip_tags($_POST["max"]));
                        $minimo = mysqli_real_escape_string($con, strip_tags($_POST["min"]));
                        $buscarPrecios = "SELECT * FROM producto WHERE precio BETWEEN '$minimo' AND '$maximo'";
                        $buscarsql = mysqli_query($con, $buscarPrecios);

                            while($rows = mysqli_fetch_array($buscarsql)){
                                $id_traje = $rows['id'];
                                $marca = $rows['marca'];
                                $titulo = $rows['nombre'];
                                $imagen = $rows['img'];
                                $stock = $rows['stock'];
                                $precio = $rows['precio'];
                                $id_color = $rows['id_col'];
                                $id_gen = $rows['id_gen'];
                                $id_talla = $rows['id_talla'];
                                $id_cat = $rows['id_cat'];

                        ?>

                        <td><?php echo $id_traje;?></td>
                        <td><?php echo $marca;?></td>
                        <td><?php echo $titulo;?></td>
                        <td><a href="verImagen.php?id=<?php echo $id_traje ?>"><img height="80" width="80" src="data:image/*;base64,<?php echo base64_encode($imagen); ?>"></a></td>
                        <td><?php echo $stock;?></td>
                        <td>$<?php echo $precio;?></td>
                        <td>

                                <?php foreach($consultaCol as $row):?>
                                    <?php if($row['id_col'] == $id_color){?>
                                        <?php echo $row['nom_col'];?>
                                    <?php } ?> 
                                <?php endforeach?>

                        </td>
                        <td>

                            <?php foreach($consultaTal as $row):?>
                                <?php if($row['id_talla'] == $id_talla){?>
                                    <?php echo $row['nom_talla'];?>
                                <?php } ?> 
                            <?php endforeach?>

                        </td>

                        <td>

                            <?php foreach($consultaGen as $row):?>
                            <?php if($row['id_gen'] == $id_gen){?>
                                <?php echo $row['nom_gen'];?>
                            <?php } ?> 
                            <?php endforeach?>

                            </td>   

                        <td>

                                <?php if($stock >= 10){?>
                                <img src="lmnts_grfcs/verde.png" width="20" height="20">
                                Disponible 
                                <?php } ?>

                                <?php if($stock > 0 && $stock < 10 ){?>
                                <img src="lmnts_grfcs/amarillo.png" width="20" height="20">
                                Quedan pocas unidades 
                                <?php } ?>

                                <?php if($stock == 0){?>
                                <img src="lmnts_grfcs/rojo.png" width="20" height="20">
                                No disponible 
                                <?php } ?>

                        </td>

                        <td>

                            <?php foreach($consultaCat as $row):?>
                                <?php if($row['id_cat'] == $id_cat){?>
                                    <?php echo $row['nom_cat'];?>
                                <?php } ?> 
                            <?php endforeach?>

                        </td>
                        <td>
                    
                            <div class="col-1 justify-content-center align-self-center">
                                <form action="./editarProducto.php" method="POST">
                                    <div>
                                        
                                    <select class="mostrarnt" name="Prod" required>                               
                                        <option selected value="<?php echo $id_traje; ?>"></option>                                                                                  
                                    </select>

                                    <select class="mostrarnt" name="mar" required>                               
                                        <option selected value="<?php echo $marca; ?>"></option>                                                                                  
                                    </select>

                                    <select class="mostrarnt" name="tit" required>                               
                                        <option selected value="<?php echo $titulo; ?>"></option>                                                                                  
                                    </select>

                                    <select class="mostrarnt" name="ima" required>                               
                                        <option selected value="<?php echo $imagen; ?>"></option>                                                                                  
                                    </select>

                                    <select class="mostrarnt" name="sto" required>                               
                                        <option selected value="<?php echo $stock; ?>"></option>                                                                                  
                                    </select>

                                    <select class="mostrarnt" name="pre" required>                               
                                        <option selected value="<?php echo $precio; ?>"></option>                                                                                  
                                    </select>

                                    <select class="mostrarnt" name="col" required>                               
                                        <option selected value="<?php echo $id_color; ?>"></option>                                                                                  
                                    </select>

                                    <select class="mostrarnt" name="tal" required>                               
                                        <option selected value="<?php echo $id_talla; ?>"></option>                                                                                  
                                    </select>

                                    <select class="mostrarnt" name="gen" required>                               
                                        <option selected value="<?php echo $id_gen; ?>"></option>                                                                                  
                                    </select>

                                    <select class="mostrarnt" name="cat" required>                               
                                        <option selected value="<?php echo $id_cat; ?>"></option>                                                                                  
                                    </select>
                                        
                                        <button href="./editarProducto.php" type="submit" class="btn btn-success"> <img class="me-2" src="lmnts_grfcs/editar.png" width="20" height="20"></button>
                                        
                                    </div>
                                    
                                </form>
                            </div>            
                            
                            <br>        

                            <div class="col-1 justify-content-center align-self-center">
                                <form action="./modelos/eliminarProductoBackend.php" method="POST">
                                    <div>
                                        
                                    <select class="mostrarnt" name="prod" required>
                                                                
                                        <option selected value="<?php echo $id_traje; ?>"></option>
                                                                                            
                                    </select>
                                        
                                        <button class="btn btn-danger" onclick="return confirmDelete()"> <img class="me-2" src="lmnts_grfcs/eliminar.png" width="20" height="20"></button>
                                        
                                    </div>
                                    
                                </form>
                                </div>
                        
                        </td>
                        </tr>

                        <?php 
                        }}
                        ?>
                        


                    </table>

                </div>

            </div>
            
        </div>    

    </div>      
    
            <div class="d-flex justify-content-end">
                <a href="#top">
                    <img width="30" height="30" src="./lmnts_grfcs/up-arrow.png" >
                </a>
            </div>
    <script src="./js/validacionBuscador.js"></script>
</body>
<html>