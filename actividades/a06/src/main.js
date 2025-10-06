
function getDatos() {
    var nombre = prompt("Nombre: ", " ");

    var edad = prompt("Edad: ", 0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3> Nombre: ' + nombre + '</h3>';

    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3> Edad: ' + edad + '</h3>';
}

function holaMundo() {
    document.getElementById('mensaje').innerText = "Hola mundo!";
}

function datosPersona() {
    var nombre = "Juan";
    var edad = 10;
    var altura = 1.92;
    var casado = false;

    var datos = `
    <p> 
        Nombre: ${nombre}<br/>
        Edad: ${edad}<br/>
        Altura: ${altura}<br/>
        Casado: ${casado}
    <p/>`;

    document.getElementById("juan").innerHTML = datos;
}

function mensajePersona() {
    var nombre = prompt("Nombre: ", " ");
    var edad = prompt("Edad: ", 0);

    var datos = `
    <p> 
        Hola ${nombre}, asi que tienes ${edad}
    <p/>`;

    document.getElementById("datos").innerHTML = datos;
}

function sumayProducto() {
    var valor1;
    var valor2;
    valor1 = prompt("Introducir primer número:", " ");
    valor2 = prompt("Introducir segundo número", " ");
    var suma = parseInt(valor1) + parseInt(valor2);
    var producto = parseInt(valor1) * parseInt(valor2);

    var resultados = `
    <p> 
        La suma es ${suma} <br>
        El producto es ${producto} <br>
    <p/>`;

    document.getElementById("resultados").innerHTML = resultados;
}

function nota() {
    var nombre;
    var nota;
    nombre = prompt("Ingresa tu nombre:", " ");
    nota = prompt("Ingresa tu nota:", " ");
    if (nota >= 4) {
        document.getElementById('nota').innerHTML = nombre + " esta aprobado con un " + nota;
    }
}

function numeroMayor() {
    var num1, num2;
    num1 = prompt("Ingresa el primer número:", " ");
    num2 = prompt("Ingresa el segundo número:", " ");
    num1 = parseInt(num1);
    num2 = parseInt(num2);
    if (num1 > num2) {
        document.getElementById('mayor').innerHTML = "el mayor es " + num1;
    }
    else {
        document.getElementById('mayor').innerHTML = "El mayor es " + num2;
    }
}

function calificacion() {

    var nota1 = prompt("Ingresa la primera nota: ", " ");
    var nota2 = prompt("Ingresa la segunda nota: ", " ");
    var nota3 = prompt("Ingresa la tercera nota: ", " ");

    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    var promedio = (nota1 + nota2 + nota3) / 3;

    if (promedio > 7) {
        document.getElementById('promedio').innerHTML = "Aprobado";
    }
    else {
        if (promedio >= 4) {
            document.getElementById('promedio').innerHTML = "regular";
        }
        else {
            document.getElementById('promedio').innerHTML = "reprobado";
        }
    }
}

function leerValor() {
    var valor = prompt("ingresa un valor entre 1 y 5: ", " ");
    valor = parseInt;
    switch (valor) {
        case 1:
            document.getElementById('valor').innerHTML = "uno";
            break;
        case 2:
            document.getElementById('valor').innerHTML = "dos";
            break;
        case 3:
            document.getElementById('valor').innerHTML = "tres";
            break;
        case 4:
            document.getElementById('valor').innerHTML = "cuatro";
            break;
        case 5:
            document.getElementById('valor').innerHTML = "cinco";
            break;
        default:
            document.getElementById('valor').innerHTML = "Debe ingresar un numero entre 1 y 5.";
            break;
    }
}

function color() {
    var color = prompt("Ingresa un color con el que quiera pintar el fondo de la ventana (rojo, verde, azul)", " ")
    switch (color) {
        //cambie a funciones que no usan el deprecated :)
        case "rojo": document.body.style.backgroundColor = "red";
            break;
        case "verde": document.body.style.backgroundColor = "green";
            break;
        case "azul": document.body.style.backgroundColor = "blue";
            break;
        default: document.body.style.backgroundColor = "white";
            break;
    }
    document.getElementById('color').innerHTML = "color elegido: " + color;
}

function generarNumeros() {
    var x = 1;
    var resultado = "";
    while (x <= 100) {
        resultado += x + "<br>";
        x = x + 1;
    }
    document.getElementById("lista").innerHTML = resultado;
}

function sumatoria() {
    var x = 1;
    var suma = 0;
    var valor;
    while (x <= 5) {
        valor = prompt("Ingresa el valor:", " ");
        valor = parseInt(valor);
        suma = suma + valor;
        x = x + 1;
    }
    document.getElementById("suma").innerHTML = "La suma de los valores es " + suma;
}

function digitos() {
    var valor;
    var resultado = " ";
    do {
        valor = prompt("Ingresa un valor entre 0 y 999, 0 para finalizar:", " ");
        valor = parseInt(valor);
        if (valor < 10)
            resultado += "El valor " + valor + " tiene 1 dígito<br>";
        else
            if (valor < 100) {
                resultado += "El valor " + valor + " tiene 2 dígitos<br>";
            }
            else {
                resultado += "El valor " + valor + " tiene 3 dígitos<br>";
            }
        document.getElementById("digitos").innerHTML = resultado;
    } while (valor != 0);
}

function onetoTen() {
    var f;
    var resultado = "";
    for (f = 1; f <= 10; f++) {
        resultado += f + "<br>";
    }
    document.getElementById("nums").innerHTML = resultado;
}

function mensajes() {
    var mensajes = `
        <p>
        Cuidado <br/>
        Ingresa tu documento correctamente <br/>
        Cuidado <br/>
        Ingresa tu documento correctamente <br/>
        Cuidado <br/>
        Ingresa tu documento correctamente <br/>
        <p/>`;

    document.getElementById("mensajes").innerHTML = mensajes;
}

function mensajesf() {

    var mensajes = `
        <p>
        Cuidado <br/>
        Ingresa tu documento correctamente <br/>
        <p/>`;

    document.getElementById("mensajesf").innerHTML = mensajes;
}

function medios(x, y) {
    var inicio;
    var numeros = "";
    for (inicio = x; inicio <= y; inicio++) {
        numeros += inicio + " ";
    }
    document.getElementById("medios").innerHTML = numeros;
}


function retornoValor(x) {
    if (x == 1)
        return "uno";
    else
        if (x == 2)
            return "dos";
        else
            if (x == 3)
                return "tres";
            else
                if (x == 4)
                    return "cuatro";
                else
                    if (x == 5)
                        return "cinco";
                    else
                        return "valor incorrecto";
}

function retornoValorB(x) {
    switch (x) {
        case 1: return "uno";
        case 2: return "dos";
        case 3: return "tres";
        case 4: return "cuatro";
        case 5: return "cinco";
        default: return "valor incorrecto";
    }
}