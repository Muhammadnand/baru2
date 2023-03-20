@extends('layouts.admin')

@section('title', 'Halaman Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="mb-5">
    <h4 class="text-danger">Dashboard</h4>
</div>
<div class="card shadow">
<div class="card-body">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">Petugas</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $petugas }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-header">Masyarakat</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $masyarakat }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">Pengaduan Proses</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $proses }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-header">Pengaduan Selesai</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $selesai }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-header">Pengaduan Pending</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $selesai }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
