//Datatables server side type
$(document).ready( function () {
    var url = '/information/typecontroller/ajax_list';
    var table = $('#datatable-infotype').DataTable({ 
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

//Fungsi generate kode type
function generatekodeinfotype() {
    var url = "/information/typecontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#infotype_kode').val(response.kodegen);
            // alert(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data category
$(document).ready(function() {
    $('.formModaltambahinfotype').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahinfotype').prop('disabled', true);
                $('.btnmodaltambahinfotype').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodaltambahinfotype').prop('disabled', false);
                $('.btnmodaltambahinfotype').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infotype_kode){
                        $('#infotype_kode').addClass('is-invalid');
                        $('.errorInfotypeKode').html(response.error.infotype_kode);
                    }
                    else
                    {
                        $('#infotype_kode').removeClass('is-invalid');
                        $('.errorInfotypeKode').html('');
                    }

                    if (response.error.infotype_nama){
                        $('#infotype_nama').addClass('is-invalid');
                        $('.errorInfotypeNama').html(response.error.infotype_nama);
                    }
                    else
                    {
                        $('#infotype_nama').removeClass('is-invalid');
                        $('.errorInfotypeNama').html('');
                    }
                }
                else
                {
                    $('#modaltambahinfotype').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#infotype_nama').val('');
                        $('#datatable-infotype').DataTable().ajax.reload();
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
function editinfotype($kode) {
    var url = "/information/typecontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#infotype_kodeubah').val(response.success.kode);
            $('#infotype_namaubah').val(response.success.jenis);

            $('#infotype_namaubah').removeClass('is-invalid');
            $('.errorInfotypeNamaubah').html('');

            $('#modalubahinfotype').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

// Handle Modal ubah info type
$(document).ready(function() {
    $('.formModalubahinfotype').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahinfotype').prop('disabled', true);
                $('.btnmodalubahinfotype').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodalubahinfotype').prop('disabled', false);
                $('.btnmodalubahinfotype').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infotype_namaubah){
                        $('#infotype_namaubah').addClass('is-invalid');
                        $('.errorInfotypeNamaubah').html(response.error.infotype_namaubah);
                    }
                    else
                    {
                        $('#infotype_namaubah').removeClass('is-invalid');
                        $('.errorInfotypeNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahinfotype').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-infotype').DataTable().ajax.reload();
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

// Handle Modal hapus info type
function deleteinfotype($kode) {
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
            var url =  '/information/typecontroller/hapusdata';

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
                            $('#datatable-infotype').DataTable().ajax.reload();
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