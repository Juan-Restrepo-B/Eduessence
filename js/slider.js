$(document).ready(function() {
  // Configura un intervalo para cambiar de slide cada 3 segundos
  setInterval(function() {
      // Encuentra el primer slide en ambos sliders y ocúltalo
      $(".left .slide:first").fadeOut(1000);
      $(".right .slide:first").fadeOut(1000);

      // Muestra el siguiente slide en ambos sliders
      $(".left .slide:first").next().fadeIn(1000);
      $(".right .slide:first").next().fadeIn(1000);

      // Mueve el primer slide al final de la lista en ambos sliders
      $(".left .slide:first").appendTo(".left .slider");
      $(".right .slide:first").appendTo(".right .slider");
  }, 20000); // Cambia de slide cada 3 segundos
});
