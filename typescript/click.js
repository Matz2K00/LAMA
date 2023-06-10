$(document).ready(function() {
  $(".vaiAlCorso").click(function() {
    var id_corso = $(this).data("id-corso");
    $.ajax({
      url: "vaiAlCorso.php", 
      type: "POST",
      data: { id_corso: id_corso }, 
      success: function(response) {
        console.log(response);
        window.location.href = "video.php";
      }
    });
  });
});

/*
$(document).ready(function() {
  $(".rimuoviDalCarrello").click(function() {
    var id_corso = $(this).data("id-corso");
    $.ajax({
      url: "rimuoviDalCarrello.php", 
      type: "POST",
      data: { id_corso: id_corso }, 
      success: function(response) {
        console.log(response);
        location.reload();
      }
    });
  });
});


document.addEventListener('DOMContentLoaded', function() {
  var button = document.querySelector('.primaAccedi');
  button.addEventListener('click', function() {
    window.location.href = 'accesso.php';
  });
});


$(document).ready(function() {
  $(".vaiAlPagamento").click(function() {
    $.ajax({
      url: "vaiAlPagamento.php", 
      type: "POST",
      success: function(response) {
        $("#rispostaAjax").html(response);
      }
    });
  });
});
*/