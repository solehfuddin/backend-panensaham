 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahaccountuserlevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data User Level</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('account/userlevelcontroller/perbaruidata', ['class' => 'formModalubahaccountuserlevel']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User Level</label>
                  <input class="form-control" type="text"  placeholder="MULV001" 
                        name="accountuserlevel_kodeubah" id="accountuserlevel_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama User Level</label>
                  <input class="form-control" type="text" placeholder="User Trial" 
                        name="accountuserlevel_namaubah" id="accountuserlevel_namaubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelNamaubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Alias User Level</label>
                  <input class="form-control" type="text" placeholder="BASIC" 
                        name="accountuserlevel_aliasubah" id="accountuserlevel_aliasubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelAliasubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Keterangan</label>
                  <textarea class="form-control" rows="3" name="accountuserlevel_keteranganubah" 
                        id="accountuserlevel_keteranganubah"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelKeteranganubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Info Tambahan</label>
                  <textarea class="form-control" rows="3" name="accountuserlevel_infolanjutubah" 
                        id="accountuserlevel_infolanjutubah"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelInfolanjutubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahaccountuserlevel">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>