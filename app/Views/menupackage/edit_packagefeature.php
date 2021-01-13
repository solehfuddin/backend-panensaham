 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahpackagefeature" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Fitur Paket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('package/featurecontroller/perbaruidata', ['class' => 'formModalubahpackagefeature']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User Level</label>
                  <input type="hidden" class="form-control" id="packagefeature_kode" name="packagefeature_kode" />
                  <select class="form-control" id="packagefeature_kodeuserubah" name="packagefeature_kodeuserubah">
                    <?php foreach($data as $item): ?>
                        <option value="<?= $item['kode_user_level']; ?>">
                            <?= $item['nama_level']; ?>
                        </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Keterangan</label>
                  <textarea class="form-control" rows="3" name="packagefeature_keteranganubah" 
                        id="packagefeature_keteranganubah"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagefeatureKeteranganubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahpackagefeature">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>