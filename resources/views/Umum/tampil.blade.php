<link rel="stylesheet" href="https://cdn.datatables.net/3.1.6/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/4.1.4/css/buttons.dataTables.min.css">

<div class="card">
   <div class="card-header bg-gradient-primary text-white">
      <i class="fa fa-user" aria-hidden="true"></i>&nbsp; <b>Data Umum</b>
   </div>

   <div class="card-body">
      <table id="example" class="display">
         <thead>
            <tr>
                  <td>No</td>
                  <td>NIK</td>
                  <td>Nama</td>
                  <td>Jenis Kelamin</td>
                  <td>Tanggal Lahir</td>
                  <td>Usia</td>
                  <td>No HP</td>
                  <td>Alamat</td>
                  <td>Email</td>
            </tr>
         </thead>
         <tbody>
            @foreach($data as $d)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $d->nik }}</td>
               <td>{{ $d->nama }}</td>
               <td>{{ $d->jenis_kelamin }}</td>
               <td>{{ dateID($d->tanggal_lahir) }}</td>
               <td>{{ $d->usia }}</td>
               <td>{{ $d->no_hp }}</td>
               <td>{!! nl2br($d->alamat) !!}</td>
               <td>{{ $d->email }}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>



<script src="https://cdn.datatables.net/3.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/4.1.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/4.1.4/js/buttons.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfmake@0.3.11/build/pdfmake.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfmake@0.3.11/build/vfs_fonts.js"></script>

<script>
   new DataTable('#example', {
	layout: {
		topStart: {
			buttons: ['excel', 'pdf', 'print']
		}
	}
});
</script>