<!-- Un bouton avec '+' dedans, et un onclick qui appelle une fonction avec -->
<!-- en param le bouton et l'id du div à afficher/masquer. -->
<button type="button" onclick="toggle_div(this,'id_du_div');">+</button>
 
<!-- Un div caché avec un attribut id -->
<div id="id_du_div" style="display:none;">
Yop yop yop yop yop yop yop yop
</div>
 
<!-- Le JS... -->
<script type="text/javascript">
function toggle_div(bouton, id) { // On déclare la fonction toggle_div qui prend en param le bouton et un id
  var div = document.getElementById(id); // On récupère le div ciblé grâce à l'id
  if(div.style.display=="none") { // Si le div est masqué...
    div.style.display = "block"; // ... on l'affiche...
    bouton.innerHTML = "-"; // ... et on change le contenu du bouton.
  } else { // S'il est visible...
    div.style.display = "none"; // ... on le masque...
    bouton.innerHTML = "+"; // ... et on change le contenu du bouton.
  }
}
</script>