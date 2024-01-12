$(document).ready(function () {
  $("#form_antrol")
    .on("beforeSubmit", function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      $(".btn").attr("disabled", true);
      $("#simpan").html("Menyimpan...");
      // var data = new FormData(this);
      var data = $(this).serialize();
      var url = $("#simpan").data("url");
      $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: data,
        // processData: false,
        // contentType: false,
        beforeSend: function (e) {
          $("#simpan").html("Menyimpan...");
        },
        success: function (data) {
          // var res = JSON.parse(data);
          console.log(data);
          if (data.status) {
            toastr
              .success(data.desc)
              .css({ width: "400px", "max-width": "400px" });
            //direct ke url antrol jadwal
            window.location.href = baseUrl + "/antrol-jadwal-operasi/index";
          } else {
            toastr
              .error(data.desc)
              .css({ width: "400px", "max-width": "400px" });
          }
        },
        complete: function (e) {
          $("#simpan").html("Simpan");
          $(".btn").attr("disabled", false);
        },
      });
    })
    .on("submit", function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
    });

  $(document).on("change", "#rm_pasien", function (e) {
    let rm = $("#rm_pasien").val();
    $.post(
      baseUrl + "/antrol-jadwal-operasi/cari-nobpjs",
      {
        rm: rm,
      },
      function (data) {
        var res = JSON.parse(data);
        $("#no_kartu_bpjs").val(res.data);
        // $("#antroljadwaloperasi-debitur_detail_kode")
        //   .val(1210)
        //   .trigger("change");
      }
    );
  });
});
