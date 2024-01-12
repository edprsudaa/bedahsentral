$(document).ready(function () {
  $(document).on("click", "#pilih", function (e) {
    let url = $(this).data("url");
    window.location.href = url;
  });

  $(document).on("click", "#refresh", function (e) {
    e.preventDefault;
    e.stopImmediatePropagation();

    $("#refresh")
      .html('<i class="fas fa-spinner fa-spin"></i> Proses ...')
      .attr("disabled", true);

    $.pjax.reload({ container: "#ref", timeout: false }); //pjax form
  });

  // Listener untuk menangani ketika pjax selesai dilakukan
  $(document).on("pjax:complete", function () {
    // Kembalikan isi tombol ke semula dan aktifkan kembali tombolnya
    $("#refresh")
      .html('<i class="fas fa-sync"></i> Refresh Data')
      .removeAttr("disabled");
  });

  $(document).on("click", ".btn-delete", function (e) {
    e.preventDefault;
    e.stopImmediatePropagation();

    var obj_url = $(this).data("url");

    Swal.fire({
      title: "Anda Yakin ?",
      text: "Yakin Hapus, Karna Dengan ini Data Tidak Akan Ditampilkan Lagi ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Ya!",
      cancelButtonText: "Tidak!",
      customClass: {
        confirmButton: "btn btn-success mt-2",
        cancelButton: "btn btn-danger ml-2 mt-2",
      },
      buttonsStyling: false,
      // showLoaderOnConfirm: true,
    }).then(function (t) {
      t.value
        ? $.ajax({
            url: obj_url,
            type: "get",
            beforeSend: function (e) {},
            success: function (data) {
              if (data.status) {
                toastr
                  .success(data.msg)
                  .css({ width: "400px", "max-width": "400px" });
                // Reload Tabel
                $.pjax.reload({ container: "#ref", timeout: false }); //pjax form
              } else {
                toastr
                  .error(data.msg)
                  .css({ width: "400px", "max-width": "400px" });
              }
            },
            complete: function (e) {},
          })
        : t.dismiss === Swal.DismissReason.cancel;
    });
  });
});
