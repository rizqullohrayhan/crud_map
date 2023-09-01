@extends('template')
@section('content')
    {{-- <div class="container"> --}}
        <div class="row mt-3">
            <div class="col-md-7">
                <div id="map"></div>
            </div>
            <div class="col-md-5">
                <div class="form-tambah">
                    <form action="{{route('garis.tambah')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Keterangan <small style="color: red;">* Wajib diisi</small></label>
                            <input type="text" class="form-control" name="keterangan" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Latitude Awal <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control" name="lat_awal" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Longitude Awal <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control" name="long_awal" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Latitude Akhir <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control" name="lat_akhir" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Latitude Akhir <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control" name="long_akhir" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-2 mx-auto my-auto mt-3">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-bordered border-dark mt-3">
            <thead>
                <tr>
                    <td style="width: 3%">No.</td>
                    <td>Keterangan</td>
                    <td>Titik Awal <trans>(Latitude, Longitude)</trans></td>
                    <td>Titik Akhir <trans>(Latitude, Longitude)</trans></td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @if ($data->count() == 0)
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
                @else
                @foreach ($data as $key=>$item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->keterangan}}</td>
                        <td>{{$item->lat_awal}}, {{$item->long_awal}}</td>
                        <td>{{$item->lat_akhir}}, {{$item->long_akhir}}</td>
                        <td>
                            <button data-bs-target="#editKoordinat{{$key}}" data-bs-toggle="modal" class="btn btn-warning btn-sm" title="Edit"><i class='fas fa-pen fa-sm'></i></button>
                            <button onclick="return showConfirm('{{ route('garis.hapus', [$item->id]) }}', '{{ csrf_token() }}')" class="btn btn-danger btn-sm" title="Hapus"><i class='fas fa-trash fa-sm'></i></button>
                        </td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editKoordinat{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Koordinat</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('garis.edit', [$item->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label>Keterangan <small style="color: red;">* Wajib diisi</small></label>
                                            <input type="text" class="form-control" name="keterangan" value="{{$item->keterangan}}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Titik Latitude Awal <small style="color: red;">* Wajib diisi</small></label>
                                                    <input type="number" step="1e-15" class="form-control" name="lat_awal" value="{{$item->lat_awal}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Titik Longitude Awal <small style="color: red;">* Wajib diisi</small></label>
                                                    <input type="number" step="1e-15" class="form-control" name="long_awal" value="{{$item->long_awal}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Titik Latitude Akhir <small style="color: red;">* Wajib diisi</small></label>
                                                    <input type="number" step="1e-15" class="form-control" name="lat_akhir" value="{{$item->lat_akhir}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Titik Latitude Akhir <small style="color: red;">* Wajib diisi</small></label>
                                                    <input type="number" step="1e-15" class="form-control" name="long_akhir" value="{{$item->long_akhir}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit -->
                @endforeach
                @endif
            </tbody>
        </table>
    {{-- </div> --}}

    <script src="{{ asset('js/garis.js') }}"></script>
@endsection