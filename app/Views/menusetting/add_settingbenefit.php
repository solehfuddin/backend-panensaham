 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahsettingbenefit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Benefit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('setting/benefitcontroller/simpandata', ['class' => 'formModaltambahsettingbenefit']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Keunggulan</label>
                  <input class="form-control" type="text"  placeholder="KUGL001" 
                        name="settingbenefit_kode" id="settingbenefit_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbenefitKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul</label>
                  <input class="form-control" type="text" placeholder="User Friendly" 
                        name="settingbenefit_nama" id="settingbenefit_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbenefitNama">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
                  <textarea class="form-control" rows="3" name="settingbenefit_deskripsi" 
                        id="settingbenefit_deskripsi"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbenefitDeskripsi">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahsettingbenefit">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>