$(document).ready(function () {
  $(".disableAudioHavenButton").on("click", function () {
    var havenId = $(this).val();
    $("#disableAudioHaven-modal").css({ display: "block" });
    $(".disableAudioHaven-Contents").load(
      "../assets/php/admins/disable-audioHaven.php",
      { haven: havenId }
    );
    $("#closeDisableAudioHavenModal").on("click", function () {
      location.reload();
      $("#disableAudioHaven-modal").css({ display: "none" });
    });
  });
});
