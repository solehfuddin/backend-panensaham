//Datatables server side
$(document).ready( function () {
    var url = '/account/userlevelcontroller/ajax_list';
    var table = $('#datatable-accountuserlevel').DataTable({ 
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
function generatekodeaccountuserlevel() {
    var url = "/account/userlevelcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#accountuserlevel_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahaccountuserlevel').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahaccountuserlevel').prop('disabled', true);
                $('.btnmodaltambahaccountuserlevel').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahaccountuserlevel').prop('disabled', false);
                $('.btnmodaltambahaccountuserlevel').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.accountuserlevel_kode){
                        $('#accountuserlevel_kode').addClass('is-invalid');
                        $('.errorAccountuserlevelKode').html(response.error.accountuserlevel_kode);
                    }
                    else
                    {
                        $('#accountuserlevel_kode').removeClass('is-invalid');
                        $('.errorAccountuserlevelKode').html('');
                    }

                    if (response.error.accountuserlevel_nama){
                        $('#accountuserlevel_nama').addClass('is-invalid');
                        $('.errorAccountuserlevelNama').html(response.error.accountuserlevel_nama);
                    }
                    else
                    {
                        $('#accountuserlevel_nama').removeClass('is-invalid');
                        $('.errorAccountuserlevelNama').html('');
                    }

                    if (response.error.accountuserlevel_alias){
                        $('#accountuserlevel_alias').addClass('is-invalid');
                        $('.errorAccountuserlevelAlias').html(response.error.accountuserlevel_alias);
                    }
                    else
                    {
                        $('#accountuserlevel_alias').removeClass('is-invalid');
                        $('.errorAccountuserlevelAlias').html('');
                    }
                }
                else
                {
                    $('#modaltambahaccountuserlevel').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#accountuserlevel_nama').val('');
                        $('#accountuserlevel_alias').val('');
                        $('#accountuserlevel_keterangan').val('');
                        $('#accountuserlevel_infolanjut').val('');

                        $('#datatable-accountuserlevel').DataTable().ajax.reload();
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
function editaccountuserlevel($kode) {
    var url = "/account/userlevelcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#accountuserlevel_kodeubah').val(response.success.kodeuser);
            $('#accountuserlevel_namaubah').val(response.success.level);
            $('#accountuserlevel_aliasubah').val(response.success.alias);
            $('#accountuserlevel_aliasdefault').val(response.success.alias);
            $('#accountuserlevel_keteranganubah').val(response.success.keterangan);
            $('#accountuserlevel_infolanjutubah').val(response.success.infolanjut);

            $('#accountuserlevel_namaubah').removeClass('is-invalid');
            $('.errorAccountuserlevelNamaubah').html('');

            $('#accountuserlevel_aliasubah').removeClass('is-invalid');
            $('.errorAccountuserlevelAliasubah').html('');

            $('#modalubahaccountuserlevel').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahaccountuserlevel').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahaccountuserlevel').prop('disabled', true);
                $('.btnmodalubahaccountuserlevel').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahaccountuserlevel').prop('disabled', false);
                $('.btnmodalubahaccountuserlevel').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.accountuserlevel_namaubah){
                        $('#accountuserlevel_namaubah').addClass('is-invalid');
                        $('.errorAccountuserlevelNamaubah').html(response.error.accountuserlevel_namaubah);
                    }
                    else
                    {
                        $('#accountuserlevel_namaubah').removeClass('is-invalid');
                        $('.errorAccountuserlevelNamaubah').html('');
                    }

                    if (response.error.accountuserlevel_aliasubah){
                        $('#accountuserlevel_aliasubah').addClass('is-invalid');
                        $('.errorAccountuserlevelAliasubah').html(response.error.accountuserlevel_aliasubah);
                    }
                    else
                    {
                        $('#accountuserlevel_aliasubah').removeClass('is-invalid');
                        $('.errorAccountuserlevelAliasubah').html('');
                    }
                }
                else
                {
                    $('#modalubahaccountuserlevel').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-accountuserlevel').DataTable().ajax.reload();
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
function deleteaccountuserlevel($kode) {
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
            var url =  '/account/userlevelcontroller/hapusdata';

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
                            $('#datatable-accountuserlevel').DataTable().ajax.reload();
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