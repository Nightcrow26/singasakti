<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-create" action="{{ route('master.user.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama">Username <small class="text-danger">*</small></label>
                            <input type="text" style="color: black" name="name" class="form-control h5 text-black"
                                required>
                        </div>
                        <div class="col-md-12">
                            <label for="password">Password <small class="text-danger">*</small></label>
                            <input type="password" style="color: black" name="password" class="form-control h5"
                                required>
                        </div>
                        <div class="col-md-12">
                            <label for="skpd_id">SKPD <small class="text-danger">*</small></label>
                            <select name="skpd_id" class="form-control h5" required>
                                <option value="">Pilih SKPD</option>
                                @foreach ($skpd as $skpd)
                                    <option value="{{ $skpd->id }}">{{ $skpd->nama }}</option>
                                @endforeach
                            </select>
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
                <form method="post" id="form-edit" action="{{ route('master.user.update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="idEdit">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama">Username <small class="text-danger">*</small></label>
                            <input type="text" style="color: black" name="name" id="nameEdit"
                                class="form-control h5 text-black" required>
                        </div>
                        <div class="col-md-12">
                            <label for="password">Password <small class="text-danger">*</small></label>
                            <input type="password" style="color: black" name="password" id="passwordEdit"
                                class="form-control h5">
                        </div>
                        <div class="col-md-12">
                            <label for="skpd_id">SKPD <small class="text-danger">*</small></label>
                            <select name="skpd_id" class="form-control h5" id="skpd_idEdit" required>
                            </select>
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
