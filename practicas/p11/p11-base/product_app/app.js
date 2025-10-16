// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);

            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');

            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if (Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                descripcion += '<li>precio: ' + productos.precio + '</li>';
                descripcion += '<li>unidades: ' + productos.unidades + '</li>';
                descripcion += '<li>modelo: ' + productos.modelo + '</li>';
                descripcion += '<li>marca: ' + productos.marca + '</li>';
                descripcion += '<li>detalles: ' + productos.detalles + '</li>';

                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id=" + id);
}

function buscarProducto(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    //var id = document.getElementById('search').value;
    //ahora acepta un termino de busqueda y no un ID;
    var busqueda = document.getElementById('search').value;

    if (busqueda.trim() === '') {
        document.getElementById("productos").innerHTML = '<tr><td colspan="3" class="text-center">Ingrese un término de búsqueda.</td></tr>';
        return;
    }

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);

            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            let template = '';

            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if (Array.isArray(productos) && productos.length > 0) {
                // Iteramos sobre cada producto encontrado
                productos.forEach(producto => {
                    // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>Precio: ' + producto.precio + '</li>';
                    descripcion += '<li>Unidades: ' + producto.unidades + '</li>';
                    descripcion += '<li>Modelo: ' + producto.modelo + '</li>';
                    descripcion += '<li>Marca: ' + producto.marca + '</li>';
                    descripcion += '<li>Detalles: ' + producto.detalles + '</li>';

                    // SE CREA UNA PLANTILLA PARA LA FILA DEL PRODUCTO
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            } else {
                // Si no hay resultados
                document.getElementById("productos").innerHTML = '<tr><td colspan="3" class="text-center">No se encontraron productos.</td></tr>';
            }
        }
    };
    client.send("query=" + encodeURIComponent(busqueda));
}



// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    const validacion = validarDatos();
    if (!validacion.valid) {
        // Muestra los errores en un solo pop-up y detiene el proceso
        window.alert("Por favor, corrija los siguientes errores:\n\n" + validacion.errores.join("\n"));
        return; // Detiene el envío AJAX
    }

    const finalJSON = validacion.data;
    const productoJsonString = JSON.stringify(finalJSON, null, 2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");

    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            window.alert("¡Producto agregado exitosamente!");
            document.getElementById('ID_DEL_FORMULARIO').reset();
        }
    };
    client.send(productoJsonString);
}

function validarDatos() {
    // Array para almacenar los errores
    let errores = [];
    let finalData = {}; // Objeto para datos validados

    // validacion para nombre
    const nombre = document.getElementById('name').value.trim();
    if (nombre === "") {
        errores.push("El nombre del producto es requerido.");
    } else if (nombre.length > 100) {
        errores.push("El nombre no puede tener más de 100 caracteres.");
    }
    finalData.nombre = nombre;

    // -validacion y parseo del textfield
    const productoJsonString = document.getElementById('description').value.trim();
    let productoData = null;

    if (productoJsonString === "") {
        errores.push("El JSON de la descripción es requerido.");
    } else {
        try {
            // Intenta convertir la cadena de texto a un objeto JSON
            productoData = JSON.parse(productoJsonString);
        } catch (e) {
            errores.push("El formato del JSON es inválido. Asegúrese de usar comillas dobles en las claves.");
            // Si el JSON es inválido, retornamos inmediatamente con los errores
            return { valid: false, errores: errores };
        }
    }

    //validacion del json
    if (productoData) {

        // marca
        const marca = (productoData.marca || "").trim();
        if (marca === "") {
            errores.push("La marca dentro del JSON es requerida.");
        }
        finalData.marca = marca;

        // modelo
        const modelo = (productoData.modelo || "").trim();
        const modeloRegex = /^[a-zA-Z0-9\s\-]+$/;
        if (modelo === "") {
            errores.push("El modelo dentro del JSON es requerido.");
        } else if (modelo.length > 25) {
            errores.push("El modelo no puede tener más de 25 caracteres.");
        } else if (!modeloRegex.test(modelo)) {
            errores.push("El modelo solo puede contener caracteres alfanuméricos, espacios y guiones.");
        }
        finalData.modelo = modelo;

        // precio
        const precio = productoData.precio;
        const precioNumerico = parseFloat(precio);
        if (precio === undefined || precio === null || isNaN(precioNumerico)) {
            errores.push("El precio dentro del JSON es requerido y debe ser un número.");
        } else if (precioNumerico <= 99.99) {
            errores.push("El precio debe ser mayor a $99.99.");
        }
        finalData.precio = precioNumerico.toFixed(2);

        // units
        const unidades = productoData.unidades;
        const unidadesNumericas = parseInt(unidades, 10);
        if (unidades === undefined || unidades === null || isNaN(unidadesNumericas)) {
            errores.push("El número de unidades dentro del JSON es requerido y debe ser un número entero.");
        } else if (unidadesNumericas < 0) {
            errores.push("Las unidades no pueden ser un número negativo.");
        }
        finalData.unidades = unidadesNumericas;

        // datils
        const detalles = (productoData.detalles || "").trim();
        if (detalles.length > 250) {
            errores.push("Los detalles no pueden exceder los 250 caracteres.");
        }
        finalData.detalles = detalles;

        // imagen
        let imagen = (productoData.imagen || "").trim();
        if (imagen === '') {
            imagen = baseJSON.imagen; // Usa el valor por defecto
        }
        finalData.imagen = imagen;
    }

    //retornar objeto 
    if (errores.length > 0) {
        return { valid: false, errores: errores };
    } else {
        return { valid: true, data: finalData, errores: [] };
    }
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try {
        objetoAjax = new XMLHttpRequest();
    } catch (err1) {
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try {
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}