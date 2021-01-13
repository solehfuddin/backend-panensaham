// Format rupiah inputan
var add_harga = document.getElementById('packageprice_harga');
var add_tmpharga = document.getElementById('packageprice_hargatmp');
var ubah_harga = document.getElementById('packageprice_hargaubah');
var ubah_tmpharga = document.getElementById('packageprice_hargatmpubah');

add_harga.addEventListener('keyup', function(e) {
    add_harga.value = formatRupiah(this.value, 'Rp. ');
    add_tmpharga.value = formatAngka(add_harga.value);
});

ubah_harga.addEventListener('keyup', function(e) {
    ubah_harga.value = formatRupiah(this.value, 'Rp. ');
    ubah_tmpharga.value = formatAngka(ubah_harga.value);
});

//Datatables server side
$(document).ready( function () {
    var url = '/package/pricecontroller/ajax_list';
    var table = $('#datatable-packageprice').DataTable({
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
            "widht": '100',
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
function generatekodepackageprice() {
    var url = "/package/pricecontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#packageprice_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahpackageprice').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahpackageprice').prop('disabled', true);
                $('.btnmodaltambahpackageprice').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahpackageprice').prop('disabled', false);
                $('.btnmodaltambahpackageprice').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.packageprice_kode){
                        $('#packageprice_kode').addClass('is-invalid');
                        $('.errorPackagapricekode').html(response.error.packageprice_kode);
                    }
                    else
                    {
                        $('#packageprice_kode').removeClass('is-invalid');
                        $('.errorPackagapricekode').html('');
                    }

                    if (response.error.packageprice_harga){
                        $('#packageprice_harga').addClass('is-invalid');
                        $('.errorPackagapriceharga').html(response.error.packageprice_harga);
                    }
                    else
                    {
                        $('#packageprice_harga').removeClass('is-invalid');
                        $('.errorPackagapriceharga').html('');
                    }
                }
                else
                {
                    $('#modaltambahpackageprice').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        // window.location = response.success.link;
                        // refreshTable();
                        $('#packageprice_harga').val('');
                        $('#datatable-packageprice').DataTable().ajax.reload();
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
function editpackageprice($kode) {
    var url = "/package/pricecontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#packageprice_kodeubah').val(response.success.kode);
            $('#packageprice_jenismemberubah').val(response.success.jenis_member);
            $('#packageprice_kodeuserubah').val(response.success.user_level);
            $('#packageprice_hargaubah').val(formatRupiah(response.success.harga, 'Rp. '));
            $('#packageprice_hargatmpubah').val(response.success.harga);
            $('#packageprice_durasiubah').val(response.success.bulan);

            $('#packageprice_hargaubah').removeClass('is-invalid');
            $('.packageprice_hargaubah').html('');

            $('#modalubahpackageprice').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahpackageprice').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahpackageprice').prop('disabled', true);
                $('.btnmodalubahpackageprice').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahpackageprice').prop('disabled', false);
                $('.btnmodalubahpackageprice').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.packageprice_hargaubah){
                        $('#packageprice_hargaubah').addClass('is-invalid');
                        $('.errorPackagapriceharga').html(response.error.packageprice_hargaubah);
                    }
                    else
                    {
                        $('#packageprice_hargaubah').removeClass('is-invalid');
                        $('.errorPackagapriceharga').html('');
                    }
                }
                else
                {
                    $('#modalubahpackageprice').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-packageprice').DataTable().ajax.reload();
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
function deletepackageprice($kode) {
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
            var url =  '/package/pricecontroller/hapusdata';

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
                            $('#datatable-packageprice').DataTable().ajax.reload();
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