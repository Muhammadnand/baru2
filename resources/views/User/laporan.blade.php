@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
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
</style>
@endsection

@section('title', 'PEKAT - Pengaduan Masyarakat')

@section('content')
{{-- Section Header --}}
<section class="header bg-primary">


    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('pekat.index') }}">
                    <h2 class=" mt-0 text-white">Aduan Masyarakat Sukamaju</h2>
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
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Masuk</button>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pekat.formRegister') }}" class="btn btn-outline-purple">Daftar</a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

</section>
{{-- Section Card --}}
<body class="bg-primary">
<div class="container center">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 col">
            <div class="content content-top shadow">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                @endif
                @if (Session::has('pengaduan'))
                <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
                @endif
                <div class=" mb-3 text-center "><h1>---Tulis Laporan Disini---</h1></div>
                <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" value="{{ old('judul_laporan') }}" name="judul_laporan" placeholder="Masukkan Judul Laporan"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                            rows="4">{{ old('isi_laporan') }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian" placeholder="Pilih Tanggal Kejadian" class="form-control"
                            onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                    </div>
                    <div class="form-group">
                        <textarea name="lokasi_kejadian" rows="3" class="form-control" placeholder="Lokasi Kejadian">{{ old('lokasi_kejadian') }}</textarea>
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
        <div class="col-lg-3 col-md-12 col-sm-12 col-12 col">
            <div class="content content-bottom shadow">
                <div>
                    <img src="{{ asset('images/user_default.svg') }}" alt="user profile" class="photo">
                    <div class="self-align">
                        <h5><a class="text-danger" href="#">{{ Auth::guard('masyarakat')->user()->nama }}</a></h5>
                        <p class="text-dark">{{ Auth::guard('masyarakat')->user()->username }}</p>
                    </div>
                    <div class="row text-center">
                        <div class="col">
                            <p class="italic mb-0">Pending</p>
                            <div class="text-center">
                                {{ $hitung[0] }}
                            </div>
                        </div>
                        <div class="col">
                            <p class="italic mb-0">Proses</p>
                            <div class="text-center">
                                {{ $hitung[1] }}
                            </div>
                        </div>
                        <div class="col">
                            <p class="italic mb-0">Selesai</p>
                            <div class="text-center">
                                {{ $hitung[2] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!-- <div class="row mt-5 border-radius justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 ">
                    <a class="d-inline tab {{ $siapa != 'me' ? 'tab-active' : ''}} mr-4" href="{{ route('pekat.laporan') }}">
                        Semua
                    </a>
                    <a class="d-inline tab {{ $siapa == 'me' ? 'tab-active' : ''}}" href="{{ route('pekat.laporan', 'me') }}">
                        Laporan Saya
                    </a>
                    <hr>
                </div>
                @foreach ($pengaduan as $k => $v)
                <div class="col-lg-12">
                    <div class="laporan-top">
                        <img src="{{ asset('images/user_default.svg') }}" alt="profile" class="profile">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>{{ $v->user->nama }}</p>
                                @if ($v->status == '0')
                                <p class="text-danger">Pending</p>
                                @elseif($v->status == 'proses')
                                <p class="text-warning">{{ ucwords($v->status) }}</p>
                                @else
                                <p class="text-success">{{ ucwords($v->status) }}</p>
                                @endif
                            </div>
                            <div>
                                <p>{{ $v->tgl_pengaduan->format('d M, h:i') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="laporan-mid">
                        <div class="judul-laporan">
                            {{ $v->judul_laporan }}
                        </div>
                        <p>{{ $v->isi_laporan }}</p>
                    </div>
                    <div class="laporan-bottom">
                        @if ($v->foto != null)
                        <img src="{{ Storage::url($v->foto) }}" alt="{{ 'Gambar '.$v->judul_laporan }}" class="gambar-lampiran">
                        @endif
                        @if ($v->tanggapan != null)
                        <p class="mt-3 mb-1">{{ '*Tanggapan dari '. $v->tanggapan->petugas->nama_petugas }}</p>
                        <p class="light">{{ $v->tanggapan->tanggapan }}</p>
                        @endif
                    </div>
                    <hr>
                </div>
        @endforeach
            </div>
        </div>
    </div> -->
    <div class="content content-top shadow bg-white">
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <tbody>
                                @foreach ($pengaduan as $pengaduan)
                                {{-- {{dd($pengaduan)}} --}}
                                    <tr>
                                        <td>{{ $k += 1 }}</td>
                                        <td>{{ $pengaduan->tgl_pengaduan }}</td>
                                        <td>{{ $pengaduan->nama }}</td>
                                        <td>{{ $pengaduan->isi_laporan }}</td>
                                        <td> @if ($v->foto != null)
                                            <img src="{{ Storage::url($v->foto) }}" alt="{{ 'Gambar '.$v->judul_laporan }}" class="gambar-lampiran">
                                            @endif
                                        </td>
                                        <td>{{ $pengaduan->tanggapan }}</td>
                                        <td>{{ $pengaduan->nama_petugas }}</td>
                                        <td>
                                            @if ($v->status == '0')
                                                <a href="" class="badge badge-danger">Pending</a>
                                            @elseif($v->status == 'proses')
                                                <a href="" class="badge badge-warning text-white">Proses</a>
                                            @else
                                                <a href="" class="badge badge-success ">Selesai</a>
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody> 
                        </table>
                    </div>
            
                </div>  
    </div>       
    <br><br>     
</div>
</body>
{{-- Footer --}}

@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');

</script>
@endif
@endsection
