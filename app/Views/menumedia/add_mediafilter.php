 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahmediafilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Filter Media</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('media/filtermedcontroller/simpandata', ['class' => 'formModaltambahmediafilter']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Filter Media</label>
                  <input class="form-control" type="text"  placeholder="FMED001" 
                        name="mediafilter_kode" id="mediafilter_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediafilterKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Filter</label>
                  <input class="form-control" type="text" placeholder="Video Utama" 
                        name="mediafilter_nama" id="mediafilter_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorMediafilterNama">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahmediafilter">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>