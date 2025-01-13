function mostrarFormulario(event) {
    var formularioEmergente = document.getElementById("formularioEmergente");
    formularioEmergente.style.display = "block";
}

function ocultarFormulario() {
    var formularioEmergente = document.getElementById("formularioEmergente");
    formularioEmergente.style.display = "none";
}

var enlacesMostrarFormulario = document.querySelectorAll("#mostrarFormulario");
enlacesMostrarFormulario.forEach(function (enlace) {
    enlace.addEventListener("click", mostrarFormulario);
});

document.addEventListener('DOMContentLoaded', function () {
    const inputFields = document.querySelectorAll('.container-rigth__input input');

    inputFields.forEach(function (input) {
        const originalPlaceholder = input.placeholder;

        input.addEventListener('focus', function () {
            if (this.placeholder !== '') {
                this.value = this.placeholder;
                this.placeholder = '';
            }
        });

        input.addEventListener('blur', function () {
            if (this.value === '') {
                this.placeholder = originalPlaceholder;
            }
        });
    });
});