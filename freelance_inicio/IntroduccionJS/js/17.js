const metodoPago = 'cryptos';

switch(metodoPago){
    case 'tarjeta':
        console.log("tarjeta");
        break;
    case 'efectivo':
        console.log("efectivo");
        break;
    default:
        console.log("nel pastel");
        break;
}