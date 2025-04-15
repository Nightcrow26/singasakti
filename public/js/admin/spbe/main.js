// $(document).ready(function() {
//     datatable();
// });

function AddModal() {
    $('#addModal').modal('show');
}

// function datatable() {
//     $('#table')
//         .DataTable()
//         .destroy();

//     $('#table').DataTable({
//         processing: true,
//         serverSide: true,
//         language: {
//             processing: "<img src='" + window.origin + "/img/805.gif'> Memuat Data",
//             paginate: {
//                 next: '<span class="fa fa-angle-right"></span>',
//                 previous: '<span class="fa fa-angle-left"></span>'
//             }
//         },
//         ajax: window.location.origin + '/master/data?type=jawaban',
//         columns: [{
//                 data: 'DT_RowIndex',
//                 name: 'DT_RowIndex'
//             },
//             {
//                 data: 'nama',
//                 name: 'nama'
//             },
//             {
//                 data: 'jawaban',
//                 name: 'jawaban'
//             },
//             {
//                 data: 'nilai',
//                 name: 'nilai'
//             },
//             {
//                 data: 'button',
//                 name: 'button'
//             }
//         ]
//     });
// }

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
                swal('NIK sudah terdaftar', '', 'error');
                $('#tombol').show();
                $('#loading').hide();
            } else if (res.status = "success") {
                // $('#table').DataTable().ajax.reload();
                // location.reload();
                swal('Data Berhasil Di Simpan', '', 'success');
                location.reload();
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



function edit(id) {
    $.ajax({
        url: window.location.origin + '/master/data/show?type=jawaban',
        method: "GET",
        data: { id: id, _token: '{{ csrf_token() }}' },
        success: function(response) {
            console.log(response)
            $('#idEdit').empty();
            $('#namaEdit').empty();
            $('#nilaiEdit').empty();
            $('#idEdit').val(id);
            $('#namaEdit').val(response['nama']);
            $('#nilaiEdit').val(response['nilai']);
        }
    })
}

function tambah(id) {
    $.ajax({
        url: window.location.origin + '/master/data/show?type=indikator',
        method: "GET",
        data: { id: id, _token: '{{ csrf_token() }}' },
        success: function(response) {
            console.log(response)
            $('#idAdd').empty();
            $('#indikatorAdd').empty();
            $('#idAdd').val(id);
            $('#indikatorAdd').val(response['nama']);
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
                swal('NIK sudah terdaftar', '', 'error');
                $('#tombol').show();
                $('#loading').hide();
            } else if (res.status = "success") {
                // $('#table').DataTable().ajax.reload();

                swal('Data Berhasil Di Simpan', '', 'success');
                location.reload();
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
                    data: { id: id, type: 'jawaban' },
                    success: function(results) {
                        // $('#table').DataTable().ajax.reload();
                        swal('Berhasil Menghapus Data', {
                            icon: 'success',
                        });
                        location.reload();
                    }
                });

            } else {
                swal('Data Batal Dihapus');
            }
        });

}

function add(id, trx_id, skpd_id) {
    console.log(id)
    console.log(trx_id)
    console.log(skpd_id)
    $('#modal-create').modal('show')
    $.ajax({
        url: window.location.origin + '/admin/spbe/verif',
        method: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { id: id, trx_id: trx_id, skpd_id: skpd_id },
        success: function(data) {
            $('#sucses').html(data)
        }
    });
}

function addskpd(id, trx_id, skpd_id) {
    console.log(id)
    console.log(trx_id)
    console.log(skpd_id)
    $('#modal-create-skpd').modal('show')
    $.ajax({
        url: window.location.origin + '/admin/spbe/verifskpd',
        method: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { id: id, trx_id: trx_id, skpd_id: skpd_id },
        success: function(data) {
            $('#sucsesskpd').html(data)
        }
    });
}

function detail(id, trx_id, skpd_id) {
    console.log(id)
    console.log(trx_id)
    console.log(skpd_id)
    $('#modal-detail').modal('show')
    $.ajax({
        url: window.location.origin + '/admin/spbe/show',
        method: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { id: id, trx_id: trx_id, skpd_id: skpd_id },
        success: function(data) {
            $('#sucsesdetail').html(data)
        }
    });
}