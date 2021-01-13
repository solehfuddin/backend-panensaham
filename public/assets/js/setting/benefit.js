//Datatables server side
$(document).ready( function () {
    var url = '/setting/benefitcontroller/ajax_list';
    var table = $('#datatable-settingbenefit').DataTable({ 
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
function generatekodesettingbenefit() {
    var url = "/setting/benefitcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#settingbenefit_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahsettingbenefit').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahsettingbenefit').prop('disabled', true);
                $('.btnmodaltambahsettingbenefit').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahsettingbenefit').prop('disabled', false);
                $('.btnmodaltambahsettingbenefit').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.settingbenefit_kode){
                        $('#settingbenefit_kode').addClass('is-invalid');
                        $('.errorSettingbenefitKode').html(response.error.settingbenefit_kode);
                    }
                    else
                    {
                        $('#settingbenefit_kode').removeClass('is-invalid');
                        $('.errorSettingbenefitKode').html('');
                    }

                    if (response.error.settingbenefit_nama){
                        $('#settingbenefit_nama').addClass('is-invalid');
                        $('.errorSettingbenefitNama').html(response.error.settingbenefit_nama);
                    }
                    else
                    {
                        $('#settingbenefit_nama').removeClass('is-invalid');
                        $('.errorSettingbenefitNama').html('');
                    }

                    if (response.error.settingbenefit_deskripsi){
                        $('#settingbenefit_deskripsi').addClass('is-invalid');
                        $('.errorSettingbenefitDeskripsi').html(response.error.settingbenefit_deskripsi);
                    }
                    else
                    {
                        $('#settingbenefit_deskripsi').removeClass('is-invalid');
                        $('.errorSettingbenefitDeskripsi').html('');
                    }
                }
                else
                {
                    $('#modaltambahsettingbenefit').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#settingbenefit_nama').val('');
                        $('#settingbenefit_deskripsi').val('');
                        $('#datatable-settingbenefit').DataTable().ajax.reload();
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
function editsettingbenefit($kode) {
    var url = "/setting/benefitcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#settingbenefit_kodeubah').val(response.success.kode);
            $('#settingbenefit_namaubah').val(response.success.judul);
            $('#settingbenefit_deskripsiubah').val(response.success.deskripsi);

            $('#settingbenefit_namaubah').removeClass('is-invalid');
            $('.errorSettingbenefitNamaubah').html('');

            $('#settingbenefit_deskripsiubah').removeClass('is-invalid');
            $('.errorSettingbenefitDeskripsiubah').html('');

            $('#modalubahsettingbenefit').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahsettingbenefit').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahsettingbenefit').prop('disabled', true);
                $('.btnmodalubahsettingbenefit').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahsettingbenefit').prop('disabled', false);
                $('.btnmodalubahsettingbenefit').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.settingbenefit_namaubah){
                        $('#settingbenefit_namaubah').addClass('is-invalid');
                        $('.errorSettingbenefitNamaubah').html(response.error.settingbenefit_namaubah);
                    }
                    else
                    {
                        $('#settingbenefit_namaubah').removeClass('is-invalid');
                        $('.errorSettingbenefitNamaubah').html('');
                    }

                    if (response.error.settingbenefit_deskripsiubah){
                        $('#settingbenefit_deskripsiubah').addClass('is-invalid');
                        $('.errorSettingbenefitDeskripsiubah').html(response.error.settingbenefit_deskripsiubah);
                    }
                    else
                    {
                        $('#settingbenefit_deskripsiubah').removeClass('is-invalid');
                        $('.errorSettingbenefitDeskripsiubah').html('');
                    }
                }
                else
                {
                    $('#modalubahsettingbenefit').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-settingbenefit').DataTable().ajax.reload();
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
function deletesettingbenefit($kode) {
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
            var url =  '/setting/benefitcontroller/hapusdata';

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
                            $('#datatable-settingbenefit').DataTable().ajax.reload();
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