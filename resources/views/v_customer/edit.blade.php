@extends('v_layouts.app')

@section('content')
<!-- Template -->

<div class="row">
    <div class="col-md-12">
        <div class="billing-details">
            <div class="section-title">
                <h3 class="title">{{ $judul }}</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Pesan Success -->
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif

                    <!-- Pesan Error -->
                    @if(session()->has('msgError'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{ session('msgError') }}</strong>
                        </div>
                    @endif
                </div>

                <form action="{{ route('customer.updateakun', $edit->user->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Foto</label>

                            {{-- Preview Foto --}}
                            @if ($edit->foto)
                                <img src="{{ asset('storage/img-customer/20250429085630_681031ce17aee.jpg' . $edit->user->foto) }}" class="foto-preview" width="100%">
                            @else
                                <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="foto-preview" width="100%">
                            @endif
                            <p>
                                
                            </p>

                            {{-- Upload Foto --}}
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
                            @error('foto')
                                <div class="invalid-feedback alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" value="{{ old('nama', $edit->user->nama) }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                            @error('nama')
                                <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="{{ old('email', $edit->user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                            @error('email')
                                <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>HP</label>
                            <input type="text" onkeypress="return hanyaAngka(event)" name="hp" value="{{ old('hp', $edit->user->hp) }}" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor HP">
                            @error('hp')
                                <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $edit->alamat) }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input type="text" name="pos" value="{{ old('pos', $edit->pos) }}" class="form-control @error('pos') is-invalid @enderror" placeholder="Masukkan Kode Pos">
                            @error('pos')
                                <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <br>
                        <div class="pull-left">
                            <button type="submit" class="primary-btn">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Template -->
@endsection
