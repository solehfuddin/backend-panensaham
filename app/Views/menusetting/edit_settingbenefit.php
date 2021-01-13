 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahsettingbenefit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Benefit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('setting/benefitcontroller/perbaruidata', ['class' => 'formModalubahsettingbenefit']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Keunggulan</label>
                  <input class="form-control" type="text"  placeholder="KUGL001" 
                        name="settingbenefit_kodeubah" id="settingbenefit_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbenefitKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul</label>
                  <input class="form-control" type="text" placeholder="User Friendly" 
                        name="settingbenefit_namaubah" id="settingbenefit_namaubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbenefitNamaubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi</label>
                  <textarea class="form-control" rows="3" name="settingbenefit_deskripsiubah" 
                        id="settingbenefit_deskripsiubah"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingbenefitDeskripsiubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahsettingbenefit">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>