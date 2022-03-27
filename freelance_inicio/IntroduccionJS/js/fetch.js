function obtenerEmpleados(){

    // fetch('empleados.json')
    //     .then( resultado => resultado.json())
    //     .then( datos => {
    //         console.log(datos);
    //     })
const resultado = await fetch('./empleados.json');
}

obtenerEmpleados();