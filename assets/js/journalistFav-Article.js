$(document).ready(function () {
  $(".markFav").on("click", function () {
    var articleId = $(this).val();
    $(".favorite-content").load(
      "../assets/php/journalists/journalistMarkFavorite.php",
      {
        "article": articleId
      }
    );
    $("#favorite-modal").css({
      display: "block",
    });
    $("#closeMarkFav").on("click", function () {
      $("#favorite-modal").css({
        display: "none",
      });
    });
  });
});
