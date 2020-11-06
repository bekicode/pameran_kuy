@extends('layouts.admin')


@section('title', 'Dashboard')
@section('css')
    p{
        font-size: 1.23rem;
    }
@endsection
@section('content')
<div class="spacer"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center text-white" style="background-color: #18212e"><p> Dashboard</p></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
{{-- ADMIN --}}
@if (Auth::user()->isSuperAdmin == 1)
                        <div class="row justify-content-center mb-3">
                            <div class="col col-md-4 mb-3 ">
                                <div class="card text-center bg-primary text-white" style="padding: 10px;">
                                    <h4 class="text-white">Pengunjung</h4>
                                    <hr>
                                    <span style="font-size: 2em">{{count($pengunjung)}}</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <div class="card text-center  bg-primary text-white" style="padding: 10px;">
                                    <h4 class="text-white">Seniman</h4>
                                    <hr>
                                    <span style="font-size: 2em">{{count($seniman)}}</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <div class="card text-center bg-success text-white" style="padding: 10px;">
                                    <h4 class="text-white">Karya</h4>
                                    <hr>
                                    <span style="font-size: 2em">{{count($karya)}}</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <div class="card text-center bg-secondary text-white" style="padding: 10px;">
                                    <h4 class="text-white">Antrian Submit Karya</h4>
                                    <hr>
                                    <span style="font-size: 2em">{{count($antrianKarya)}}</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-3"> 
                                <div class="card text-center bg-warning " style="padding: 10px;">
                                    <h4 class="">Karya Ditolak</h4>
                                    <hr>
                                    <span style="font-size: 2em">{{count($karyaDitolak)}}</span>
                                </div>
                            </div>
                        </div>

{{-- SENIMAN --}}
@elseif (Auth::user()->isAdmin == 1)

                    @if (\Session::has('error'))
                        <div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Peringatan!</strong> {{\Session::get('error')}}
                        </div>
                    @elseif (\Session::has('error'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Sukses!</strong> {{\Session::get('error')}}
                        </div>
                    @endif
                    
                        <a href="/karya/create" class="btn btn-primary mb-3" style="font-size: 1.23rem;">Submit Karya</a>
                        <h4 class="text-center"> Daftar Karya Anda </h4>
                        <div class="table-responsive">
                            <table class="table table-striped mt-3 mb-3">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Karya</th>
                                    <th scope="col">Tahun Karya</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
@php
    $i = 1;
@endphp
@if (!empty($jml))
    
    @foreach ($karya as $k)
    

                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$k->nama_karya}}</td>
                                    <td>{{$k->tahun_karya}}</td>
                                    <td>
                                        <a href="/karya/edit/{{$k->id_karya}}" class="btn btn-primary mr-2 mb-2">Edit</a>

                                        <form method="POST" action="/karya/hapus/{{$k->id_karya}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-warning">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
    @endforeach
@else
                                <tr><th colspan="4" class="text-center">--- Tidak ada data ---</th></tr> 
@endif

                                </tbody>
                            </table>
                        </div>

@elseif (Auth::user()->isAdmin == 0)
                        <p>Anda berstatus sebagai pengunjung, jika anda berminat untuk memajang karya anda silahkan daftarkan diri anda sebagai seniman.</p>    
                        <a href="/users/daftar-seniman" class="btn btn-primary" style="font-size: 1.23rem;">Daftar Sebagai Seniman</a>
@else 
                        <p class="text-danger">AKSES TIDAK VALID!</p>
@endif
                        
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacer"></div>
@endsection
