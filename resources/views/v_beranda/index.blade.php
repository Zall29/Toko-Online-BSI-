@extends('v_layouts.app')
@section('content')
<!-- template -->

<!-- STORE -->
<div id="store">
    <!-- row -->
    <div class="row">

        @foreach ($produk as $row)
            <!-- Product Single -->
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="product product-single">

                    <!-- Thumbnail -->
                    <div class="product-thumb">
                        <div class="product-label">
                            <span>Kategori</span>
                            <span class="sale">{{ $row->kategori->nama_kategori }}</span>
                        </div>

                        <a href=" {{ route('produk.detail', $row->id) }}">
                            <button class="main-btn quick-view">
                                <i class="fa fa-search-plus"></i> Detail Produk
                            </button>
                        </a>``

                        <img src="{{ asset('storage/img-produk/' . $row->foto) }}" alt="">

                    </div>
                    <!-- /Thumbnail -->

                    <!-- Product Body -->
                    <div class="product-body">
                        <h3 class="product-price">
                            Rp. {{ number_format($row->harga, 0, ',', '.') }}
                            <span class="product-old-price">{{ $row->kategori->nama_kategori }}</span>
                        </h3>

                        <h2 class="product-name">
                            <a href=" {{ route('produk.detail', $row->id) }}">{{ $row->nama_produk }}</a>
                        </h2>

                        <div class="product-btns">
                            <!-- Button Detail -->
                            <a href=" {{ route('produk.detail', $row->id) }}" title="Detail Produk">
                                <button class="main-btn icon-btn">
                                    <i class="fa fa-search-plus"></i>
                                </button>
                            </a>

                            <!-- Button Pesan -->
                            <form action="{{ route('order.addToCart', $row->id) }}" method="post"
                                style="display: inline-block;" title="Pesan Ke Aplikasi">
                                @csrf
                                <button type="submit" class="primary-btn add-to-cart"><i
                                class="fa fa-shopping-cart"></i> Pesan</button>
                            </form>
                        </div>
                    </div>
                    <!-- /Product Body -->

                </div>
            </div>
            <!-- /Product Single -->
        @endforeach

        <div class="clearfix visible-md visible-lg visible-sm visible-xs"></div>
    </div>
    <!-- /row -->
</div>
<!-- /STORE -->



<!-- end template-->
@endsection