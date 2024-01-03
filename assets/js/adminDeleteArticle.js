$(document).ready(function () {
  $(".deleteArticle").on("click", function () {
    var articleId = $(this).val();
    $("#deleteArticle-modal").css({ display: "block" });
    $(".deleteArticle-Contents").load(
      "../assets/php/admins/delete-article.php",
      { article: articleId }
    );
    $("#closeDeleArticleModal").on("click", function () {
      location.reload();
      $("#deleteArticle-modal").css({ display: "none" });
    });
  });
});
