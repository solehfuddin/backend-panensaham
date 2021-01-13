 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahaccountadministrator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Administrator</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('account/administratorcontroller/simpandata', ['class' => 'formModaltambahaccountadministrator']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User</label>
                  <input class="form-control" type="text"  placeholder="TUSR001" 
                        name="accountadministrator_kode" id="accountadministrator_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountadministratorKode">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Username</label>
                  <input class="form-control" type="text"  placeholder="john" 
                        name="accountadministrator_username" id="accountadministrator_username" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountadministratorUsername">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Nama Lengkap</label>
                  <input class="form-control" type="text"  placeholder="John Doe" 
                        name="accountadministrator_fullname" id="accountadministrator_fullname" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountadministratorFullname">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Alamat Email</label>
                  <input class="form-control" type="text"  placeholder="john_doe@trl.co" 
                        name="accountadministrator_email" id="accountadministrator_email" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountadministratorEmail">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Password</label>
                  <input class="form-control" type="password"  placeholder="*******" 
                        name="accountadministrator_password" id="accountadministrator_password" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountadministratorPassword">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Jenis Kelamin</label>
                  <select class="form-control" id="accountadministrator_gender" name="accountadministrator_gender">
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahaccountadministrator">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>