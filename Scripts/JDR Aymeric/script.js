

    function randomJDR() {
     
      // Générer un nombre aléatoire entre 0 et la longueur du tableau
var indexAleatoireTheme = Math.floor(Math.random() * themes.length);
var indexAleatoireL1 = Math.floor(Math.random() * ligne1.length);
var indexAleatoireL2 = Math.floor(Math.random() * ligne2.length);
var indexAleatoireL3 = Math.floor(Math.random() * ligne3.length);
var indexAleatoireL4 = Math.floor(Math.random() * ligne4.length);
var indexAleatoireL5 = Math.floor(Math.random() * ligne5.length);

// Sélectionner l'entrée au hasard
var resultatTheme = themes[indexAleatoireTheme];
var resultat = ligne1[indexAleatoireL1] + "<br>" + ligne2[indexAleatoireL2] + "<br>" + ligne3[indexAleatoireL3]+ "<br>" + ligne4[indexAleatoireL4]+ "<br>" + ligne5[indexAleatoireL5];

    
      $('#resultat').html(resultat);
      $('#resultatTheme').html(resultatTheme);

    }
  
    









  