@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .notification {
        padding: 14px;
        text-align: center;
        background: #f4b704;
        color: #fff;
        font-weight: 300;
    }

    .btn-white {
        background: #fff;
        color: #000;
        text-transform: uppercase;
        padding: 0px 25px 0px 25px;
        font-size: 14px;
    }

    .btn-facebook {
        background: #3b66c4;
        width: 100%;
        color: #fff;
        font-weight: 600;
    }

    .btn-facebook:hover {
        background: #3b66c4;
        width: 100%;
        color: #fff;
        font-weight: 600;
    }

    .btn-google {
        background: #cf4332;
        width: 100%;
        color: #fff;
        font-weight: 600;
    }

    .btn-google:hover {
        background: #cf4332;
        width: 100%;
        color: #fff;
        font-weight: 600;
    }

</style>
@endsection

@section('title', 'Adumas Sukamaju')

@section('content')
{{-- Section Header --}}
<section class="header bg-white d-flex align-items-center justify-content-center">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">

                    <h4 class="semi-bold mb-0 text-white">Adumas Sukamaju</h4>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(Auth::guard('masyarakat')->check())
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.laporan') }}">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.logout') }}"
                                style="text-decoration: underline">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav text-center ml-auto bg-primary">
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Masuk</button>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pekat.formRegister') }}" class="btn btn-primary">Daftar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pekat.laporan') }}" class="btn btn-primary">Laporan</a>
                        </li>

                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="text-center">
        <h2 class="medium text-dark mt-3">Layanan Pengaduan Masyarakat</h2>
        <p class="italic text-dark">Sampaikan laporan Anda langsung kepada yang pemerintah berwenang</p>
    </div>


</section>
{{-- Section Card Pengaduan --}}
{{-- <div class="row justify-content-center bg-primary pb-5">
    <div class="col-lg-6 col-10 col">
        <div class="content shadow">

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif

            @if (Session::has('pengaduan'))
            <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
            @endif

            <div class="card mb-3 bg-primary">Tulis Laporan Disini</div>
            <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" value="{{ old('judul_laporan') }}" name="judul_laporan"
                        placeholder="Masukkan Judul Laporan" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                        rows="4">{{ old('isi_laporan') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian"
                        placeholder="Pilih Tanggal Kejadian" class="form-control" onfocusin="(this.type='date')"
                        onfocusout="(this.type='text')">
                </div>
                <div class="form-group">
                    <textarea name="lokasi_kejadian" id="latlang" rows="3" class="form-control mb-3"
                        placeholder="Lokasi Kejadian">{{ old('lokasi_kejadian') }}</textarea>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <select name="kategori_kejadian" class="custom-select" id="inputGroupSelect01" required>
                            <option value="" selected>Pilih Kategori Kejadian</option>
                            <option value="agama">Agama</option>
                            <option value="hukum">Hukum</option>
                            <option value="lingkungan">Lingkungan</option>
                            <option value="sosial">Sosial</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-custom mt-2 bg-primary">Kirim</button>
            </form>
        </div>
    </div>
</div> --}}
<section class="bg-light pb-5 my-5">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
            <div class="col-12 col-lg-5">
                <h2 class="display-5 lh-1 mb-4">Apa sih Layanan Pengaduan Masyarakat?</h2>
                <p class="lead fw-normal text-muted mb-5 mb-lg-0">Pengaduan masyarakat adalah penyampaian keluhan oleh masyarakat kepada pemerintah atas pelayanan yang tidak sesuai dengan standar pelayanan, atau pengabaian kewajiban dan/atau pelanggaran larangan.
                    Penanganan pengaduan masyarakat adalah proses kegiatan yang meliputi penerimaan, pencatatan, penelaahan, tindak lanjut penyaluran tindaklanjut, pengarsipan, pemantauan dan pelaporan.
                </p>
            </div>
            <div class="col mb-3">
                <img class="h-100 w-100 float:left;" style=”float:right;” src="/images/download (4).jpg">
            </div>
        </div>
    </div>
</section>
<div class="row justify-content-center bg-primary pb-5">

    <div class="col-lg-6 col-10 col">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="content shadow">


            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif

            @if (Session::has('pengaduan'))
            <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
            @endif

            <div class=" mb-3 text-center "><h1>---Tulis Laporan Disini---</h1></div>
            <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data" class="border-rounded">
                @csrf
                <div class="form-group shadow">
                    <input type="text" value="{{ old('judul_laporan') }}" name="judul_laporan"
                        placeholder="Masukkan Judul Laporan" class="form-control">
                </div>
                <div class="form-group shadow">
                    <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                        rows="4">{{ old('isi_laporan') }}</textarea>
                </div>
                <div class="form-group shadow">
                    <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian"
                        placeholder="Pilih Tanggal Kejadian" class="form-control" onfocusin="(this.type='date')"
                        onfocusout="(this.type='text')">
                </div>
                <div class="form-group shadow">
                    <textarea name="lokasi_kejadian" id="latlang" rows="3" class="form-control mb-3"
                        placeholder="Lokasi Kejadian">{{ old('lokasi_kejadian') }}</textarea>
                </div>
                <div class="form-group shadow">
                    <div class="input-group mb-3">
                        <select name="kategori_kejadian" class="custom-select" id="inputGroupSelect01" required>
                            <option value="" selected>Pilih Kategori Kejadian</option>
                            <option value="agama">Agama</option>
                            <option value="hukum">Hukum</option>
                            <option value="lingkungan">Lingkungan</option>
                            <option value="sosial">Sosial</option>
                        </select>
                    </div>
                </div>
                <div class="form-group shadow">
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-custom mt-2 bg-primary shadow">Kirim</button>
            </form>
        </div>
    </div>
</div>
<section class="bg-light pb-5 my-5">
    <div class="table-responsive">
    <thead>        
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Pengadu</th>
        <th>Isi Laporan</th>
        <th>Foto</th>
        <th>Tanggapan</th>
        <th>Nama Petugas</th>
        <th>Status</th>
    </tr>
    </thead>
    </div>
</section>

{{-- Section Hitung Pengaduan --}}
{{-- <div class="pengaduan mt-5 bg-white mb-5">
    <div class="bg-purple">
        <div class="text-center">
            <h5 class="medium text-white mt-3">JUMLAH LAPORAN SEKARANG</h5>
            <h2 class="medium text-white">{{ $pengaduan }}</h2>
        </div>
    </div>
</div> --}}
{{-- Footer --}}
<div class="mt-5">
    <hr>
    <div class="text-center">
        {{-- <p class="italic text-secondary">© 2021  • All rights reserved</p> --}}
    </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="mt-3">Masuk terlebih dahulu</h3>
                <p>Silahkan masuk menggunakan akun yang sudah didaftarkan.</p>

                <form action="{{ route('pekat.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username atau Email</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-danger text-white mt-3" style="width: 100%">MASUK</button>
                </form>
                @if (Session::has('pesan'))
                <div class="alert alert-danger mt-2">
                    {{ Session::get('pesan') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');

</script>
@endif
@endsection
