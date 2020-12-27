 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahaccountuserlevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data User Level</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('account/userlevelcontroller/simpandata', ['class' => 'formModaltambahaccountuserlevel']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User Level</label>
                  <input class="form-control" type="text"  placeholder="MULV001" 
                        name="accountuserlevel_kode" id="accountuserlevel_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama User Level</label>
                  <input class="form-control" type="text" placeholder="User Trial" 
                        name="accountuserlevel_nama" id="accountuserlevel_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelNama">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Alias User Level</label>
                  <input class="form-control" type="text" placeholder="BASIC" 
                        name="accountuserlevel_alias" id="accountuserlevel_alias" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelAlias">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Keterangan</label>
                  <textarea class="form-control" rows="3" name="accountuserlevel_keterangan" 
                        id="accountuserlevel_keterangan"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelKeterangan">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Info Tambahan</label>
                  <textarea class="form-control" rows="3" name="accountuserlevel_infolanjut" 
                        id="accountuserlevel_infolanjut"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountuserlevelInfolanjut">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahaccountuserlevel">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>