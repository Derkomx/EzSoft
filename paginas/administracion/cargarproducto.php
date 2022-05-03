<link rel="stylesheet" href="./CSS/solid.min.css" />
<link rel="stylesheet" href="./CSS/style.css">
<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="media/logo.png" alt="Ez - Soft" height="60" width="60">
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Nota:</h5>
                    Completa los datos para poder visualizar correctamente su producto.
                </div>
            </div>
        </div>
    </div>

</section>
<div class="login-page">
    <div class="form">
        <h2 aligncenter>Nuevo Producto</h2>
        <div class="input-group mb-0">
            <input id="codigo" name="codigo" type="text" placeholder="Codigo de barra" autocomplete="off"
                class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <label>Quieres agregar una imagen?</label></br>
        <div id="btnImagenes" class="mt-1 text-center">
            <!-- <button type="submit" class="btn btn-warning mt-1" onclick="AceptarUsuario()"><i class="fas fa-images"></i> Seleccionar desde galería</button> -->
            <button type="submit" class="btn btn-warning mt-1" onclick="CargarImagen()"><i
                    class="fas fa-file-upload"></i> Cargar imagen</button>

            <div class="col-md-7 mx-auto mt-3">
                <img style="display: block; max-width: 100%; height: auto;" id="imgFinal" />
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="titulo" name="titulo" type="text" placeholder="Nombre del Producto" autocomplete="off"
                class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="precio" name="precio" type="text" placeholder="Precio sin $" autocomplete="off"
                class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-0">
            <input id="stock" name="stock" type="text" placeholder="Stock" autocomplete="off"
                class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
        </div>

        <button type="submit" onclick="aceptar()">Aceptar</button>
    </div>
</div>
<script>
function aceptar() {
    // Se obtienen los datos
    var imagen = document.getElementById("imgFinal").src;
    var codigo = document.getElementById("codigo").value;
    var titulo = document.getElementById("titulo").value;
    var precio = document.getElementById("precio").value;
    var stock = document.getElementById("stock").value;

    // Si no escribió se notifica
    if (titulo.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar un Nombre!");
        return;
    }
    // Si no escribió se notifica
    if (precio.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar una Direccion!");
        return;
    }
    // Si no escribió se notifica
    if (codigo.length == 0) {
        codigo = 0;
        
    }
    if (stock.length == 0){
        stock = 0;
    }

    Notiflix.Loading.Circle('Cargando...');
    var theJSON = {
        Archivo: 'nuevoproducto.php',
        Tipo: 'nuevo',
        titulo: titulo,
        imagen: imagen,
        precio: precio,
        codigo: codigo,
        stock: stock
    };
    //console.log(imagen);
    //console.log(codigo);
    //console.log(titulo);
    //console.log(precio);
    uploadJSON(theJSON);
}

function uploadJSON(theJSON) {
    var str = JSON.stringify(theJSON);
    var blob;
    var reader = new FileReader();
    var oMyBlob = new Blob([str], {
        type: 'application/json'
    });
    reader.readAsArrayBuffer(oMyBlob);
    reader.onloadend = function(evt) {
        xhr = new XMLHttpRequest();
        xhr.open("POST", "Inyector.php", true);

        XMLHttpRequest.prototype.mySendAsBinary = function(text) {
            var ui8a = new Uint8Array(new Int8Array(text));
            if (typeof window.Blob == "function") {
                blob = new Blob([ui8a]);
            } else {
                var bb = new(window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder)();
                bb.append(ui8a);
                blob = bb.getBlob();
            }
            this.send(blob);
        }

        var eventSource = xhr.upload || xhr;
        eventSource.addEventListener("progress", function(e) {
            var position = e.position || e.loaded;
            var total = e.totalSize || e.total;
            var percentage = Math.round((position / total) * 100);

            document.getElementById("NotiflixLoadingMessage").textContent = "Cargando producto... " +
                percentage + "%";

            if (percentage == 100) {
                document.getElementById("NotiflixLoadingMessage").textContent =
                    "Creando el producto, espere...";
            }
        });

        xhr.addEventListener('error', function() {
            Notiflix.Loading.Remove();
            Notiflix.Notify.Failure("¡Ocurrió un error al cargar el producto!");
            return;
        });

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var Resultado = JSON.parse(this.responseText);
                Notiflix.Loading.Remove();

                if (Resultado.error) {
                    Notiflix.Report.Failure(
                        '¡Error!',
                        Resultado.error,
                        'Aceptar'
                    );

                    return;
                }

                if (Resultado.success) {
                    Notiflix.Report.Success(
                        '¡Éxito!',
                        'El producto fue creado correctamente.',
                        'Aceptar',
                        function() {
                            window.location.reload();
                        }
                    );
                    return;
                }
            }
        };

        xhr.mySendAsBinary(evt.target.result);
    };
}
</script>
<script>
// Variables
var Resultado = null;

// Coloca la imagen ya recortada y editada en su respectiva posición
function AceptarImagen() {
    var croppedimage = Cropp.getCroppedCanvas().toDataURL("image/jpeg");

    Swal.close()

    var htmlImg = document.getElementById("imgFinal");
    htmlImg.src = croppedimage;
}

function EditarImagen(URL) {
    // Ejecuta el SweetAlert
    Swal.fire({
        title: 'Recortar y editar imagen',
        html: '<div class="dropdown-divider"></div>' +
            '<img id="editorIMG" style="display: block; max-width: 100%; height: auto;" src="' + URL +
            '"><br>' +
            '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar">' +
            '<div class="wrapper text-center mx-auto">' +
            '<div class="btn-group mr-2 mb-1" role="group" aria-label="Zoom">' +
            '<button type="button" class="btn btn-info" onclick="Cropp.zoom(-0.1)"><i class="fas fa-search-minus"></i></button>' +
            '<button type="button" class="btn btn-info" onclick="Cropp.zoom(0.1)"><i class="fas fa-search-plus"></i></button>' +
            '</div>' +
            '<div class="btn-group mr-2 mb-1" role="group" aria-label="Mover">' +
            '<button type="button" class="btn btn-info" onclick="Cropp.move(-3, 0)"><i class="fas fa-arrow-left"></i></button>' +
            '<button type="button" class="btn btn-info" onclick="Cropp.move(3, 0)"><i class="fas fa-arrow-right"></i></button>' +
            '<button type="button" class="btn btn-info" onclick="Cropp.move(0, 3)"><i class="fas fa-arrow-down"></i></button>' +
            '<button type="button" class="btn btn-info" onclick="Cropp.move(0, -3)"><i class="fas fa-arrow-up"></i></button>' +
            '</div>' +
            '<div class="btn-group mr-2 mb-1" role="group" aria-label="Rotar">' +
            '<button type="button" class="btn btn-info" onclick="Cropp.rotate(-45)"><i class="fas fa-undo"></i></button>' +
            '<button type="button" class="btn btn-info" onclick="Cropp.rotate(45)"><i class="fas fa-redo"></i></button>' +
            '</div>' +
            '<div class="btn-group mr-2 mb-1" role="group" aria-label="Aceptar">' +
            '<button type="button" class="btn btn-success" onclick="AceptarImagen()">Aceptar</button>' +
            '</div>' +
            '</div>' +
            '</div>',
        width: 800,
        showCloseButton: true,
        allowOutsideClick: false,
        showConfirmButton: false
    })

    Cropp = new Cropper(document.getElementById('editorIMG'), {
        aspectRatio: 1.3 / 1,
        guides: false,
        zoomable: true,
        scalable: false,
        zoomOnTouch: false,
        zoomOnWheel: false,
        movable: true,
        crop(event) {
            //console.log(event.detail.x);
            //console.log(event.detail.y);
            //console.log(event.detail.width);
            //console.log(event.detail.height);
            //console.log(event.detail.rotate);
            //console.log(event.detail.scaleX);
            //console.log(event.detail.scaleY);
        },
    });
}

// Carga la imagen desde un archivo
function CargarArchivo() {
    // Se obtiene el archivo
    var Archivo = document.getElementById("InputIMG");

    // Se chequea si el usuario cargó el archivo
    if (Archivo.value.length > 0) {
        const Imagen = Archivo.files[0];

        const reader = new FileReader();
        reader.addEventListener('load', event => {
            Resultado = event.target.result;

            EditarImagen(Resultado);
        });

        reader.readAsDataURL(Imagen);
    }
}

// Cargar la imagen desde URL
function CargarURL() {
    // Se obtiene el archivo
    var URL = document.getElementById("InputURL").value;

    if (URL.length == 0) {
        Notiflix.Notify.Failure("¡Debes ingresar una URL!");
        return;
    } else {
        // Activa la pantalla de carga
        Notiflix.Loading.Pulse('Obteniendo imagen...');

        // Crea una nueva imagen
        var imgCheck = new Image();

        // Chequea si la imagen se carga correctamente
        imgCheck.onload = function() {
            Notiflix.Loading.Remove();

            EditarImagen(URL);
        };

        // Chequea si la imagen no pudo ser cargada
        imgCheck.onerror = function() {
            Notiflix.Loading.Remove();
            Notiflix.Notify.Failure("¡Ocurrió un error o la URL es inválida!");
        };

        // Intenta cargar la imagen desde la URL ingresada
        imgCheck.src = URL;
    }
}

// Función del botón "Cargar imagen"
// Crea un formulario para cargar dicha imagen desde URL o archivo
function CargarImagen() {
    // Ejecuta el SweetAlert
    Swal.fire({
        title: 'Cargar imagen',
        html: '<div class="dropdown-divider"></div>' +
            '<br><p class="text-center font-weight-bold">Desde archivo</p>' +
            '<input id="InputIMG" type="file" accept="image/x-png,image/gif,image/jpeg" onchange="CargarArchivo()"><br><br>' +
            '<p class="text-center font-weight-bold">Desde URL</p>' +
            '<div class="input-group mb-3">' +
            '<input id="InputURL" type="text" class="form-control" placeholder="Insertar URL" aria-label="Insertar URL" aria-describedby="button-addon2">' +
            '<div class="input-group-append">' +
            '<button class="btn btn-info" type="button" onclick="CargarURL()" id="button-addon2">Cargar</button>' +
            '</div>' +
            '</div>',
        showCloseButton: true,
        allowOutsideClick: false,
        confirmButtonText: 'Cerrar',
    })
}
</script>