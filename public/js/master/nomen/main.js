$(document).ready(function() {
    datatable();
});


$('#modal-create').on('shown.bs.modal', function () {
    $('.select2').select2(); // Reinitialize Select2
});

$('#modal-create-bidang').on('shown.bs.modal', function () {
    $('.select2').select2(); // Reinitialize Select2
});
function AddModal() {
    $('#addModal').modal('show');
}

function datatable() {
    $('#table')
        .DataTable()
        .destroy();

    $('#table').DataTable({
        processing: true,
        serverSide: true,
        // language: {
        //     processing: "<img src='" + window.origin + "/img/805.gif'> Memuat Data",
        //     paginate: {
        //         next: '<span class="fa fa-angle-right"></span>',
        //         previous: '<span class="fa fa-angle-left"></span>'
        //     }
        // },
        ajax: window.location.origin + '/master/data?type=nomen',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'kode_prencanaan',
                name: 'kode_prencanaan',
                defaultContent: ''
            },
            {
                data: 'urusan.nama',
                name: 'urusan.nama',
            defaultContent: ''
            },
            {
                data: 'bidang.nama',
                name: 'bidang.nama',
            defaultContent: ''
            },
            {
                data: 'program.nama',
                name: 'program.nama',
            defaultContent: ''
            },
            {
                data: 'kegiatan.nama',
                name: 'kegiatan.nama',
            defaultContent: ''
            },
            {
                data: 'sub.nama',
                name: 'sub.nama',
            defaultContent: ''
            },
            {
                data: 'jenis',
                name: 'jenis',
            defaultContent: ''
            },
            {
                data: 'buttonnomen',
                name: 'buttonnomen'
            }
        ]
    });
}

$('#form-create').on('submit', function(e) {
    e.preventDefault()

    $("#form-create").ajaxSubmit({
        beforeSend: function() {
            $('#tombol').hide();
            $('#loading').show();
        },
        success: function(res) {
            console.log(res)
            if (res.status == "failed") {
                swal('Nomenklatur Sudah ada', '', 'error');
                $('#tombol').show();
                $('#loading').hide();
            } else if (res.status = "success") {
               location.reload();
                // $('#table').DataTable().ajax.reload();
                // location.reload();
                swal('Data Berhasil Di Simpan', '', 'success');
                //set semua ke default
                $("#form-create input:not([name='_token']").val('')
                $("#modal-create").modal('hide')
                $('#tombol').show();
                $('#loading').hide();
            }

        }
    })
    return true;

})

$('#form-create-bidang').on('submit', function(e) {
    e.preventDefault()

    $("#form-create-bidang").ajaxSubmit({
        beforeSend: function() {
            $('#tombol').hide();
            $('#loading').show();
        },
        success: function(res) {
            console.log(res)
            if (res.status == "failed") {
                swal('Nomenklatur Sudah ada', '', 'error');
                $('#tombol').show();
                $('#loading').hide();
            } else if (res.status = "success") {
               location.reload();
                // $('#table').DataTable().ajax.reload();
                // location.reload();
                swal('Data Berhasil Di Simpan', '', 'success');
                //set semua ke default
                $("#form-create-bidang input:not([name='_token']").val('')
                $("#modal-create-bidang").modal('hide')
                $('#tombol').show();
                $('#loading').hide();
            }

        }
    })
    return true;

})

$('#form-create-program').on('submit', function(e) {
    e.preventDefault()

    $("#form-create-program").ajaxSubmit({
        beforeSend: function() {
            $('#tombol').hide();
            $('#loading').show();
        },
        success: function(res) {
            console.log(res)
            if (res.status == "failed") {
                swal('Nomenklatur Sudah ada', '', 'error');
                $('#tombol').show();
                $('#loading').hide();
            } else if (res.status = "success") {
               location.reload();
                // $('#table').DataTable().ajax.reload();
                // location.reload();
                swal('Data Berhasil Di Simpan', '', 'success');
                //set semua ke default
                $("#form-create-program input:not([name='_token']").val('')
                $("#modal-create-program").modal('hide')
                $('#tombol').show();
                $('#loading').hide();
            }

        }
    })
    return true;

})

$('#form-create-kegiatan').on('submit', function(e) {
    e.preventDefault()

    $("#form-create-kegiatan").ajaxSubmit({
        beforeSend: function() {
            $('#tombol').hide();
            $('#loading').show();
        },
        success: function(res) {
            console.log(res)
            if (res.status == "failed") {
                swal('Nomenklatur Sudah ada', '', 'error');
                $('#tombol').show();
                $('#loading').hide();
            } else if (res.status = "success") {
               location.reload();
                // $('#table').DataTable().ajax.reload();
                // location.reload();
                swal('Data Berhasil Di Simpan', '', 'success');
                //set semua ke default
                $("#form-create-kegiatan input:not([name='_token']").val('')
                $("#modal-create-kegiatan").modal('hide')
                $('#tombol').show();
                $('#loading').hide();
            }

        }
    })
    return true;

})

$('#form-create-sub').on('submit', function(e) {
    e.preventDefault()

    $("#form-create-sub").ajaxSubmit({
        beforeSend: function() {
            $('#tombol').hide();
            $('#loading').show();
        },
        success: function(res) {
            console.log(res)
            if (res.status == "failed") {
                swal('Nomenklatur Sudah ada', '', 'error');
                $('#tombol').show();
                $('#loading').hide();
            } else if (res.status = "success") {
               location.reload();
                // $('#table').DataTable().ajax.reload();
                // location.reload();
                swal('Data Berhasil Di Simpan', '', 'success');
                //set semua ke default
                $("#form-create-sub input:not([name='_token']").val('')
                $("#modal-create-sub").modal('hide')
                $('#tombol').show();
                $('#loading').hide();
            }

        }
    })
    return true;

})


function edit(id) {
    $.ajax({
        url: window.location.origin + '/master/data/show?type=nomen',
        method: "GET",
        data: { id: id, _token: '{{ csrf_token() }}' },
        success: function(response) {
            console.log(response)
            $('#idEdit').empty();
            $('#namaEdit').empty();
            $('#idEdit').val(id);
            $('#namaEdit').val(response['nama']);

        }
    })
}

$('#form-edit').on('submit', function(e) {
    e.preventDefault()

    $("#form-edit").ajaxSubmit({
        beforeSend: function() {
            $('#tombol').hide();
            $('#loading').show();
        },
        success: function(res) {
            if (res.status == "failed") {
                swal('Nomenklatur Sudah ada', '', 'error');
                $('#tombol').show();
                $('#loading').hide();
            } else if (res.status = "success") {
               location.reload();
                // $('#table').DataTable().ajax.reload();
                // location.reload();
                swal('Data Berhasil Di Simpan', '', 'success');
                //set semua ke default
                $("#form-edit input:not([name='_token']").val('')
                $("#modal-edit").modal('hide')
                $('#tombol').show();
                $('#loading').hide();
            }
        }
    })
    return true;

})


function deletebtn(id) {
    var token = '{{ csrf_token() }}'
    swal({
            title: 'Anda Yakin Ingin Menghapus Data?',
            text: '',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: window.location.origin + '/master/data/delete',
                    method: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: { id: id, type: 'nomen' },
                    success: function(results) {
                       location.reload();
                        // $('#table').DataTable().ajax.reload();
                        swal('Berhasil Menghapus Data', {
                            icon: 'success',
                        });
                    }
                });

            } else {
                swal('Data Batal Dihapus');
            }
        });

}




            var tomSelect1 = new TomSelect("#bidang_urusan_id", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            var tomSelect2 = new TomSelect("#program_id", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            var tomSelect3 = new TomSelect("#kegiatan_id", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            var tomSelect4 = new TomSelect("#sub_kegiatan_id", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });



            var tomSelect7 = new TomSelect("#bidang_urusan_id_2", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            var tomSelect8 = new TomSelect("#bidang_urusan_id_3", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            var tomSelect9 = new TomSelect("#program_id_3", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            var tomSelect10 = new TomSelect("#bidang_urusan_id_4", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            var tomSelect11 = new TomSelect("#program_id_4", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });


            var tomSelect12 = new TomSelect("#kegiatan_id_4", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });


    $(function() {
            $('#urusan_id').on('change', function() {
                id = $("#urusan_id").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/bidang",
                    method: "POST",
                    data: {
                        id: id
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {

                        $('#bidang_urusan_id').empty();
                        $('#program_id').empty();
                        $('#kegiatan_id').empty();
                        $('#sub_kegiatan_id').empty();
                        $('select[id="bidang_urusan_id"]').append(
                            '<option value="">Pilih Bidang Urusan</option>');
                        $('select[id="program_id"]').append(
                            '<option value="">Pilih Program</option>');
                        $('select[id="kegiatan_id"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        $('select[id="sub_kegiatan_id"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="bidang_urusan_id"]').append(
                        //         '<option value="' + id + '">' + nama + '</option>');
                        // })


                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect1.addOption({value: id, text: nama});
                        });

                        // program()
                        // kegiatan()
                    }
                })
            });
        });

        $(function() {
            $('#bidang_urusan_id').on('change', function() {
                ref_urusan = $("#urusan_id").val()
                ref_bidang_urusan = $("#bidang_urusan_id").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/program",
                    method: "POST",
                    data: {
                        ref_urusan: ref_urusan,
                        ref_bidang_urusan: ref_bidang_urusan
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {

                        $('#program_id').empty();
                        $('#kegiatan_id').empty();
                        $('#sub_kegiatan_id').empty();
                        $('select[id="program_id"]').append(
                            '<option value="">Pilih Program</option>');
                        $('select[id="kegiatan_id"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        $('select[id="sub_kegiatan_id"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="program_id"]').append('<option value="' + id +
                        //         '">' + nama + '</option>');
                        // })
                        // kegiatan()



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect2.addOption({value: id, text: nama});
                        });

                    }
                })
            });
        });

        $(function() {
            $('#program_id').on('change', function() {
                ref_urusan = $("#urusan_id").val()
                ref_bidang_urusan = $("#bidang_urusan_id").val()
                ref_program = $("#program_id").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/kegiatan",
                    method: "POST",
                    data: {
                        ref_urusan: ref_urusan,
                        ref_bidang_urusan: ref_bidang_urusan,
                        ref_program: ref_program
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {

                        $('#kegiatan_id').empty();
                        $('#sub_kegiatan_id').empty();
                        $('select[id="kegiatan_id"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        $('select[id="sub_kegiatan_id"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="kegiatan_id"]').append('<option value="' +
                        //         id + '">' + nama + '</option>');
                        // })
                        // kegiatan()



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect3.addOption({value: id, text: nama});
                        });

                    }
                })
            });
        });

        $(function() {
            $('#kegiatan_id').on('change', function() {
                ref_urusan = $("#urusan_id").val()
                ref_bidang_urusan = $("#bidang_urusan_id").val()
                ref_program = $("#program_id").val()
                ref_kegiatan = $("#kegiatan_id").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/sub",
                    method: "POST",
                    data: {
                        ref_urusan: ref_urusan,
                        ref_bidang_urusan: ref_bidang_urusan,
                        ref_program: ref_program,
                        ref_kegiatan: ref_kegiatan
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {

                        $('#sub_kegiatan_id').empty();
                        $('select[id="sub_kegiatan_id"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="sub_kegiatan_id"]').append('<option value="' +
                        //         id + '">' + nama + '</option>');
                        // })



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect4.addOption({value: id, text: nama});
                        });

                        // kegiatan()
                    }
                })
            });
        });


        function program() {
            ref_urusan = $("#urusan_id").val()
            ref_bidang_urusan = $("#bidang_urusan_id").val()

            $.ajax({
                url: window.location.origin +"/master/nomen/program",
                method: "POST",
                data: {
                    ref_urusan: ref_urusan,
                    ref_bidang_urusan: ref_bidang_urusan,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    $('#program_id').empty();

                    // $.each(response, function(id, nm_kegiatan) {
                    //     $('select[name="program_id"]').append('<option value="' + id + '">' +
                    //         nm_kegiatan + '</option>');
                    // })



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect2.addOption({value: id, text: nama});
                        });

                }
            })
        }


        function kegiatan() {
            ref_urusan = $("#urusan_id").val()
            ref_bidang_urusan = $("#bidang_urusan_id").val()
            ref_program = $("#program_id").val()

            $.ajax({
                url: window.location.origin +"/master/nomen/kegiatan",
                method: "POST",
                data: {
                    ref_urusan: ref_urusan,
                    ref_bidang_urusan: ref_bidang_urusan,
                    ref_program: ref_program,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    $('#kegiatan_id').empty();

                    // $.each(response, function(id, nm_kegiatan) {
                    //     $('select[name="kegiatan_id"]').append('<option value="' + id + '">' +
                    //         nm_kegiatan + '</option>');
                    // })




                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect3.addOption({value: id, text: nama});
                        });

                }
            })
        }

        $(function() {
            $('#urusan_id_2').on('change', function() {
                id = $("#urusan_id_2").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/bidang",
                    method: "POST",
                    data: {
                        id: id
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {

                        $('#bidang_urusan_id_2').empty();
                        $('select[id="bidang_urusan_id_2"]').append(
                            '<option value="">Pilih Bidang Urusan</option>');
                        // })


                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect7.addOption({value: id, text: nama});
                        });

                    }
                })
            });
        });



        $(function() {
            $('#urusan_id_3').on('change', function() {
                id = $("#urusan_id_3").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/bidang",
                    method: "POST",
                    data: {
                        id: id
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {

                        $('#bidang_urusan_id_3').empty();
                        $('#program_id_3').empty();
                        $('select[id="bidang_urusan_id_3"]').append(
                            '<option value="">Pilih Bidang Urusan</option>');
                        $('select[id="program_id_3"]').append(
                            '<option value="">Pilih Program</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="bidang_urusan_id_3"]').append(
                        //         '<option value="' + id + '">' + nama + '</option>');
                        // })



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect8.addOption({value: id, text: nama});
                        });

                    }
                })
            });
        });




        $(function() {
            $('#bidang_urusan_id_3').on('change', function() {
                ref_urusan = $("#urusan_id_3").val()
                ref_bidang_urusan = $("#bidang_urusan_id_3").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/program",
                    method: "POST",
                    data: {
                        ref_urusan: ref_urusan,
                        ref_bidang_urusan: ref_bidang_urusan
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {

                        $('#program_id_3').empty();
                        $('#kegiatan_id_3').empty();
                        $('#sub_kegiatan_id_3').empty();
                        $('select[id="program_id_3"]').append(
                            '<option value="">Pilih Program</option>');
                        $('select[id="kegiatan_id_3"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        $('select[id="sub_kegiatan_id_3"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="program_id_3"]').append('<option value="' +
                        //         id + '">' + nama + '</option>');
                        // })
                        // kegiatan()



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect9.addOption({value: id, text: nama});
                        });

                    }
                })
            });
        });


        $(function() {
            $('#urusan_id_4').on('change', function() {
                id = $("#urusan_id_4").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/bidang",
                    method: "POST",
                    data: {
                        id: id
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {


                        $('#bidang_urusan_id_4').empty();
                        $('#program_id_4').empty();
                        $('#kegiatan_id_4').empty();
                        $('select[id="bidang_urusan_id_4"]').append(
                            '<option value="">Pilih Bidang Urusan</option>');
                        $('select[id="program_id_4"]').append(
                            '<option value="">Pilih Program</option>');
                        $('select[id="kegiatan_id_4"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="bidang_urusan_id_4"]').append(
                        //         '<option value="' + id + '">' + nama + '</option>');
                        // })



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect10.addOption({value: id, text: nama});
                        });



                    }
                })
            });
        });




        $(function() {
            $('#bidang_urusan_id_4').on('change', function() {
                ref_urusan = $("#urusan_id_4").val()
                ref_bidang_urusan = $("#bidang_urusan_id_4").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/program",
                    method: "POST",
                    data: {
                        ref_urusan: ref_urusan,
                        ref_bidang_urusan: ref_bidang_urusan
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {

                        $('#program_id_4').empty();
                        $('#kegiatan_id_4').empty();
                        $('#sub_kegiatan_id_4').empty();
                        $('select[id="program_id_4"]').append(
                            '<option value="">Pilih Program</option>');
                        $('select[id="kegiatan_id_4"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        $('select[id="sub_kegiatan_id_4"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="program_id_4"]').append('<option value="' +
                        //         id + '">' + nama + '</option>');
                        // })
                        // kegiatan()



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect11.addOption({value: id, text: nama});
                        });

                    }
                })
            });
        });

        $(function() {
            $('#program_id_4').on('change', function() {
                ref_urusan = $("#urusan_id_4").val()
                ref_bidang_urusan = $("#bidang_urusan_id_4").val()
                ref_program = $("#program_id_4").val()


                $.ajax({
                    url: window.location.origin +"/master/nomen/kegiatan",
                    method: "POST",
                    data: {
                        ref_urusan: ref_urusan,
                        ref_bidang_urusan: ref_bidang_urusan,
                        ref_program: ref_program
                    },
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {


                        $('#kegiatan_id_4').empty();
                        $('#sub_kegiatan_id_4').empty();
                        $('select[id="kegiatan_id_4"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        $('select[id="sub_kegiatan_id_4"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="kegiatan_id_4"]').append('<option value="' +
                        //         id + '">' + nama + '</option>');
                        // })
                        // kegiatan()


                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect12.addOption({value: id, text: nama});
                        });

                    }
                })
            });
        });
