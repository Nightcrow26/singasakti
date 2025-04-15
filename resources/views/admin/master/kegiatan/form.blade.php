<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-create" action="{{ route('kegiatan.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama">Nama <small class="text-danger">*</small></label>
                            <input type="text" style="color: black" name="nama" class="form-control h5 text-black"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                        <button type="submit" id="loading" class="btn btn-warning" style="display: none;"
                            disabled>LOADING......</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-edit" action="{{ route('kegiatan.update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="idEdit">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama">Nama <small class="text-danger">*</small></label>
                            <input type="text" style="color: black" id="namaEdit" name="nama"
                                class="form-control h5" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                        <button type="submit" id="loading" class="btn btn-warning" style="display: none;"
                            disabled>LOADING......</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
