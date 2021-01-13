 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahsettingcustom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Custom</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('setting/customcontroller/simpandata', ['class' => 'formModaltambahsettingcustom']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Custom</label>
                  <input class="form-control" type="text"  placeholder="KUGL001" 
                        name="settingcustom_kode" id="settingcustom_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingcustomKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Custom</label>
                  <input class="form-control" type="text" placeholder="User Friendly" 
                        name="settingcustom_judul" id="settingcustom_judul" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingcustomJudul">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi Custom</label>
                  <textarea class="form-control" rows="3" name="settingcustom_isi" 
                        id="settingcustom_isi"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSettingcustomIsi">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahsettingcustom">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>