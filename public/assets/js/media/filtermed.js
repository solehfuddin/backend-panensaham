//Datatables server side category
$(document).ready( function () {
    var url = '/media/filtermedcontroller/ajax_list';
    var table = $('#datatable-mediafilter').DataTable({ 
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

//Fungsi generate kode category
function generatekodemediafilter() {
    var url = "/media/filtermedcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#mediafilter_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data category
$(document).ready(function() {
    $('.formModaltambahmediafilter').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahmediafilter').prop('disabled', true);
                $('.btnmodaltambahmediafilter').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodaltambahmediafilter').prop('disabled', false);
                $('.btnmodaltambahmediafilter').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.mediafilter_kode){
                        $('#mediafilter_kode').addClass('is-invalid');
                        $('.errorMediafilterKode').html(response.error.mediafilter_kode);
                    }
                    else
                    {
                        $('#mediafilter_kode').removeClass('is-invalid');
                        $('.errorMediafilterKode').html('');
                    }

                    if (response.error.mediafilter_nama){
                        $('#mediafilter_nama').addClass('is-invalid');
                        $('.errorMediafilterNama').html(response.error.mediafilter_nama);
                    }
                    else
                    {
                        $('#mediafilter_nama').removeClass('is-invalid');
                        $('.errorMediafilterNama').html('');
                    }
                }
                else
                {
                    $('#modaltambahmediafilter').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#mediafilter_kode').val('');
                        $('#datatable-mediafilter').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});

//Fungsi select data category 
function editmediafilter($kode) {
    var url = "/media/filtermedcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#mediafilter_kodeubah').val(response.success.kode);
            $('#mediafilter_namaubah').val(response.success.judul);

            $('#mediafilter_namaubah').removeClass('is-invalid');
            $('.errorMediafilterNamaubah').html('');

            $('#modalubahmediafilter').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data category
$(document).ready(function() {
    $('.formModalubahmediafilter').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahmediafilter').prop('disabled', true);
                $('.btnmodalubahmediafilter').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodalubahmediafilter').prop('disabled', false);
                $('.btnmodalubahmediafilter').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.mediafilter_namaubah){
                        $('#mediafilter_namaubah').addClass('is-invalid');
                        $('.errorMediafilterNamaubah').html(response.error.mediafilter_namaubah);
                    }
                    else
                    {
                        $('#mediafilter_namaubah').removeClass('is-invalid');
                        $('.errorMediafilterNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahmediafilter').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-mediafilter').DataTable().ajax.reload();
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

//Fungsi modal delete data category
function deletemediafilter($kode) {
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
            var url =  '/media/filtermedcontroller/hapusdata';

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
                            $('#datatable-mediafilter').DataTable().ajax.reload();
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