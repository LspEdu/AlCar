import './bootstrap';

import Alpine from 'alpinejs';

import flatpickr from "flatpickr";


window.Alpine = Alpine;

Alpine.start();


// Formulario Registrar

let form = document.getElementById('registrar');



form.addEventListener('submit', (e) => {
    e.preventDefault();
    let inputs = document.querySelectorAll('input'),
        errores = false,
        errorInputs = document.querySelectorAll('.error');
        console.log(errorInputs);


    checkMayorEdad(inputs[6].value,errorInputs[6], errores);



    if (!errores) form.submit();

});

function checkMayorEdad(edad, campo, errores) {
    var fechaNacimiento = edad;
    var fechaActual = new Date().toISOString().split('T')[0];

    var edad = new Date(fechaActual) - new Date(fechaNacimiento);
    edad = Math.floor(edad / (365.25 * 24 * 60 * 60 * 1000));

    if (edad < 18){
        campo.textContent = 'Esta fecha significa que eres menor de Edad, por lo tanto no puedes conducir. Vuelve cuando cumplas 18 y obtengas tu carnet';
        errores = true;
    }
    else campo.textContent = ''


}
