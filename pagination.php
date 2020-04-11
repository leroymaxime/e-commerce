<?php  
include_once 'config.php';
require_once (ROOT_PATH ."inc/database.php");

$page = intval($_GET['page']); // Conversion forcée en entier
// Si le nombre est invalide, on demande la première page par défaut
if($page <= 0) {
    $page = 1;
}
$limite = 10;

// Partie "Requête"
/* On calcule donc le numéro du premier enregistrement */
$debut = ($page - 1) * $limite;
/* On ajoute le marqueur pour spécifier le premier enregistrement */
$query = 'SELECT * FROM products LIMIT :limite OFFSET :debut';
$query = $pdo->prepare($query);
$query->bindValue('limite', $limite, PDO::PARAM_INT);
/* On lie aussi la valeur */
$query->bindValue('debut', $debut, PDO::PARAM_INT);
$query->execute();

// Partie "Boucle"
while ($element = $query->fetch()) {
    echo $element['id_product'] . '<br />';
}

/* Ici on récupère le nombre d'éléments total. Comme c'est une requête, il ne
 * faut pas oublier qu'on ne récupère pas directement le nombre.
 * De plus, comme la requête ne contient aucune donnée client pour fonctionner,
 * on peut l'exécuter ainsi directement */
$resultFoundRows = $pdo->query('SELECT found_rows()');
/* On doit extraire le nombre du jeu de résultat */
$nombredElementsTotal = $resultFoundRows->fetchColumn();
$nombreDePages = ceil($nombredElementsTotal / $limite);

/* Si on est sur la première page, on n'a pas besoin d'afficher de lien
 * vers la précédente. On va donc l'afficher que si on est sur une autre
 * page que la première */
if ($page > 1):
    ?><a href="pagination.php?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
endif;

/* On va effectuer une boucle autant de fois que l'on a de pages */
for ($i = 1; $i <= $nombreDePages; $i++):
    ?><a href="pagination.php?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
endfor;

/* Avec le nombre total de pages, on peut aussi masquer le lien
 * vers la page suivante quand on est sur la dernière */
if ($page < $nombreDePages):
    ?>— <a href="pagination.php?page=<?php echo $page + 1; ?>">Page suivante</a><?php
endif;
?>