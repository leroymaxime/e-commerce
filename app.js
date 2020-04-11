/* VALIDATION FORMULAIRE CONNEXION */

// fonction pour afficher message d'erreur
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

// fonction pour valider formulaire
function validateFormConnexion() {
    // Récupération des valeurs des éléments de formulaire
    var email = document.connexionForm.email.value;
    var password = document.connexionForm.password.value;
    
	// Définition de variables d'erreur avec une valeur par défaut
    var emailErr = passwordErr = true;
 
    // Validate email address
    if(email == "") {
        printError("emailErr", "Veuillez entrer votre adresse email");
    } else {
        // Regular expression for basic email validation
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(email) === false) {
            printError("emailErr", "Veuillez entrer une adresse email valide");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }
    
    // Validate password
    if(password == "") {
        printError("passwordErr", "Veuillez entrer un mot de passe");
    } else {
        // Regular expression for basic email validation
        var regex = /^[a-z0-9]{8,}$/;
        if(regex.test(password) === false) {
            printError("passwordErr", "Votre mot de passe doit contenir des chiffres et des lettres et 8 caractères minimum");
        } else{
            printError("passwordErr", "");
            passwordErr = false;
        }
    }

    // Prevent the form from being submitted if there are any errors
    if((emailErr || passwordErr) == true) {
       return false;
    }
};


/* MENU HAMBURGER */

$(document).ready(function(){
    $(".toggle").click(function(){
      $("nav").slideToggle("slow");
    });
  });


/* ASIDE SHOP */
  $(document).ready(function(){
    $("#toggle__categories").click(function(){
      $("#categories__toggle").slideToggle("slow");
    });
  });

  $(document).ready(function(){
    $("#toggle__packaging").click(function(){
      $("#packaging__toggle").slideToggle("slow");
    });
  });


/* BOITE MODAL PRODUIT */

$(".toggle-modal").click(function(event){
    event.preventDefault();
    $(".body-overlay").toggle();
    var reqId = $(this).data("target");
    $("#"+reqId).slideDown();
  });

  $(".modal .close-button").click(function(event){
    event.preventDefault();
    $(".body-overlay").slideUp();
    $(".modal").hide();
  });
