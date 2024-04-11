let n1 = prompt('inserire il primo numero:');
let n2 = prompt('inserire il secondo numero:');
let operazione = prompt ('inserire l\'operazione che si vuole fare (+,-,*,/):');
let risultato;

//trasformo le stringhe in numeri
n1= Number(n1);
n2= Number(n2);

if(Number.isNaN(n1) || Number.isNaN(n2))
{
    console.log('i valori inseriti non sono numeri, inserire valori validi');
}
else
{
    switch(operazione)
    {
        case '+':
            risultato = n1+n2;
        break;

        case '-':
            risultato = n1-n2;
        break;

        case '*':
            risultato = n1*n2;
        break;

        case '/':
            if(n2!==0)
            {
                risultato = n1/n2;
            }
            else
            {
                console.log('Errore!!, non si può dividere per 0');
            }
        break;
    }

    if(risultato != undefined)
    {
        console.log('Il risultato dell\'operazione è:', risultato);
    }
}