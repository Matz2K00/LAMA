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

