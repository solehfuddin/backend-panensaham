 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahaccountadministrator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Administrator</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('account/administratorcontroller/perbaruidata', ['class' => 'formModalubahaccountadministrator']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User</label>
                  <input class="form-control" type="text"  placeholder="TUSR001" 
                        name="accountadministrator_kodeubah" id="accountadministrator_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountadministratorKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Username</label>
                  <input class="form-control" type="text"  placeholder="john" 
                        name="accountadministrator_usernameubah" id="accountadministrator_usernameubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountadministratorUsernameubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Nama Lengkap</label>
                  <input class="form-control" type="text"  placeholder="John Doe" 
                        name="accountadministrator_fullnameubah" id="accountadministrator_fullnameubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountadministratorFullnameubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Alamat Email</label>
                  <input class="form-control" type="text"  placeholder="john_doe@trl.co" 
                        name="accountadministrator_emailubah" id="accountadministrator_emailubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountadministratorEmailubah">test</div>
                </div>

                <!-- <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Password</label>
                  <input class="form-control" type="password"  placeholder="*******" 
                        name="accountadministrator_passwordubah" id="accountadministrator_passwordubah" /> -->
                  <!-- Error Validation -->
                  <!-- <div class="invalid-feedback bg-secondary errorAccountadministratorPasswordubah">test</div>
                </div> -->

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Jenis Kelamin</label>
                  <select class="form-control" id="accountadministrator_genderubah" name="accountadministrator_genderubah">
                    <option value="Laki-laki">
                        Laki-laki
                    </option>
                    <option value="Perempuan">
                        Perempuan
                    </option>
                  </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal" 
                onClick="changepassword(document.getElementById('accountadministrator_kodeubah').value)">Ubah Sandi</button>
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> -->
            <button type="submit" class="btn btn-primary btnmodalubahaccountadministrator">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>

<?= $this->include('menuaccount/pass_accountadministrator'); ?>