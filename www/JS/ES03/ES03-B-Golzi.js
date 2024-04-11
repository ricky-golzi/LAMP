let libro = {};
libro.titolo = prompt("inserire il titolo");
libro.autore = prompt("inserire il nome dell\'autore");
libro.anno = prompt("inserire l\'anno di pubblicazione");
libro.genere = prompt("inserire il genere");
libro.np = prompt("inserire il numero di pagine");

for (let key in libro) 
{
     console.log(`${key} -> ${libro[key]}`);
}