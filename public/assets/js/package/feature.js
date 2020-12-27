//Datatables server side category
$(document).ready( function () {
    var url = '/package/featurecontroller/ajax_list';
    var table = $('#datatable-packagefeature').DataTable({ 
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

//Fungsi modal add data fitur paket
$(document).ready(function() {
    $('.formModaltambahpackagefeature').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahpackagefeature').prop('disabled', true);
                $('.btnmodaltambahpackagefeature').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodaltambahpackagefeature').prop('disabled', false);
                $('.btnmodaltambahpackagefeature').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.packagefeature_keterangan){
                        $('#packagefeature_keterangan').addClass('is-invalid');
                        $('.errorPackagefeatureKeterangan').html(response.error.packagefeature_keterangan);
                    }
                    else
                    {
                        $('#packagefeature_keterangan').removeClass('is-invalid');
                        $('.errorPackagefeatureKeterangan').html('');
                    }
                }
                else
                {
                    $('#modaltambahpackagefeature').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#packagefeature_keterangan').val('');
                        $('#datatable-packagefeature').DataTable().ajax.reload();
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
function editpackagefeature($kode) {
    var url = "/package/featurecontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#packagefeature_kode').val($kode);
            $('#packagefeature_kodeuserubah').val(response.success.kode_user);
            $('#packagefeature_keteranganubah').val(response.success.keterangan);

            $('#packagefeature_keteranganubah').removeClass('is-invalid');
            $('.errorPackagefeatureKeteranganubah').html('');

            $('#modalubahpackagefeature').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data category
$(document).ready(function() {
    $('.formModalubahpackagefeature').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahpackagefeature').prop('disabled', true);
                $('.btnmodalubahpackagefeature').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodalubahpackagefeature').prop('disabled', false);
                $('.btnmodalubahpackagefeature').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.packagefeature_keteranganubah){
                        $('#packagefeature_keteranganubah').addClass('is-invalid');
                        $('.errorPackagefeatureKeteranganubah').html(response.error.packagefeature_keteranganubah);
                    }
                    else
                    {
                        $('#packagefeature_keteranganubah').removeClass('is-invalid');
                        $('.errorPackagefeatureKeteranganubah').html('');
                    }
                }
                else
                {
                    $('#modalubahpackagefeature').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-packagefeature').DataTable().ajax.reload();
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
function deletepackagefeature($kode) {
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
            var url =  '/package/featurecontroller/hapusdata';

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
                            $('#datatable-packagefeature').DataTable().ajax.reload();
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