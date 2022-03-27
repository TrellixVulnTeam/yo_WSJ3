const usuarioAutenticado = new Promise( (resolve,reject) =>{
    const auth = false;

    if(auth){
        resolve("User identified");
    }
    else{
        reject("Cant log");
    }
})

usuarioAutenticado
.then((resultado) =>   console.log("desde el promise: "+resultado))
.catch(error =>  console.log("desde el promise: "+error)
)


//PENDING
//FULLFILLED 
//REJECTR