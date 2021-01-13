 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahpackageprice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Harga Paket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('package/pricecontroller/perbaruidata', ['class' => 'formModalubahpackageprice']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Harga Paket</label>
                  <input class="form-control" type="text" placeholder="HPKT001" 
                        name="packageprice_kodeubah" id="packageprice_kodeubah" readonly />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapricekodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Jenis Member</label>
                  <select class="form-control" id="packageprice_jenismemberubah" name="packageprice_jenismemberubah">
                    <?php foreach($mbrlevel as $item): ?>
                    <option value="<?= $item['kode_jenis_member']; ?>">
                        <?= $item['jenis_member']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode User Level</label>
                  <select class="form-control" id="packageprice_kodeuserubah" name="packageprice_kodeuserubah">
                    <?php foreach($usrlevel as $item): ?>
                    <option value="<?= $item['kode_user_level']; ?>">
                        <?= $item['nama_level']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Harga Paket</label>
                  <input class="form-control" type="text" placeholder="1.000.000" 
                        name="packageprice_hargaubah" id="packageprice_hargaubah" />

                  <input class="form-control" type="hidden" placeholder="1.000.000" 
                        name="packageprice_hargatmpubah" id="packageprice_hargatmpubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagapriceharga">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Durasi Paket</label>
                  <select class="form-control" id="packageprice_durasiubah" name="packageprice_durasiubah">
                    <?php for($i = 1; $i <= 12; $i++): ?>
                    <option value="<?= $i; ?>">
                        <?= $i; ?>
                    </option>
                    <?php endfor ?>
                  </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahpackageprice">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>