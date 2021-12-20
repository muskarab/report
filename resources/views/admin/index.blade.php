@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card text-black bg-light mb-3">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <th>Cair</th>
                        <th>Tempat</th>
                        <th>Branch</th>
                        <th>Pejabat</th>
                        <th>Topik</th>
                        <th>Pembahasan</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($pelaporans as $pelaporan)
                        <tr>
                            <td>{{ $pelaporan->user->name }}</td>
                            <td>{{ $pelaporan->cair }}</td>
                            <td>{{ $pelaporan->tempat }}</td>
                            <td>{{ $pelaporan->cabang->nama }}</td>
                            <td>{{ $pelaporan->rceo }}
                                {{ $pelaporan->am }}
                                {{ $pelaporan->acfm }}
                                {{ $pelaporan->bm }}
                                {{ $pelaporan->crbmcbs }}
                                {{ $pelaporan->lain }}
                            </td>
                            <td>{!! $pelaporan->topik !!}</td>
                            <td>{!! $pelaporan->pembahasan !!}</td>
                            <td>
                                {{-- <button class="btn btn-outline-warning btn-sm" onclick="show({{ $item->id }})">Edit</button> --}}
                                {{-- <button class="btn btn-outline-danger btn-sm" onclick="destroy({{ $item->id }})">Delete</button> --}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>

        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="addreportkorea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlemodal">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="page" class="p-2">
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
        </div>
        </div>
        
    </div>
</div>
@endsection
