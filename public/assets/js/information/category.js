//Datatables server side category
$(document).ready( function () {
    var url = '/information/categorycontroller/ajax_list';
    var table = $('#datatable-categorytype').DataTable({ 
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
function generatekodeinfocategory() {
    var url = "/information/categorycontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#infocategory_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data category
$(document).ready(function() {
    $('.formModaltambahcategorytype').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahcategorytype').prop('disabled', true);
                $('.btnmodaltambahcategorytype').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodaltambahcategorytype').prop('disabled', false);
                $('.btnmodaltambahcategorytype').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infocategory_kode){
                        $('#infocategory_kode').addClass('is-invalid');
                        $('.errorInfocategoriKode').html(response.error.infocategory_kode);
                    }
                    else
                    {
                        $('#infocategory_kode').removeClass('is-invalid');
                        $('.errorInfocategoriKode').html('');
                    }

                    if (response.error.infocategory_nama){
                        $('#infocategory_nama').addClass('is-invalid');
                        $('.errorInfocategoryeNama').html(response.error.infocategory_nama);
                    }
                    else
                    {
                        $('#infocategory_nama').removeClass('is-invalid');
                        $('.errorInfocategoryeNama').html('');
                    }
                }
                else
                {
                    $('#modaltambahcategorytype').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        // window.location = response.success.link;
                        // refreshTable();
                        $('#infocategory_nama').val('');
                        $('#datatable-categorytype').DataTable().ajax.reload();
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
function editinfocategory($kode) {
    var url = "/information/categorycontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#infocategory_kodeubah').val(response.success.kode);
            $('#infocategory_namaubah').val(response.success.kategori);

            $('#infocategory_namaubah').removeClass('is-invalid');
            $('.errorInfocategoryNamaubah').html('');

            $('#modalubahinfocategory').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data category
$(document).ready(function() {
    $('.formModalubahinfocategory').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahinfocategory').prop('disabled', true);
                $('.btnmodalubahinfocategory').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodalubahinfocategory').prop('disabled', false);
                $('.btnmodalubahinfocategory').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infocategory_namaubah){
                        $('#infocategory_namaubah').addClass('is-invalid');
                        $('.errorInfocategoryNamaubah').html(response.error.infocategory_namaubah);
                    }
                    else
                    {
                        $('#infocategory_namaubah').removeClass('is-invalid');
                        $('.errorInfocategoryNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahinfocategory').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-categorytype').DataTable().ajax.reload();
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
function deleteinfocategory($kode) {
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
            var url =  '/information/categorycontroller/hapusdata';

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
                            $('#datatable-categorytype').DataTable().ajax.reload();
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

//Fungsi select data category alternative
// function editcategorytest($kode, $kategori)
// {
//     $('#infocategory_kodeubah').val($kode);
//     $('#infocategory_namaubah').val($kategori);

//     $('#infocategory_namaubah').removeClass('is-invalid');
//     $('.errorInfocategoryNamaubah').html('');
//     $('#modalubahinfocategory').modal('show');
// }