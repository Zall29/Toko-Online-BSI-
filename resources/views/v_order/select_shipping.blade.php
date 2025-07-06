@extends('v_layouts.app')
@push('styles')
<style>
    .btn-orange {
        background-color: #ff6f4e;
        color: white;
        border: none;
        padding: 8px 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-orange:hover {
        background-color: #ff3c1a;
    }

    table th, table td {
        vertical-align: middle;
        text-align: center;
    }
</style>
@endpush


@section('content')
<div class="container">
    <h3><strong>PILIH PENGIRIMAN</strong></h3>

    {{-- Form 1: Pilih Provinsi (auto-submit untuk load kota) --}}
    <form action="{{ route('order.selectShipping') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="province_id">Provinsi Tujuan:</label>
            <select name="province_id" id="province_id" class="form-control" onchange="this.form.submit()">
                <option value="">-- Pilih Provinsi --</option>
                @foreach($provinces as $province)
                    <option value="{{ $province['province_id'] }}" {{ $selectedProvince == $province['province_id'] ? 'selected' : '' }}>
                        {{ $province['province'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- Form 2: Kirim data pengiriman lengkap --}}
    @if(!empty($cities))
    <form action="{{ route('order.selectShipping') }}" method="POST">
        @csrf
        <input type="hidden" name="province_id" value="{{ $selectedProvince }}">

        <div class="form-group">
            <label for="city_id">Kota Tujuan:</label>
            <select name="city_id" id="city_id" class="form-control">
                <option value="">-- Pilih Kota --</option>
                @foreach($cities as $city)
                    <option value="{{ $city['city_id'] }}">{{ $city['type'] }} {{ $city['city_name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="courier">Kurir:</label>
            <select name="courier" id="courier" class="form-control">
                <option value="jne">JNE</option>
                <option value="tiki">TIKI</option>
                <option value="pos">POS Indonesia</option>
            </select>
        </div>

        <div class="form-group">
            <label for="address">Alamat:</label>
            <textarea name="address" id="address" class="form-control" rows="3">Jl. Sawo No. 4 RT/RW 09/10</textarea>
        </div>

        <div class="form-group">
            <label for="postal_code">Kode Pos:</label>
            <input type="text" name="postal_code" id="postal_code" class="form-control" value="52114">
        </div>

        <button type="submit" class="btn btn-dark">CEK ONGKIR</button>
    </form>
    @endif

    @if(session('results'))
<hr>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>LAYANAN</th>
            <th>BIAYA</th>
            <th>ESTIMASI PENGIRIMAN</th>
            <th>TOTAL BERAT</th>
            <th>TOTAL HARGA</th>
            <th>BAYAR</th>
        </tr>
    </thead>
    <tbody>
        @foreach(session('results') as $service)
            <tr>
                <td>{{ $service['service'] }}</td>
                <td>{{ number_format($service['cost']) }} Rupiah</td>
                <td>{{ $service['etd'] }} hari</td>
                <td>{{ $service['weight'] }} Gram</td>
                <td>Rp. {{ number_format($service['total_price']) }}</td>
                <td>
                    <form action="{{ route('order.updateongkir') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service" value="{{ $service['service'] }}">
                        <input type="hidden" name="cost" value="{{ $service['cost'] }}">
                        <input type="hidden" name="etd" value="{{ $service['etd'] }}">
                        <button type="submit" class="btn btn-orange">PILIH PENGIRIMAN</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

</div>
@endsection
