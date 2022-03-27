function descargarNuevosClientes(){
    return new Promise(resolve => {
        console.log("Descargando clientes... await...");

        setTimeout( () => {
            resolve("Los clientes fueron descargados");
        },5000)
    });
}

function descargarNuevosClientes2(){
    return new Promise(resolve => {
        console.log("Descargando clientes... await...");

        setTimeout( () => {
            resolve("Los clientes fueron descargados");
        },3000)
    });
}

async function app(){
    try {
        // const resultado = await descargarNuevosClientes();
        // console.log("No se espera");
        // console.log(resultado);
        const resultado = await Promise.all([descargarNuevosClientes(),descargarNuevosClientes2()]);
        console.log(resultado[0]);
        console.log(resultado[1]);
    } catch (error) {
        console.log(error);
        
    }
}

app();