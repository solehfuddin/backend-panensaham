 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahpackagefeature" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Fitur Paket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('package/featurecontroller/simpandata', ['class' => 'formModaltambahpackagefeature']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User Level</label>
                  <select class="form-control" id="packagefeature_kodeuser" name="packagefeature_kodeuser">
                    <?php foreach($data as $item): ?>
                    <option value="<?= $item['kode_user_level']; ?>">
                        <?= $item['nama_level']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Keterangan</label>
                  <textarea class="form-control" rows="3" name="packagefeature_keterangan" 
                        id="packagefeature_keterangan"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagefeatureKeterangan">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahpackagefeature">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>