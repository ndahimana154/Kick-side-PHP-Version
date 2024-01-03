$(document).ready(function () {
  $(".deleteHistoryButton").on("click", function () {
    var historyId = $(this).val();
    $("#deleteHistory-modal").css({ display: "block" });
    $(".deleteHistory-Contents").load(
      "../assets/php/admins/delete-history.php",
      { history: historyId }
    );
    $("#closeDeleHistoryModal").on("click", function () {
      location.reload();
      $("#deleteHistory-modal").css({ display: "none" });
    });
  });
});
