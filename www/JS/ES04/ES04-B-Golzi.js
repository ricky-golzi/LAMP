
let numero = prompt('Inserire un numero di due cifre');
let invertito;

function inverti_cifre(num) {
    let cifreInvertite = "";
    for (let i = num.length - 1; i >= 0; i--) {
        cifreInvertite += num[i];
    }

    return cifreInvertite;
}

invertito = inverti_cifre(numero);

// Converti la stringa invertita in un numero intero
let numeroInvertito = parseInt(invertito);

console.log(`Numero iniziale: ${numero}`);
console.log(`Numero invertito: ${numeroInvertito}`);
