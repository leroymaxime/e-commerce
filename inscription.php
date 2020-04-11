<?php
// Include config file
require_once ('config.php');

if (!isset($_POST['ajax']))
include_once (ROOT_PATH ."inc/head.php");?>
<?php if(isset($_SESSION['id_user'])) {
  Header('location:index.php');
}
if (!isset($_POST['ajax']))
include_once (ROOT_PATH ."inc/navbar.php");
 
// Define variables and initialize with empty values
$param_email = "";

$nom = $prenom = $email = $password = $confirm_password = $adresse = $cp = $ville = $groupe = "";
$nom_err = $prenom_err = $email_err = $password_err = $confirm_password_err = $adresse_err = $cp_err = $ville_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $groupe = "Membre";
    
    if (!isset($_POST['ajax'])) {

        // Validate nom
        if(!isset($_POST["prenom"])) {
            $prenom_err = "Merci d'entrer votre prénom.";     
        } elseif(strlen(trim($_POST["prenom"])) < 3){
            $prenom_err = "Votre prénom doit faire 3 caractères minimum.";
        } else{
            $prenom = trim($_POST["prenom"]);
        }
    
        // Validate prenom
        if(!isset($_POST["nom"])){
            $nom_err = "Merci d'entrer votre nom.";     
        } elseif(strlen(trim($_POST["nom"])) < 3){
            $nom_err = "Votre nom doit faire 3 caractères minimum.";
        } else{
            $nom = trim($_POST["nom"]);
        }
    }

    // Validate email

    
    if(!isset($_POST["email"])){
        $email_err = "Merci d'entrer votre email.";
    } else {
            // Prepare a select statement
            if (isset($_POST['ajax']))
            require_once (ROOT_PATH ."inc/database.php");
            $sql = "SELECT id_user FROM users WHERE email_user = :email";
            
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                
                // Set parameters

                $param_email = trim($_POST["email"]);
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    if($stmt->rowCount() >= 1){
                        $email_err = "Cet email est déjà utilisé.";
                    } else{
                        $email = trim($_POST["email"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                unset($stmt);
            }
        }   
    
    if (!isset($_POST['ajax'])) {
        // Validate password
        if(!isset($_POST["password"])){
            $password_err = "Merci d'entrer un mot de passe.";     
        } elseif(strlen(trim($_POST["password"])) < 8){
            $password_err = "Votre mot de passe doit faire minimum 8 caractères.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate confirm password
        if(!isset($_POST["confirm_password"])){
            $confirm_password_err = "Merci de confirmer votre mot de passe.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Vos mots de passes ne correspondent pas.";
            }
        }

        // Validate adresse
        if(!isset($_POST["adresse"])){
            $adresse_err = "Merci d'entrer votre adresse.";     
        } elseif(strlen(trim($_POST["adresse"])) < 10){
            $adresse_err = "Votre adresse est invalide.";
        } else{
            $adresse = trim($_POST["adresse"]);
        }

        // Validate CP
        if(!isset($_POST["cp"])){
            $cp_err = "Merci d'entrer votre code postal.";     
        } elseif(is_int(trim($_POST["cp"])) == 5){
            $cp_err = "Votre code postal doit faire 5 caractères.";
        } else{
            $cp = trim($_POST["cp"]);
        }

        // Validate ville
        if(!isset($_POST["ville"])){
            $ville_err = "Merci d'entrer votre ville.";     
        } elseif(strlen(trim($_POST["ville"])) < 5){
            $ville_err = "Votre ville est invalide.";
        } else{
            $ville = trim($_POST["ville"]);
        }
    }
    
    // Check input errors before inserting in database
    if(empty($nom_err) && empty($prenom_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($adresse_err) && empty($cp_err) &&empty($ville_err)){
        
        // Prepare an insert statement
        if (!isset($_POST['ajax'])) :
            $sql = "INSERT INTO users (name_user, lastname_user, email_user, password_user, adress_user, cp_user, city_user, group_user) VALUES (:nom, :prenom, :email, :password, :adresse, :cp, :ville, :groupe)";
            
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":nom", $param_nom, PDO::PARAM_STR);
                $stmt->bindParam(":prenom", $param_prenom, PDO::PARAM_STR);
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                $stmt->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
                $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                $stmt->bindParam(":adresse", $param_adresse, PDO::PARAM_STR);
                $stmt->bindParam(":cp", $param_cp, PDO::PARAM_INT);
                $stmt->bindParam(":ville", $param_ville, PDO::PARAM_STR);
                $stmt->bindParam(":groupe", $param_groupe, PDO::PARAM_STR);
                
                // Set parameters
                $param_nom = $nom;
                $param_prenom = $prenom;
                $param_email = $email;
                $param_email = $_POST['email'];
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_adresse = $adresse;
                $param_cp = $cp;
                $param_ville = $ville;
                $param_groupe = $groupe;
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Redirect to login page
                    header("location: connexion.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }

                // Close statement
                unset($stmt);
        
        }
        endif;
    }
    
    // Close connection
    unset($pdo);
}

if (!isset($_POST['ajax'])) {
?>
<main id="formInscriptionContent"> 
<section class="formsection">
    <h2>Inscription</h2>
    <p>Merci de remplir le formulaire pour vous inscrire.</p>
        <form id="inscriptionForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <article class="formgroup <?php echo (!empty($nom_err)) ? 'has-error' : ''; ?>">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
                <span class="help-block"><?php echo $nom_err; ?></span>
            </article>

            <article class="formgroup <?php echo (!empty($prenom_err)) ? 'has-error' : ''; ?>">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>">
                <span class="help-block"><?php echo $prenom_err; ?></span>
            </article>
<?php } ?>
            <article id="emailSubscribeForm" class="formgroup <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </article>   
<?php if (!isset($_POST['ajax'])) {?>
            <article class="formgroup <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </article>

            <article class="formgroup <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmer votre mot de passe</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </article>

            <article class="formgroup <?php echo (!empty($adresse_err)) ? 'has-error' : ''; ?>">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control" value="<?php echo $adresse; ?>">
                <span class="help-block"><?php echo $adresse_err; ?></span>
            </article>

            <article class="formgroup <?php echo (!empty($cp_err)) ? 'has-error' : ''; ?>">
                <label>Code postal</label>
                <input type="text" name="cp" class="form-control" value="<?php echo $cp; ?>">
                <span class="help-block"><?php echo $cp_err; ?></span>
            </article>

            <article class="formgroup <?php echo (!empty($ville_err)) ? 'has-error' : ''; ?>">
                <label>Ville</label>
                <input type="text" name="ville" class="form-control" value="<?php echo $ville; ?>">
                <span class="help-block"><?php echo $ville_err; ?></span>
            </article>

            <article class="formgroup">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </article>
            <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous</a>.</p>
        </form>
</section>

</main><?php } ?>

<?php 
    if (!isset($_POST['ajax'])) :
    include_once (ROOT_PATH ."inc/footer.php");
?>
<script>
    $(document).ready(function() {
        function initFormTrigger() {
            $("#inscriptionForm input:not([name='email'])").click(function(event) {
           var emailText = $("#inscriptionForm input[name='email']").val();
           if (emailText != "") {
               ajaxSubscribe(emailText, this);
           }
            
        });
        }

        initFormTrigger();
        
        function ajaxSubscribe(emailText, lastClick) {
            var reqUrl="<?= BASE_URL.'inscription.php' ?>";
            var code_html = "" ;
            console.log(reqUrl);
            $.ajax({
                url : reqUrl,
                type : 'POST', // Le type de la requête HTTP, ici devenu POST
                data : 'ajax=true&email=' + emailText, // On fait passer nos variables, exactement comme en GET, au script more_com.php
                dataType : 'html',
                success : function(resultat, statut) { // success est toujours en place, bien sûr !
                   code_html = resultat;
                },
                error : function(resultat, statut, erreur) {
                    console.log("fuck");
                },
                complete : function(resultat, statut) {
                    $("#emailSubscribeForm").html(code_html);
                    $(lastClick).focus();
                    $("#inscriptionForm input[name='email']").val(emailText);
                    console.log(lastClick);
                    initFormTrigger();
                    
                }
            });
          
        };
    });
</script>
<?php endif; ?>