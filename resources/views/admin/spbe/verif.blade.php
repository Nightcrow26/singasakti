<form method="post" id="form-detail" action="{{ route('admin.spbe.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        @foreach ($trx as $trx)
            <input type="hidden" name="id" value="{{ $trx->id }}">
        @endforeach
        @foreach ($data as $data)
            <input type="hidden" name="indikator_id" value="{{ $data->id }}">
            <div class="col-md-12">
                <small class="text-light fw-semibold">Domain :</small>
                <p>{{ $data->domainname->nama }}</p>
            </div>
            <div class="col-md-12">
                <small class="text-light fw-semibold">Aspek :</small>
                <p>{{ $data->aspekname->nama }}</p>
            </div>
            <div class="col-md-12">
                <small class="text-light fw-semibold">Indikator :</small>
                <p>{{ $data->nama }}</p>
            </div>

            <div class="col-md-12">
                <p class="demo-inline-spacing">
                    <a class="btn btn-primary me-1 collapsed" data-bs-toggle="collapse" href="#collapseExample"
                        role="button" aria-expanded="false" aria-controls="collapseExample">
                        Penjelasan Indikator
                    </a>
                </p>
                <div class="collapse" id="collapseExample" style="">
                    <div class="d-grid d-sm-flex p-3 border">
                        <span>
                            <div class="col-md-12">
                                <small class="text-light fw-semibold">Keterangan Indikator :</small>
                                <p>{!! $data->ket_indikator !!}</p>
                            </div>
                            <div class="col-md-12">
                                <small class="text-light fw-semibold">Keterangan Penilaian :</small>
                                <p>{!! $data->ket_penilaian !!}</p>
                            </div>
                            <div class="col-md-12">
                                <small class="text-light fw-semibold">Keterangan Bukti Dukung :</small>
                                <p>{!! $data->ket_bukti !!}</p>
                            </div>
                        </span>
                    </div>
                </div>

            </div>

            {{-- <div class="col-sm">
                <small class="text-light fw-semibold">Jawab :</small>
                @foreach ($data->jawabans as $a)
                    @forelse  ($a->jawabanadmin as $c)
                        <div class="form-check mt-3">
                            <input name="jawaban_admin_id" class="form-check-input" type="radio"
                                value="{{ $a->id }}" id="defaultRadio1" checked>
                            <label style="color: black" class="form-check-label" for="defaultRadio1">
                                {{ $a->nama }}
                            </label>
                        </div>
                    @empty
                        <div class="form-check mt-3">
                            <input name="jawaban_admin_id" class="form-check-input" type="radio"
                                value="{{ $a->id }}" id="defaultRadio1">
                            <label style="color: black" class="form-check-label" for="defaultRadio1">
                                {{ $a->nama }}
                            </label>
                        </div>
                    @endforelse
                @endforeach
            </div> --}}

            <div class="col-sm">
                <small class="text-light fw-semibold">Jawab :</small>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Aksi</td>
                            <td>Tingkat</td>
                            <td>Kriteria</td>
                        </tr>
                    </thead>
                    @foreach ($data->jawabans as $a)
                        @forelse  ($a->jawabanadmin as $c)
                            <tbody>
                                {{-- @foreach ($data->jawabans as $a) --}}
                                <tr style="vertical-align: middle;">
                                    <td>
                                        <div class="form-check mt-3">
                                            <input style="height:35px; width:35px;vertical-align: middle;"
                                                name="jawaban_admin_id" class="form-check-input" type="radio"
                                                value="{{ $a->id }}" id="defaultRadio1" checked>

                                        </div>
                                    </td>
                                    <td>
                                        {{ $a->nilai }}
                                    </td>
                                    <td>
                                        <label class="form-check-label">
                                            {{ $a->nama }}
                                            <a class="btn btn-xs rounded-pill btn-icon btn-secondary collapsed ml-5"
                                                data-bs-toggle="collapse" href="#collapseExample{{ $a->id }}"
                                                role="button" aria-expanded="false"
                                                aria-controls="collapseExample{{ $a->id }}">
                                                ?
                                            </a>
                                        </label>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="hiddenRow" style="padding: 0 !important;">
                                        <div class="col-md-12">
                                            <div class="collapse" id="collapseExample{{ $a->id }}"
                                                style="">
                                                <div class="d-grid d-sm-flex p-3 border">
                                                    <span>
                                                        <div class="col-md-12">
                                                            <small class="text-light fw-semibold">Keterangan Tingkat
                                                                :</small>
                                                            <p>{!! $a->ket_level !!}</p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <small class="text-light fw-semibold">Keterangan Bukti
                                                                Dukug
                                                                :</small>
                                                            <p>{!! $a->ket_bukti !!}</p>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            @empty


                                {{-- @foreach ($data->jawabans as $a) --}}
                                <tr style="vertical-align: middle;">
                                    <td>
                                        <div class="form-check mt-3">
                                            <input style="height:35px; width:35px;vertical-align: middle;"
                                                name="jawaban_admin_id" class="form-check-input" type="radio"
                                                value="{{ $a->id }}" id="defaultRadio1">

                                        </div>
                                    </td>
                                    <td>
                                        {{ $a->nilai }}
                                    </td>
                                    <td>
                                        <label class="form-check-label">
                                            {{ $a->nama }}
                                            <a class="btn btn-xs rounded-pill btn-icon btn-secondary collapsed ml-5"
                                                data-bs-toggle="collapse" href="#collapseExample{{ $a->id }}"
                                                role="button" aria-expanded="false"
                                                aria-controls="collapseExample{{ $a->id }}">
                                                ?
                                            </a>
                                        </label>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="hiddenRow" style="padding: 0 !important;">
                                        <div class="col-md-12">
                                            <div class="collapse" id="collapseExample{{ $a->id }}"
                                                style="">
                                                <div class="d-grid d-sm-flex p-3 border">
                                                    <span>
                                                        <div class="col-md-12">
                                                            <small class="text-light fw-semibold">Keterangan Tingkat
                                                                :</small>
                                                            <p>{!! $a->ket_level !!}</p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <small class="text-light fw-semibold">Keterangan Bukti
                                                                Dukug
                                                                :</small>
                                                            <p>{!! $a->ket_bukti !!}</p>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                        @endforelse
                        {{-- @endforeach --}}
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-12 mt-4">
                <small class="text-light fw-semibold">Catatan :</small>
                @foreach ($catatan as $catatan)
                    <textarea name="komen" id="komen" cols="30" rows="10" class="form-control">{{ $catatan->komen }}</textarea>
                @endforeach
            </div>

    </div>
    @endforeach
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="submit" id="tombol" class="btn btn-primary">Verifikasi</button>
        <button type="submit" id="loading" class="btn btn-warning" style="display: none;"
            disabled>LOADING......</button>
    </div>
</form>

<script>
    var i = 1;

    $(document).on('click', '.btn_remove_lampiran', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });


    $('#add_lampiran').click(function() {
        i++;
        $('#dynamic_field_lampiran').append('<tr id="row' + i +
            '" class="dynamic-added"><td><input type="file" id="file" name="file[]" class="form-control file_list" required></td><td><button type="button" name="remove" id="' +
            i + '" class="btn btn-danger btn_remove_lampiran">x</button></td></tr>');
    });


    $('#form-detail').on('submit', function(e) {
        e.preventDefault()

        $("#form-detail").ajaxSubmit({
            beforeSend: function() {
                $('#tombol').hide();
                $('#loading').show();
            },
            success: function(res) {
                console.log(res)
                if (res.status == "failed") {
                    swal('NIK sudah terdaftar', '', 'error');
                    $('#tombol').show();
                    $('#loading').hide();
                } else if (res.status = "success") {
                    // $('#table').DataTable().ajax.reload();
                    // location.reload();
                    swal('Data Berhasil Di Simpan', '', 'success');
                    location.reload();
                    //set semua ke default
                    $("#form-detail input:not([name='_token']").val('')
                    $("#modal-detail").modal('hide')
                    $('#tombol').show();
                    $('#loading').hide();
                }

            }
        })
        return true;

    })
</script>
