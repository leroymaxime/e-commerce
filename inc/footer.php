<div class="body-overlay"></div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
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

  
</script>
<script src="<?= BASE_URL ?>app.js"></script>
<script src="https://kit.fontawesome.com/e49f106c84.js"></script>
</body>
</html>