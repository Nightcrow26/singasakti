 <div>
     <input type="hidden" id="skpd_id_foto" name="skpd_id" value="{{ $data->skpd_id }}">
     <input type="hidden" id="tahun" name="tahun" value="{{ auth()->user()->tahun }}">
     <input type="hidden" id="id_tambah_foto" name="trx_monev_id" value="{{ $data->id }}">
     <div class="col-md-12 mt-4">
         <small class="text-light fw-semibold">Upload :</small>
         <table class="table" id="dynamic_field_lampiran">
             <tr>
                 <td>
                     <input type="file" name="file[]" class="form-control file_list" required>
                 </td>
                 <td>
                     <input type="text" id="ket" name="ket" class="form-control" placeholder="Nama File"
                         required>
                 </td>
                 <td><button type="button" name="add_lampiran" id="add_lampiran" class="btn btn-success">+</button>
                 </td>
             </tr>
         </table>
     </div>

     <div class="col-md-12 mt-4">
         <small class="text-light fw-semibold">Bukti Dukung :</small>
         <table class="table" id="dynamic_field_lampiran">
             @if (isset($file))
                 @foreach ($file as $b)
                     <tr>
                         <td id="filelampiranpajak">
                             <a href="{{ asset('/storage') }}/{{ $b->file }}" target="_blank">
                                 <i class='bx bxs-download'></i>
                                 {{ $b->ket }}
                             </a>

                         </td>
                         <td>
                             <a onclick="deletebtnfile('{{ $b->id }}')" class="btn btn-sm btn-flat btn-danger"><i
                                     style="color:white" class="bx bx-trash"></i></a>
                         </td>
                     </tr>
                 @endforeach
             @endif
         </table>
     </div>
 </div>

 <script>
     var i = 1;

     $(document).on('click', '.btn_remove_lampiran', function() {
         var button_id = $(this).attr("id");
         $('#row' + button_id + '').remove();
     });
     $('#add_lampiran').click(function() {
         i++;
         $('#dynamic_field_lampiran').append('<tr id="row' + i +
             '" class="dynamic-added"><td><input type="file" name="file[]" class="form-control file_list" required></td>  <td><input type="text"  name="ket" class="form-control"placeholder="Nama File" required></td><td><button type="button" name="remove" id="' +
             i + '" class="btn btn-danger btn_remove_lampiran">x</button></td></tr>');
     });

     function tambah_foto(id) {

         $.ajax({
             url: "{{ url('') }}/admin/monev/show",
             method: "POST",
             data: {
                 id,
                 _token: '{{ csrf_token() }}'
             },
             success: function(response) {
                 $("#modal-tambah-foto").modal('show')

                 $('#id_tambah_foto').empty();
                 $('#skpd_id_foto').empty();

                 $('#id_tambah_foto').val(id);
                 $('#skpd_id_foto').val(response['skpd_id']);
             }
         })
     }

     function deletebtnfile(id) {
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
                         url: window.location.origin + '/admin/monev/deletefile',
                         method: "POST",
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                         data: {
                             id: id,
                         },
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
 </script>
