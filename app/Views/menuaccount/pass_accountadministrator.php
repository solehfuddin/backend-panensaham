 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalpasswordaccountadministrator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('account/administratorcontroller/perbaruipassword', ['class' => 'formModalubahpassadministrator']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User</label>
                  <input class="form-control" type="text"  placeholder="TUSR001" 
                        name="passadministrator_kodeubah" id="passadministrator_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPassadministratorKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Password Baru</label>
                  <input class="form-control" type="password"  placeholder="*******" 
                        name="passadministrator_passwordbaru" id="passadministrator_passwordbaru" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPassadministratorPasswordbaru">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Konfirmasi Password</label>
                  <input class="form-control" type="password"  placeholder="*******" 
                        name="passadministrator_passwordkonfirmasi" id="passadministrator_passwordkonfirmasi" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPassadministratorPasswordkonfirmasi">test</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahpassadministrator">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>