

// Tableau avec les possibilités du générateur

var themes = ["Prout", "Caca" , "C'est trop nul, j'avoue"];
var ligne1 = ["Prout2", "Caca2" , "C'est trop nul, j'avoue2"];;
var ligne2 = ["Prout3", "Caca3" , "C'est trop nul, j'avoue3"];; 
var ligne3 = ["Prout", "Caca" , "C'est trop nul, j'avoue"]; 
var ligne4 = ["Prout", "Caca" , "C'est trop nul, j'avoue"]; 
var ligne5 = ["Prout", "Caca" , "C'est trop nul, j'avoue"];

    function randomJDR() {
     
      // Générer un nombre aléatoire entre 0 et la longueur du tableau
var indexAleatoireTheme = Math.floor(Math.random() * themes.length);
var indexAleatoireL1 = Math.floor(Math.random() * ligne1.length);
var indexAleatoireL2 = Math.floor(Math.random() * ligne2.length);
var indexAleatoireL3 = Math.floor(Math.random() * ligne3.length);
var indexAleatoireL4 = Math.floor(Math.random() * ligne4.length);
var indexAleatoireL5 = Math.floor(Math.random() * ligne5.length);

// Sélectionner l'entrée au hasard
var resultat = themes[indexAleatoireTheme] + "<br>" +  ligne1[indexAleatoireL1] + "<br>" + ligne2[indexAleatoireL2] + "<br>" + ligne3[indexAleatoireL3]+ "<br>" + ligne4[indexAleatoireL4]+ "<br>" + ligne5[indexAleatoireL5];

    
      $('#resultat').html(resultat);
    }
  
    









  