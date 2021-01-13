//Datatables server side
$(document).ready( function () {
    var url = '/account/administratorcontroller/ajax_list';
    var table = $('#datatable-accountadministrator').DataTable({ 
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
          "url": BASE_URL + url,
          "type": "POST"
      },
      //optional
      "lengthMenu": [10, 25, 50, 100, 250, 500],
      "columnDefs": [
        { 
            "targets": [],
            "orderable": false,
        },
      ],
      "select": {
        "style": "multi"
      },
      "language": {
        "paginate": 
        {
            "previous": "<i class='fas fa-angle-left'>",
            "next": "<i class='fas fa-angle-right'>"
        }
    }
    });
});

//Fungsi generate kode
function generatekodeaccountadministrator() {
  var url = "/account/administratorcontroller/getdata";
  $.ajax({
      url: BASE_URL + url,
      dataType: "JSON",
      success: function(response) {
          $('#accountadministrator_kode').val(response.kodegen);
      },
      error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
  });
}

//Fungsi modal add data
$(document).ready(function() {
  $('.formModaltambahaccountadministrator').submit(function(e) {
      e.preventDefault();

      $.ajax({
          type: "post",
          url: $(this).attr('action'),
          data: $(this).serialize(),
          dataType: "json",
          beforeSend: function() {
              $('.btnmodaltambahaccountadministrator').prop('disabled', true);
              $('.btnmodaltambahaccountadministrator').html('<i class="fa fa-spin fa-spinner"></i> Processing');
          },
          complete: function() {
              $('.btnmodaltambahaccountadministrator').prop('disabled', false);
              $('.btnmodaltambahaccountadministrator').html('Simpan');
          },
          success: function(response) {
              if (response.error){
                  if (response.error.accountadministrator_kode){
                      $('#accountadministrator_kode').addClass('is-invalid');
                      $('.errorAccountadministratorKode').html(response.error.accountadministrator_kode);
                  }
                  else
                  {
                      $('#accountadministrator_kode').removeClass('is-invalid');
                      $('.errorAccountadministratorKode').html('');
                  }

                  if (response.error.accountadministrator_username){
                      $('#accountadministrator_username').addClass('is-invalid');
                      $('.errorAccountadministratorUsername').html(response.error.accountadministrator_username);
                  }
                  else
                  {
                      $('#accountadministrator_username').removeClass('is-invalid');
                      $('.errorAccountadministratorUsername').html('');
                  }

                  if (response.error.accountadministrator_fullname){
                    $('#accountadministrator_fullname').addClass('is-invalid');
                    $('.errorAccountadministratorFullname').html(response.error.accountadministrator_fullname);
                }
                else
                {
                    $('#accountadministrator_fullname').removeClass('is-invalid');
                    $('.errorAccountadministratorFullname').html('');
                }

                if (response.error.accountadministrator_email){
                    $('#accountadministrator_email').addClass('is-invalid');
                    $('.errorAccountadministratorEmail').html(response.error.accountadministrator_email);
                }
                else
                {
                    $('#accountadministrator_email').removeClass('is-invalid');
                    $('.errorAccountadministratorEmail').html('');
                }

                if (response.error.accountadministrator_password){
                    $('#accountadministrator_password').addClass('is-invalid');
                    $('.errorAccountadministratorPassword').html(response.error.accountadministrator_password);
                }
                else
                {
                    $('#accountadministrator_password').removeClass('is-invalid');
                    $('.errorAccountadministratorPassword').html('');
                }
              }
              else
              {
                  $('#modaltambahaccountadministrator').modal('hide');

                  Swal.fire(
                      'Pemberitahuan',
                      response.success.data,
                      'success',
                  ).then(function() {
                      $('#accountadministrator_kode').val('');
                      $('#accountadministrator_username').val('');
                      $('#accountadministrator_fullname').val('');
                      $('#accountadministrator_email').val('');
                      $('#accountadministrator_password').val('');
                      $('#datatable-accountadministrator').DataTable().ajax.reload();
                  });
              }
          },
          error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }
      });
  });
});

//Fungsi select data 
function editaccountadministrator($kode) {
    var url = "/account/administratorcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#accountadministrator_kodeubah').val(response.success.kode);
            $('#accountadministrator_usernameubah').val(response.success.username);
            $('#accountadministrator_fullnameubah').val(response.success.nama);
            $('#accountadministrator_emailubah').val(response.success.email);
            $('#accountadministrator_genderubah').val(response.success.gender);

            $('#accountadministrator_usernameubah').removeClass('is-invalid');
            $('.errorAccountadministratorUsernameubah').html('');

            $('#accountadministrator_fullnameubah').removeClass('is-invalid');
            $('.errorAccountadministratorFullnameubah').html('');

            $('#accountadministrator_emailubah').removeClass('is-invalid');
            $('.errorAccountadministratorEmailubah').html('');

            $('#modalubahaccountadministrator').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahaccountadministrator').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahaccountadministrator').prop('disabled', true);
                $('.btnmodalubahaccountadministrator').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahaccountadministrator').prop('disabled', false);
                $('.btnmodalubahaccountadministrator').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.accountadministrator_usernameubah){
                        $('#accountadministrator_usernameubah').addClass('is-invalid');
                        $('.errorAccountadministratorUsernameubah').html(response.error.accountadministrator_usernameubah);
                    }
                    else
                    {
                        $('#accountadministrator_usernameubah').removeClass('is-invalid');
                        $('.errorAccountadministratorUsernameubah').html('');
                    }

                    if (response.error.accountadministrator_fullnameubah){
                        $('#accountadministrator_fullnameubah').addClass('is-invalid');
                        $('.errorAccountadministratorFullnameubah').html(response.error.accountadministrator_fullnameubah);
                    }
                    else
                    {
                        $('#accountadministrator_fullnameubah').removeClass('is-invalid');
                        $('.errorAccountadministratorFullnameubah').html('');
                    }

                    if (response.error.accountadministrator_emailubah){
                        $('#accountadministrator_emailubah').addClass('is-invalid');
                        $('.errorAccountadministratorEmailubah').html(response.error.accountadministrator_emailubah);
                    }
                    else
                    {
                        $('#accountadministrator_emailubah').removeClass('is-invalid');
                        $('.errorAccountadministratorEmailubah').html('');
                    }
                }
                else
                {
                    $('#modalubahaccountadministrator').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-accountadministrator').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});

//Fungsi modal delete data
function deleteaccountadministrator($kode) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Data akan terhapus permanen dari sistem',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then(function(result) {
        if (result.value)
        {
            var url =  '/account/administratorcontroller/hapusdata';

            $.ajax({
                type: "post",
                url: BASE_URL + url,
                data: {
                    kode: $kode,
                },
                dataType: "json",
                success: function(response) {
                    if (response.success){
                        Swal.fire(
                            'Pemberitahuan',
                            response.success.data,
                            'success',
                        ).then(function() {
                            // window.location = response.success.link;
                            $('#datatable-accountadministrator').DataTable().ajax.reload();
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
        else if (result.dismiss == 'batal')
        {
            swal.dismiss();
        }
    });
}

//Fungsi reset password
function changepassword($kode) {
    $('#passadministrator_kodeubah').val($kode);
    $('#passadministrator_passwordbaru').val('');
    $('#passadministrator_passwordkonfirmasi').val('');

    $('#modalpasswordaccountadministrator').modal('show');
}

$(document).ready(function() {
    $('.formModalubahpassadministrator').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahpassadministrator').prop('disabled', true);
                $('.btnmodalubahpassadministrator').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahpassadministrator').prop('disabled', false);
                $('.btnmodalubahpassadministrator').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.passnotmatch)
                    {
                        $('#passadministrator_passwordbaru').addClass('is-invalid');
                        $('.errorPassadministratorPasswordbaru').html(response.error.passnotmatch);

                        $('#passadministrator_passwordkonfirmasi').addClass('is-invalid');
                        $('.errorPassadministratorPasswordkonfirmasi').html(response.error.passnotmatch);
                    }
                    else if (response.error.passadministrator_passwordbaru){
                        $('#passadministrator_passwordbaru').addClass('is-invalid');
                        $('.errorPassadministratorPasswordbaru').html(response.error.passadministrator_passwordbaru);
                    }
                    else if (response.error.passadministrator_passwordkonfirmasi){
                        $('#passadministrator_passwordkonfirmasi').addClass('is-invalid');
                        $('.errorPassadministratorPasswordkonfirmasi').html(response.error.passadministrator_passwordkonfirmasi);
                    }
                    else
                    {
                        $('#passadministrator_passwordbaru').removeClass('is-invalid');
                        $('.errorPassadministratorPasswordbaru').html('');

                        $('#passadministrator_passwordkonfirmasi').removeClass('is-invalid');
                        $('.errorPassadministratorPasswordkonfirmasi').html('');
                    }
                }
                else
                {
                    $('#modalpasswordaccountadministrator').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-accountadministrator').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});