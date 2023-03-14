

    function randomJDR() {
     
      // Générer un nombre aléatoire entre 0 et la longueur du tableau
var indexAleatoireTheme = Math.floor(Math.random() * themes.length);
var indexAleatoireL1 = Math.floor(Math.random() * ligne1.length);
var indexAleatoireL2 = Math.floor(Math.random() * ligne2.length);
var indexAleatoireL3 = Math.floor(Math.random() * ligne3.length);
var indexAleatoireL4 = Math.floor(Math.random() * ligne4.length);
var indexAleatoireL5 = Math.floor(Math.random() * ligne5.length);

let nombreThemeChiffre = themes.length * ligne1.length * ligne2.length *  ligne3.length * ligne4.length * ligne5.length;
let nombreTheme = "Avec une chance de 1 contre " + nombreThemeChiffre + ".";
let allTheme = '';
let allL1= '';
let allL2= '';
let allL3= '';
let allL4= '';
let allL5= '';

themes.forEach(function(element) {
  allTheme += element + ' / ';
});

ligne1.forEach(function(element) {
  allL1 += element + ' / ';
});

ligne2.forEach(function(element) {
  allL2 += element + ' / ';
});

ligne3.forEach(function(element) {
  allL3 += element + ' / ';
});

ligne4.forEach(function(element) {
  allL4 += element + ' / ';
});

ligne5.forEach(function(element) {
  allL5 += element + ' / ';
});

let allTotal = allL1 + '<br><hr>' + allL2 + '<br><hr>' + allL3 + '<br><hr>' + allL4 + '<br><hr>' + allL5;

//<p id="resultatAll"></p>


// Sélectionner l'entrée au hasard
var resultatTheme = themes[indexAleatoireTheme];
var resultat = ligne1[indexAleatoireL1] + "<br>" + ligne2[indexAleatoireL2] + "<br>" + ligne3[indexAleatoireL3]+ "<br>" + ligne4[indexAleatoireL4]+ "<br>" + ligne5[indexAleatoireL5];

  

      $('#resultat').html(resultat);
      $('#resultatTheme').html(resultatTheme);

      $('#resultatThemeAll').html(allTheme);
      $('#resultatAll').html(allTotal);
      $('#total').html(nombreTheme);

    }
  
   











  