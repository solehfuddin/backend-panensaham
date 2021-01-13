//Datatables server side
$(document).ready( function () {
    var url = '/setting/customcontroller/ajax_list';
    var table = $('#datatable-settingcustom').DataTable({ 
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
function generatekodesettingcustom() {
    var url = "/setting/customcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#settingcustom_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahsettingcustom').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahsettingcustom').prop('disabled', true);
                $('.btnmodaltambahsettingcustom').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahsettingcustom').prop('disabled', false);
                $('.btnmodaltambahsettingcustom').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.settingcustom_kode){
                        $('#settingcustom_kode').addClass('is-invalid');
                        $('.errorSettingcustomKode').html(response.error.settingcustom_kode);
                    }
                    else
                    {
                        $('#settingcustom_kode').removeClass('is-invalid');
                        $('.errorSettingcustomKode').html('');
                    }

                    if (response.error.settingcustom_judul){
                        $('#settingcustom_judul').addClass('is-invalid');
                        $('.errorSettingcustomJudul').html(response.error.settingcustom_judul);
                    }
                    else
                    {
                        $('#settingcustom_judul').removeClass('is-invalid');
                        $('.errorSettingcustomJudul').html('');
                    }

                    if (response.error.settingcustom_isi){
                        $('#settingcustom_isi').addClass('is-invalid');
                        $('.errorSettingcustomIsi').html(response.error.settingcustom_isi);
                    }
                    else
                    {
                        $('#settingcustom_isi').removeClass('is-invalid');
                        $('.errorSettingcustomIsi').html('');
                    }
                }
                else
                {
                    $('#modaltambahsettingcustom').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#settingcustom_judul').val('');
                        $('#settingcustom_isi').val('');
                        $('#datatable-settingcustom').DataTable().ajax.reload();
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
function editsettingcustom($kode) {
    var url = "/setting/customcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#settingcustom_kodeubah').val(response.success.kode);
            $('#settingcustom_judulubah').val(response.success.judul);
            $('#settingcustom_isiubah').val(response.success.isi);

            $('#settingcustom_judulubah').removeClass('is-invalid');
            $('.errorSettingcustomJudulubah').html('');

            $('#settingcustom_isiubah').removeClass('is-invalid');
            $('.errorSettingcustomIsiubah').html('');

            $('#modalubahsettingcustom').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahsettingcustom').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahsettingcustom').prop('disabled', true);
                $('.btnmodalubahsettingcustom').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahsettingcustom').prop('disabled', false);
                $('.btnmodalubahsettingcustom').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.settingcustom_judulubah){
                        $('#settingcustom_judulubah').addClass('is-invalid');
                        $('.errorSettingcustomJudulubah').html(response.error.settingcustom_judulubah);
                    }
                    else
                    {
                        $('#settingcustom_judulubah').removeClass('is-invalid');
                        $('.errorSettingcustomJudulubah').html('');
                    }

                    if (response.error.settingcustom_isiubah){
                        $('#settingcustom_isiubah').addClass('is-invalid');
                        $('.errorSettingcustomIsiubah').html(response.error.settingcustom_isiubah);
                    }
                    else
                    {
                        $('#settingcustom_isiubah').removeClass('is-invalid');
                        $('.errorSettingcustomIsiubah').html('');
                    }
                }
                else
                {
                    $('#modalubahsettingcustom').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-settingcustom').DataTable().ajax.reload();
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
function deletesettingcustom($kode) {
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
            var url =  '/setting/customcontroller/hapusdata';

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
                            $('#datatable-settingcustom').DataTable().ajax.reload();
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