<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="form-create" action="{{ route('nomen.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="jenis" name="jenis" value="urusan">
                        <div class="col-12 mt-3">
                            <label for="bidang">Urusan <small class="text-danger">*</small></label>
                            <select name="ref_urusan" id="urusan_id_1">
                                <option value="">Pilih Urusan</option>
                                @foreach ($urusan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
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

<div class="modal fade" id="modal-create-bidang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="form-create-bidang" action="{{ route('nomen.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="jenis" name="jenis" value="bidang_urusan">
                        <div class="col-12 mt-3">
                            <label for="bidang">Urusan <small class="text-danger">*</small></label>
                            <select name="ref_urusan" id="urusan_id_2">
                                <option value="">Pilih Urusan</option>
                                @foreach ($urusan as $urusan2)
                                    <option value="{{ $urusan2->id }}">{{ $urusan2->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="bidang_urusan_id">Bidang Urusan<small class="text-danger">*</small></label>
                            <select name="ref_bidang_urusan" id="bidang_urusan_id_2" style="width:100%" required>
                                <option value="">Pilih Bidang Urusan</option>
                            </select>
                        </div>
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

<div class="modal fade" id="modal-create-program" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="form-create-program" action="{{ route('nomen.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="jenis" name="jenis" value="program">
                        <div class="col-12 mt-3">
                            <label for="bidang">Urusan <small class="text-danger">*</small></label>
                            <select name="ref_urusan" id="urusan_id_3" style="width:100%" required>
                                <option value="">Pilih Urusan</option>
                                @foreach ($urusan as $urusan3)
                                    <option value="{{ $urusan3->id }}">{{ $urusan3->nama }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="bidang_urusan_id">Bidang Urusan<small class="text-danger">*</small></label>
                            <select name="ref_bidang_urusan" id="bidang_urusan_id_3" style="width:100%" required>
                                <option value="">Pilih Bidang Urusan</option>
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="program_id">Program<small class="text-danger">*</small></label>
                            <select name="ref_program" id="program_id_3" style="width:100%" required>
                                <option value="">Pilih Program</option>
                            </select>
                        </div>
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

<div class="modal fade" id="modal-create-kegiatan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="form-create-kegiatan" action="{{ route('nomen.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="jenis" name="jenis" value="kegiatan">
                        <div class="col-12 mt-3">
                            <label for="bidang">Urusan <small class="text-danger">*</small></label>
                            <select name="ref_urusan" id="urusan_id_4" style="width:100%" required>
                                <option value="">Pilih Urusan</option>
                                @foreach ($urusan as $urusan4)
                                    <option value="{{ $urusan4->id }}">{{ $urusan4->nama }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="bidang_urusan_id">Bidang Urusan<small class="text-danger">*</small></label>
                            <select name="ref_bidang_urusan" id="bidang_urusan_id_4" style="width:100%" required>
                                <option value="">Pilih Bidang Urusan</option>
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="program_id">Program<small class="text-danger">*</small></label>
                            <select name="ref_program" id="program_id_4" style="width:100%" required>
                                <option value="">Pilih Program</option>
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="kegiatan_id_4">Kegiatan<small class="text-danger">*</small></label>
                            <select name="ref_kegiatan" id="kegiatan_id_4" style="width:100%" required>
                                <option value="">Pilih Kegiatan</option>
                            </select>
                        </div>
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

<div class="modal fade" id="modal-create-sub" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="form-create-sub" action="{{ route('nomen.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="jenis" name="jenis" value="sub_kegiatan">
                        <div class="col-12 mt-3">
                            <label for="bidang">Urusan <small class="text-danger">*</small></label>
                            <select name="ref_urusan" id="urusan_id" style="width:100%" required>
                                <option value="">Pilih Urusan</option>
                                @foreach ($urusan as $urusan5)
                                    <option value="{{ $urusan5->id }}">{{ $urusan5->nama }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="bidang_urusan_id">Bidang Urusan<small class="text-danger">*</small></label>
                            <select name="ref_bidang_urusan" id="bidang_urusan_id" style="width:100%" required>
                                <option value="">Pilih Bidang Urusan</option>
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="program_id">Program<small class="text-danger">*</small></label>
                            <select name="ref_program" id="program_id" style="width:100%" required>
                                <option value="">Pilih Program</option>
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="kegiatan_id">Kegiatan<small class="text-danger">*</small></label>
                            <select name="ref_kegiatan" id="kegiatan_id" style="width:100%" required>
                                <option value="">Pilih Kegiatan</option>
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="sub_kegiatan_id">Sub Kegiatan<small class="text-danger">*</small></label>
                            <select name="ref_sub_kegiatan" id="sub_kegiatan_id" style="width:100%" required>
                                <option value="">Pilih Sub Kegiatan</option>
                            </select>
                        </div>

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



<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-edit" action="{{ route('urusan.update') }}"
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
