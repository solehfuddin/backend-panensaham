//Datatables server side category
$(document).ready( function () {
    var url = '/account/membercontroller/ajax_list';
    var table = $('#datatable-accountmember').DataTable({ 
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
function generatekodeaccountmember() {
    var url = "/account/membercontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#accountmember_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data category
$(document).ready(function() {
    $('.formModaltambahaccountmember').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahaccountmember').prop('disabled', true);
                $('.btnmodaltambahaccountmember').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodaltambahaccountmember').prop('disabled', false);
                $('.btnmodaltambahaccountmember').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.accountmember_kode){
                        $('#accountmember_kode').addClass('is-invalid');
                        $('.errorAccountmemberKode').html(response.error.accountmember_kode);
                    }
                    else
                    {
                        $('#accountmember_kode').removeClass('is-invalid');
                        $('.errorAccountmemberKode').html('');
                    }

                    if (response.error.accountmember_nama){
                        $('#accountmember_nama').addClass('is-invalid');
                        $('.errorAccountmemberNama').html(response.error.accountmember_nama);
                    }
                    else
                    {
                        $('#accountmember_nama').removeClass('is-invalid');
                        $('.errorAccountmemberNama').html('');
                    }
                }
                else
                {
                    $('#modaltambahaccountmember').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#accountmember_nama').val('');
                        $('#datatable-accountmember').DataTable().ajax.reload();
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
function editaccountmember($kode) {
    var url = "/account/membercontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#accountmember_kodeubah').val(response.success.kode);
            $('#accountmember_namaubah').val(response.success.keterangan);

            $('#accountmember_namaubah').removeClass('is-invalid');
            $('.errorAccountmemberNamaubah').html('');

            $('#modalubahaccountmember').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data category
$(document).ready(function() {
    $('.formModalubahaccountmember').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahaccountmember').prop('disabled', true);
                $('.btnmodalubahaccountmember').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnmodalubahaccountmember').prop('disabled', false);
                $('.btnmodalubahaccountmember').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.accountmember_namaubah){
                        $('#accountmember_namaubah').addClass('is-invalid');
                        $('.errorAccountmemberNamaubah').html(response.error.accountmember_namaubah);
                    }
                    else
                    {
                        $('#accountmember_namaubah').removeClass('is-invalid');
                        $('.errorAccountmemberNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahaccountmember').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-accountmember').DataTable().ajax.reload();
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
function deleteaccountmember($kode) {
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
            var url =  '/account/membercontroller/hapusdata';

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
                            $('#datatable-accountmember').DataTable().ajax.reload();
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