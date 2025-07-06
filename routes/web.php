<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CustomerController; 
use App\Http\Controllers\RajaOngkirController;

// Redirect root ke beranda
Route::get('/', fn() => redirect()->route('beranda'));

// Beranda frontend
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

// Backend routes (auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda');
    
    // User management backend
    Route::resource('backend/user', UserController::class, ['as' => 'backend']);
    Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser');
    Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser');
    
    // Kategori backend
    Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend']);
    
    // Produk backend
    Route::resource('backend/produk', ProdukController::class, ['as' => 'backend']);
    Route::post('foto-produk/store', [ProdukController::class, 'storeFoto'])->name('backend.foto_produk.store');
    Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('backend.foto_produk.destroy');
    Route::get('backend/laporan/formproduk', [ProdukController::class, 'formProduk'])->name('backend.laporan.formproduk');
    Route::post('backend/laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('backend.laporan.cetakproduk');
    
    // Customer backend
    Route::get('/backend/customer', [CustomerController::class, 'index'])->name('backend.customer.index');
});

// Backend login/logout
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

// Frontend Produk
Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::get('/produk/kategori/{id}', [ProdukController::class, 'produkKategori'])->name('produk.kategori');
Route::get('/produk/all', [ProdukController::class, 'produkAll'])->name('produk.all');

// Google OAuth API
Route::get('/auth/redirect', [CustomerController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/google/callback', [CustomerController::class, 'callback'])->name('auth.callback');

// Customer account
Route::get('/customer/akun/{id}', [CustomerController::class, 'akun'])->name('customer.akun');
Route::put('/customer/updateakun/{id}', [CustomerController::class, 'updateAkun'])->name('customer.updateakun');

// Order / Keranjang
Route::post('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('order.addToCart');
Route::get('cart', [OrderController::class, 'viewCart'])->name('order.cart');
Route::post('cart/update/{id}', [OrderController::class, 'updateCart'])->name('order.updateCart');
Route::post('remove/{id}', [OrderController::class, 'removeFromCart'])->name('order.remove');

// Pengiriman & Ongkir
Route::post('select-shipping', [OrderController::class, 'selectShipping'])->name('order.selectShipping');
Route::get('provinces', [OrderController::class, 'getProvinces']);
Route::get('/cities', [OrderController::class, 'getCities'])->name('order.getCities');
Route::post('cost', [OrderController::class, 'getCost']);
Route::post('updateongkir', [OrderController::class, 'updateongkir'])->name('order.updateongkir');

// Halaman cek ongkir sederhana
Route::get('/cek-ongkir', fn() => view('v_ongkir.ongkir'));

// API RajaOngkir (testing)
Route::get('/list-ongkir', function () {
    $response = Http::withHeaders([
        'key' => 'isi API KEY anda di sini'
    ])->get('https://api.rajaongkir.com/starter/province');
    dd($response->json());
});

// RajaOngkir Controller (commented out route cities jika tidak dipakai)
// Route::get('/cities', [RajaOngkirController::class, 'getCities']);
Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']);
Route::post('/cost', [RajaOngkirController::class, 'getCost']);

// Customer logout
Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');
