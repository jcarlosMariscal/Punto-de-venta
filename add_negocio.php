<?php
  include "view/config/Connection.php";
  $cnx = Connection::connectDB();

  $sql = "SELECT * from tipo_negocio";
  $query = $cnx->prepare($sql);
  $query->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200&family=Hind+Siliguri:wght@300&family=Montserrat:ital,wght@1,300&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Nova Tech PV</title>
</head>
<body class="body-login">
    <div class="container">

        <div class="progress-bar">
            <div class="paso">
                <div class="num">
                    <span>1</span>
                </div>
                <div class="check fa fa-check"></div>
            </div>
            <div class="paso">
                <div class="num">
                    <span>2</span>
                </div>
                <div class="check fa fa-check"></div>
            </div>
            <div class="paso">
                <div class="num">
                    <span>3</span>
                </div>
                <div class="check fa fa-check"></div>
            </div>
            <div class="paso">
                <div class="num">
                    <span>4</span>
                </div>
                <div class="check fa fa-check"></div>
            </div>
            <!-- <div class="paso">
                <div class="num">
                    <span>5</span>
                </div>
                <div class="check fa fa-check"></div>
            </div> -->
        </div>
        <div class="form-princ">
            <form action="#">

                <!---   PAGINA 1  -->
                <div class="pagina movPag">
                  <br>
                    <div class="title">Agregar Información del Negocio</div>
                    <div class="campo">
                        <input type="text" id="negocio_nombre" placeholder="Nombre del Negocio">
                    </div>
                    <div class="campo select">
                      <!-- <label for="negocio_tipo">Tipo de negocio: </label> -->
                      <select name="negocio_tipo" id="negocio_tipo">
                        <option disabled required selected>Seleccione tipo de negocio</option>
                        <?php
                          foreach ($query as $row) {
                            ?>
                            <option value="<?php echo $row['id_tipo']; ?>"><?php echo $row['tipo']; ?></option>
                            <?php
                          } 
                        ?>
                      </select>
                    </div>
                    <div class="campo">
                        <input type="number" id="negocio_telefono" placeholder="Teléfono">
                    </div>
                    <div class="campo">
                        <input type="email" id="negocio_correo" placeholder="Correo Electronico">
                    </div>
                    <div class="custom-input-file">
                        <input type="file" name="negocio_imagen" id="negocio_imagen" class="input-file" value="">
                        Sube tu Logo
                    </div>
                    <br>
                    <div class="campo">
                        <button id="nextDatosFiscales">Siguiente</button>
                    </div>
                </div>

                
                <!---   PAGINA 2  -->
                <div class="pagina">
                  <br>
                    <div class="title">Datos Fiscales</div>
                    <div class="campo">
                        <input type="text" id="df_nombre" placeholder="Nombre fiscal">
                    </div>
                    <div class="campo">
                        <input type="text" id="df_rfc" placeholder="R.F.C.">
                    </div>
                    <!-- <div class="campo">
                        <input type="number" id="domicilio" placeholder="Domicilio">
                    </div> -->
                    <div class="campo">
                        <input type="text" id="df_regimen" placeholder="Regimen Fiscal">
                    </div>
                    <br>
                    <div class="campo  btns">
                        <button class="pag-omitir cont">Omitir</button>
                        <button class="pag-datos sig">Siguiente</button>
                    </div>
                </div>

                <!---   PAGINA 3  -->
                <div class="pagina">
                  <br>
                  <div class="title" id="title-sucursal">Agregar Información de la Sucursal</div>
                    <div class="campo">
                        <input type="text" id="sucursal_nombre" placeholder="Nombre">
                        <input type="text" id="sucursal_estado" placeholder="Estado">
                    </div>
                    <div class="campo">
                        <input type="text" id="sucursal_ciudad" placeholder="Ciudad">
                        <input type="text" id="sucursal_colonia" placeholder="Colonia">
                    </div>
                    <div class="campo">
                        <input type="text" id="sucursal_direccion" placeholder="Dirección">
                        <input type="text" id="sucursal_CP" placeholder="Código Postal">
                    </div>
                    <div class="campo">
                        <input type="number" id="sucursal_telefono" placeholder="Teléfono">
                        <input type="email" id="sucursal_correo" placeholder="Correo Electrónico">
                    </div>
                    <br>
                    <div class="campo  btns">
                        <button class="pag_nsucur cont" id="agregarNuevo">Agregar nuevo</button>
                        <button class="pag-sucur sig">Continuar</button>
                    </div>

                </div>
                  <!---   PAGINA 4  -->
                  <!-- <div class="pagina">
                    <div class="alert alert-danger" role="alert">
                       Datos Guardados Correctamente
                      </div>
                    <div class="title">Agregar Información de la Sucursal</div>
                    <div class="campo">
                        <input type="number" id="telefono" placeholder="Teléfono">
                    </div>
                    <div class="campo">
                        <input type="text" id="Direccion" placeholder="Dirección">
                    </div>
                    <div class="campo">
                        <input type="number" id="CP" placeholder="Codigo Postal">
                    </div>
                    <div class="campo">
                        <input type="text" id="correo" placeholder="Correo Electronico">
                    </div>
                    <br>
                    <div class="campo  btns">
                        <button class="pag-agr cont">Agregar nueva</button>
                        <button class="pag-comp sig">Siguiente</button>
                    </div>
                </div> -->

                <!---   PAGINA 4  -->
                <div class="pagina">
                  <br>
                    <div class="title">Agregar Administrador</div>
                    <div class="campo">
                        <input type="text" id="admin_nombre" placeholder="Nombre">
                    </div>
                    <div class="campo">
                        <input type="number" id="admin_telefono" placeholder="Teléfono">
                    </div>
                    <div class="campo">
                        <input type="text" id="admin_correo" placeholder="Correo Electronico">
                    </div>
                    <div class="campo">
                        <input type="password" id="contra" placeholder="Contraseña">
                    </div>
                    <div class="campo">
                        <input type="password" id="admin_contra" placeholder="Contraseña">
                        <!-- <span class="ver" onclick="mostrarContraseña()">
                            <i id="mostrar" class="fa fa-eye" title="Mostrar Contraseña" ></i>
                            <i id="ocultar" class="fa fa-eye-slash" title="Ocultar Contraseña" ></i>
                        </span> -->
                    </div>
                    <br>
                    <div class="campo btns">
                        <button class="fin">Finalizar</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    


    <!-- <script>
        function mostrarContraseña(){
            var x = document.getElementById("contra");
            var y = document.getElementById("ocultar");
            var z = document.getElementById("mostrar");

            if (x.type=='password'){
                x.type="text";
                y.style.display="block";
                z.style.display="none";
            }else{
                x.type="password";
                y.style.display="none";
                z.style.display="block";
            }
        }
    </script> -->

    <script src="./assets/js/movimiento.js" type="module"></script>

</body>
</html>