<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data User</title>
</head>
<body>
    @extends('backend.v_layouts.app')
    @section('content')
    <!-- Content Awal -->
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.user.create') }}">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $judul }}</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>
                                        @if ($row->role == 1)
                                            <span class="badge badge-success">Super Admin</span>
                                        @elseif($row->role == 0)
                                            <span class="badge badge-primary">Admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->status == 1)
                                            <span class="badge badge-success">Aktif</span>
                                        @elseif($row->status == 0)
                                            <span class="badge badge-secondary">NonAktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Tombol Ubah -->
                                        <a href="{{ route('backend.user.edit', $row->id) }}" title="Ubah Data">
                                            <button type="button" class="btn btn-cyan btn-sm">
                                                <i class="far fa-edit"></i> Ubah
                                            </button>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form method="POST" action="{{ route('backend.user.destroy', $row->id) }}" style="display: inline-block;">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm show_confirm" 
                                                data-konf-delete="{{ $row->nama }}" title="Hapus Data">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Akhir -->
    @endsection

    <script type="text/javascript">
        // Konfirmasi delete
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.show_confirm');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    const konfdelete = this.getAttribute('data-konf-delete');

                    Swal.fire({
                        title: 'Konfirmasi Hapus Data?',
                        html: `Data yang dihapus <strong>${konfdelete}</strong> tidak dapat dikembalikan!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, dihapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success')
                                .then(() => form.submit());
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
