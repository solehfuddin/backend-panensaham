 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahsettingcustom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Custom</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('setting/customcontroller/perbaruidata', ['class' => 'formModalubahsettingcustom']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Custom</label>
                  <input class="form-control" type="text"  placeholder="KUGL001" 
                        name="settingcustom_kodeubah" id="settingcustom_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingcustomKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Custom</label>
                  <input class="form-control" type="text" placeholder="User Friendly" 
                        name="settingcustom_judulubah" id="settingcustom_judulubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingcustomJudulubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi Custom</label>
                  <textarea class="form-control" rows="3" name="settingcustom_isiubah" 
                        id="settingcustom_isiubah"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingcustomIsiubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahsettingcustom">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>