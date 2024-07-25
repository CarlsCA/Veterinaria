function calcularEdad() {
    var fechaNacimiento = new Date(document.getElementById("fecha_nacimiento").value);
    var hoy = new Date();
    var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    var mes = hoy.getMonth() - fechaNacimiento.getMonth();
    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
        edad--;
    }
    document.getElementById("edad").value = edad;
}

function actualizarRaza() {
    var tipoMascota = document.getElementById("tipo_mascota").value;
    var razaSelect = document.getElementById("raza");
    var opcionesRaza = razaSelect.options;

    for (var i = 0; i < opcionesRaza.length; i++) {
        opcionesRaza[i].style.display = "none"; // Oculta todas las razas
        if (opcionesRaza[i].className === tipoMascota) {
            opcionesRaza[i].style.display = "block"; // Muestra las razas correspondientes
        }
    }
}

function agregarTipoMascota() {
    var nuevoTipo = prompt("Ingrese el nuevo tipo de mascota:");
    if (nuevoTipo) {
        var tipoSelect = document.getElementById("tipo_mascota");
        var newOption = document.createElement("option");
        newOption.value = nuevoTipo;
        newOption.text = nuevoTipo;
        tipoSelect.appendChild(newOption);

        // Crear una nueva opción en el select de raza con la nueva clase
        var razaSelect = document.getElementById("raza");
        var newRazaOption = document.createElement("option");
        newRazaOption.value = "Otro"; // O el valor que desees
        newRazaOption.text = "Otro"; // O el texto que desees
        newRazaOption.className = nuevoTipo;
        razaSelect.appendChild(newRazaOption);
    }
}
