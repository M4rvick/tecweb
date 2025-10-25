// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

let edit = false;
let currentId = null;


function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
    listarProductos();
}

//buscar producto
$('#search').keyup(function (e) {
    let search = $('#search').val();
    $.ajax({
        url: 'backend/product-search.php',
        type: 'GET',
        data: { search: search },
        success: function (response) {
            let template = '';
            console.log(response);
            let productos = [];
            try {
                productos = JSON.parse(response);
            } catch (err) {
                console.error("Error al parsear JSON:", err, response);
                return;
            }

            if (productos.length > 0) {
                productos.forEach(prod => {
                    let descripcion = '';
                    descripcion += '<li>precio: ' + prod.precio + '</li>';
                    descripcion += '<li>unidades: ' + prod.unidades + '</li>';
                    descripcion += '<li>modelo: ' + prod.modelo + '</li>';
                    descripcion += '<li>marca: ' + prod.marca + '</li>';
                    descripcion += '<li>detalles: ' + prod.detalles + '</li>';

                    template += `
                        <tr productId="${prod.id}">
                            <td>${prod.id}</td>
                            <td>${prod.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                template = `
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            No se encontraron productos
                        </td>
                    </tr>
                `;
            }
            // Insertar resultados en el DOM
            $('#products').html(template);
        },
        error: function (error) {
            console.error("Error en AJAX:", error);
        }
    });
});


//listar productos
function listarProductos() {
    $.ajax({
        url: 'backend/product-list.php',
        type: 'POST',
        success: function (response) {
            let products = JSON.parse(response);
            let template = '';
            products.forEach(prod => {
                let descripcion = '';
                descripcion += '<li>precio: ' + prod.precio + '</li>';
                descripcion += '<li>unidades: ' + prod.unidades + '</li>';
                descripcion += '<li>modelo: ' + prod.modelo + '</li>';
                descripcion += '<li>marca: ' + prod.marca + '</li>';
                descripcion += '<li>detalles: ' + prod.detalles + '</li>';

                // <td>${prod.nombre}</td>
                template += `
                        <tr productId="${prod.id}">
                            <td>${prod.id}</td>
                            <td><a href='#' class = "product-item">${prod.nombre}</a></td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
            });

            $('#products').html(template);
        },
        error: function (error) {
            console.error("Error al cargar productos:", error);
        }
    });
}

//edit product
$(document).on('click', '.product-item', function () {
    edit = true;
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('productId');
    currentId = $(element).attr('productId');

    $.get('backend/product-single.php', { id }, function (response) {
        try {
            const product = JSON.parse(response);
            console.log("Producto en formato JSON:", product);
            $('#name').val(product.name);
            const { name, ...desc } = product;
            $('#description').val(JSON.stringify(desc, null, 2));
        } catch (error) {
            console.error("Error al parsear JSON:", response);
        }
    });
});




//add producto
$('#product-form').submit(function (e) {
    e.preventDefault();

    let urld = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';

    console.log("agregando producto");

    const name = $('#name').val().trim();
    const descriptionText = $('#description').val().trim();

    // Validar campos mínimos
    if (name === "" || descriptionText === "") {
        alert("Por favor completa todos los campos antes de continuar.");
        return;
    }

    //parsing
    let productData;
    try {
        productData = JSON.parse(descriptionText);
    } catch (error) {
        alert("El JSON de producto no es válido.");
        console.error(error);
        return;
    }

    productData.nombre = name;
    if (edit) productData.id = currentId;

    $.ajax({
        url: urld,
        type: 'POST',
        data: JSON.stringify(productData), // Enviamos el JSON como string
        contentType: 'application/json',
        success: function (response) {
            console.log("Respuesta del servidor:", response);
            let res;
            try {
                res = JSON.parse(response);
            } catch (err) {
                console.error("Respuesta no válida:", err);
                return;
            }

            if (res.status === "success") {
                alert(res.message);
                $('#product-form').trigger('reset');
                $('#description').val(JSON.stringify(baseJSON, null, 2)); // restaurar JSON base
                listarProductos();
            } else {
                alert(res.message);
            }
        },
        error: function (error) {
            console.error("Error AJAX:", error);
            alert("Ocurrió un error al agregar el producto.");
        }
    });
    edit = false;
});


//eliminar producto
$(document).on('click', '.product-delete', function () {
    let element = $(this).closest('tr'); // Fila del botón
    let id = element.attr('productId');  // Obtener el ID

    //confirmacion de eliminacion
    if (confirm("¿Estás seguro de eliminar este producto?")) {
        console.log("Eliminar producto con ID:", id);
        $.get('backend/product-delete.php', { id }, function (response) {
            console.log(response);
            let res = JSON.parse(response);
            if (res.status === "success") {
                alert("Producto eliminado correctamente");
                listarProductos(); // recarga la tabla
            } else {
                alert("Error:" + res.message);
            }
            listarProductos();
        });
    }


});


