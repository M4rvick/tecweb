// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

$(document).ready(function () {
    let edit = false;

    let JsonString = JSON.stringify(baseJSON, null, 2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function (response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);

                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if (Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: ' + producto.precio + '</li>';
                        descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                        descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                        descripcion += '<li>marca: ' + producto.marca + '</li>';
                        descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function () {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search=' + $('#search').val(),
                data: { search },
                type: 'GET',
                success: function (response) {
                    if (!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);

                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if (Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: ' + producto.precio + '</li>';
                                descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                                descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                                descripcion += '<li>marca: ' + producto.marca + '</li>';
                                descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    //validaciones on blur, para cambio en el foco
    $('#name, #price, #units, #model, #brand, #details, #image').on('blur', function () {
        let id = $(this).attr('id');
        let value = $(this).val().trim();
        let mensaje = '';
        let status = 'error';

        switch (id) {
            case 'name':
                if (value === '') {
                    mensaje = 'El nombre del producto no puede estar vacío';
                } else {
                    // Verificar si ya existe en la BD
                    $.ajax({
                        url: './backend/product-search.php?search=' + value,
                        type: 'GET',
                        success: function (response) {
                            if (!response.error) {
                                const productos = JSON.parse(response);
                                if (productos.length > 0) {
                                    let template_bar = `
                                    <li style="list-style:none;">status: error</li>
                                    <li style="list-style:none;">message: Ya existe un producto con ese nombre</li>
                                `;
                                    $('#product-result').show();
                                    $('#container').html(template_bar);
                                    $('#name').addClass('is-invalid');
                                } else {
                                    let template_bar = `
                                    <li style="list-style:none;">status: success</li>
                                    <li style="list-style:none;">message: Nombre disponible</li>
                                `;
                                    $('#product-result').show();
                                    $('#container').html(template_bar);
                                    $('#name').removeClass('is-invalid').addClass('is-valid');
                                }
                            }
                        }
                    });
                    return; // Evita doble mensaje local
                }
                break;

            case 'price':
                if (value === '' || isNaN(value) || parseFloat(value) <= 100) {
                    mensaje = 'El precio debe ser un número válido mayor que 100';
                }
                break;

            case 'units':
                if (value === '' || isNaN(value) || parseInt(value) <= 0) {
                    mensaje = 'Las unidades deben ser un número mayor a 0';
                }
                break;

            default:
                if (value === '') {
                    mensaje = 'Este campo no puede estar vacío';
                }
                break;
        }

        if (mensaje !== '') {
            let template_bar = `
            <li style="list-style:none;">status: ${status}</li>
            <li style="list-style:none;">message: ${mensaje}</li>
        `;
            $('#product-result').show();
            $('#container').html(template_bar);
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });



    $('#product-form').submit(e => {
        e.preventDefault();

        // SE CONVIERTE EL JSON DE STRING A OBJETO
        let postData = {
            nombre: $('#name').val(),
            precio: $('#price').val(),
            unidades: $('#units').val(),
            modelo: $('#model').val(),
            marca: $('#brand').val(),
            detalles: $('#details').val(),
            imagen: $('#image').val(),
            id: $('#productId').val()
        };

        /**
         * AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
         * --> EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
         **/

        // validar que no esten campos vacios
        if (postData.nombre === '' || postData.precio === '' || postData.unidades === '' ||
            postData.modelo === '' || postData.marca === '' || postData.detalles === '') {

            let template_bar = `
            <li style="list-style:none;">status: error</li>
            <li style="list-style:none;">message: Todos los campos son obligatorios</li>
        `;
            $('#product-result').show();
            $('#container').html(template_bar);
            return;
        }

        // validacion de orecio y unidades
        if (isNaN(postData.precio) || parseFloat(postData.precio) <= 0) {
            let template_bar = `
            <li style="list-style:none;">status: error</li>
            <li style="list-style:none;">message: El precio debe ser un número válido mayor que 0</li>
        `;
            $('#product-result').show();
            $('#container').html(template_bar);
            return;
        }

        if (isNaN(postData.unidades) || parseInt(postData.unidades) < 0) {
            let template_bar = `
            <li style="list-style:none;">status: error</li>
            <li style="list-style:none;">message: Las unidades deben ser un número válido</li>
        `;
            $('#product-result').show();
            $('#container').html(template_bar);
            return;
        }



        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';

        $.post(url, postData, (response) => {
            //console.log(response);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE REINICIA EL FORMULARIO
            $('#product-form')[0].reset();
            $('#productId').val('');
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', function (e) {
        if (confirm('¿Realmente deseas eliminar el producto?')) {

            const element = $(this).closest('tr');
            const id = $(element).attr('productId');

            $.post('./backend/product-delete.php', { id }, (response) => {

                let respuesta = JSON.parse(response);
                let template_bar = `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                $('#product-result').show();
                $('#container').html(template_bar);
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', { id }, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            $('#price').val(product.precio);
            $('#units').val(product.unidades);
            $('#model').val(product.modelo);
            $('#brand').val(product.marca);
            $('#details').val(product.detalles);
            $('#image').val(product.imagen);
            $('#productId').val(product.id);

            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });

    // $(document).on('click', '.product-item', (e) => {
    //     const element = $(this)[0].activeElement.parentElement.parentElement;
    //     const id = $(element).attr('productName');
    //     $.post('./backend/product-singlebyname.php', { name }, (response) => {
    //         // SE CONVIERTE A OBJETO EL JSON OBTENIDO
    //         let product = JSON.parse(response);
    //         // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
    //         $('#name').val(product.nombre);
    //         $('#price').val(product.precio);
    //         $('#units').val(product.unidades);
    //         $('#model').val(product.modelo);
    //         $('#brand').val(product.marca);
    //         $('#details').val(product.detalles);
    //         $('#image').val(product.imagen);
    //         $('#productId').val(product.id);

    //         // SE PONE LA BANDERA DE EDICIÓN EN true
    //         edit = true;
    //     });
    //     e.preventDefault();
    // });
});