 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahaccountmember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jenis Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('account/membercontroller/simpandata', ['class' => 'formModaltambahaccountmember']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Jenis Member</label>
                  <input class="form-control" type="text"  placeholder="JMBR001" 
                        name="accountmember_kode" id="accountmember_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountmemberKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Keterangan</label>
                  <input class="form-control" type="text" placeholder="Member Baru" 
                        name="accountmember_nama" id="accountmember_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorAccountmemberNama">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahaccountmember">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>