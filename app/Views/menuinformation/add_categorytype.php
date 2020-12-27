 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahcategorytype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('information/categorycontroller/simpandata', ['class' => 'formModaltambahcategorytype']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Kategori Pengumuman</label>
                  <input class="form-control" type="text"  placeholder="KTPM001" 
                        name="infocategory_kode" id="infocategory_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfocategoriKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama Kategori Pengumuman</label>
                  <input class="form-control" type="text" placeholder="HOT" 
                        name="infocategory_nama" id="infocategory_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfocategoryeNama">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahcategorytype">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>