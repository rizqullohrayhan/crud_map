@extends('template')
@section('content')
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="card text-bg-success">
                    <div class="card-body">
                        <div id="map" style="titik"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-tambah">
                            <form action="{{route('titik.tambah')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Keterangan <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="text" class="form-control shadow-sm" name="keterangan" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Latitude <small style="color: red;">* Wajib diisi</small></label>
                                            <input type="number" step="1e-15" class="form-control shadow-sm" name="latitude" id="latitude" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Longitude <small style="color: red;">* Wajib diisi</small></label>
                                            <input type="number" step="1e-15" class="form-control shadow-sm" name="longitude" id="longitude" required>
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
            </div>
        </div>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <td style="width: 3%">No.</td>
                    <td>Keterangan</td>
                    <td>Latitude</td>
                    <td>Longitude</td>
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
                        <td>{{$item->latitude}}</td>
                        <td>{{$item->longitude}}</td>
                        <td>
                            <button data-bs-target="#editKoordinat{{$key}}" data-bs-toggle="modal" class="btn btn-warning btn-sm" title="Edit"><i class='fas fa-pen fa-sm'></i></button>
                            <button onclick="return showConfirm('{{ route('titik.hapus', [$item->id]) }}', '{{ csrf_token() }}')" class="btn btn-danger btn-sm" title="Hapus"><i class='fas fa-trash fa-sm'></i></button>
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
                                    <form action="{{ route('titik.edit', [$item->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label>Keterangan <small style="color: red;">* Wajib diisi</small></label>
                                            <input type="text" class="form-control" name="keterangan" value="{{$item->keterangan}}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Latitude <small style="color: red;">* Wajib diisi</small></label>
                                                    <input type="number" class="form-control" name="latitude" value="{{$item->latitude}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Longitude <small style="color: red;">* Wajib diisi</small></label>
                                                    <input type="number" class="form-control" name="longitude" value="{{$item->longitude}}" required>
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

    <script src="{{ asset('js/titik.js') }}"></script>
@endsection