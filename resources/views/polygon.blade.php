@extends('template')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card text-bg-success">
            <div class="card-body">
                <div id="map" style="height: 700px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="d-grid gap-2 col-5 mx-auto my-auto mb-3 mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Polygon</button>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <td style="width: 3%">No.</td>
                            <td>Keterangan</td>
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
                                <td>
                                    <button data-bs-target="#editKoordinat{{$key}}" data-bs-toggle="modal" class="btn btn-warning btn-sm" title="Edit"><i class='fas fa-eye fa-sm'></i></button>
                                    <button onclick="return showConfirm('{{ route('polygon.hapus', [$item->id]) }}', '{{ csrf_token() }}')" class="btn btn-danger btn-sm" title="Hapus"><i class='fas fa-trash fa-sm'></i></button>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editKoordinat{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Koordinat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label for="ket{{$item->id}}">Keterangan</label>
                                                        <input id="ket{{$item->id}}" type="text" class="form-control" name="keterangan" value="{{$item->keterangan}}" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button id="editKet{{$item->id}}" onclick="editKeteranganPolygon('{{$item->id}}')" class="btn btn-warning btn-sm" title="Edit"><i class='fas fa-pen fa-sm'></i></button>
                                                    <button id="simpanKet{{$item->id}}" onclick="simpanKeteranganPolygon('{{$item->id}}')" class="btn btn-warning btn-sm hidden" title="simpan"><i class='fas fa-save fa-sm'></i></button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach ($item->KoordinatPolygon as $no=>$koor)
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="lat{{$koor->id}}">Titik Latitude {{$no + 1}}</label>
                                                            <input id="lat{{$koor->id}}" type="number" class="form-control" name="lat" value="{{$koor->latitude}}" readonly required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="long{{$koor->id}}">Titik Longitude {{$no + 1}}</label>
                                                            <input id="long{{$koor->id}}" type="number" class="form-control" name="long" value="{{$koor->longitude}}" readonly required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button id="edit{{$koor->id}}" onclick="editKoordinatPolygon('{{$koor->id}}', 'lat{{$koor->id}}', 'long{{$koor->id}}')" class="btn btn-warning btn-sm" title="Edit"><i class='fas fa-pen fa-sm'></i></button>
                                                        <button id="simpan{{$koor->id}}" onclick="simpanKoordinatPolygon('{{$koor->id}}', 'lat{{$koor->id}}', 'long{{$koor->id}}')" class="btn btn-warning btn-sm hidden" title="simpan"><i class='fas fa-save fa-sm'></i></button>
                                                        <button id="" onclick="return showConfirm('{{ route('polygon.hapus', [$item->id]) }}', '{{ csrf_token() }}')" class="btn btn-danger btn-sm" title="Hapus"><i class='fas fa-trash fa-sm'></i></button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Edit -->
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahmodal">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('polygon.tambah')}}" method="post">
            @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label>Keterangan <small style="color: red;">* Wajib diisi</small></label>
                            <input type="text" class="form-control shadow-sm" name="keterangan" required>
                        </div>
                        <div class="row" id="koordinatPolygon">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Latitude 1 <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control shadow-sm" name="lat1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Longitude 1 <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control shadow-sm" name="long1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Latitude 2 <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control shadow-sm" name="lat2" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Longitude 2 <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control shadow-sm" name="long2" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Latitude 3 <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control shadow-sm" name="lat3" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titik Longitude 3 <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" step="1e-15" class="form-control shadow-sm" name="long3" required>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" onclick="tambahInputKoordinatPolygon()" class="btn btn-primary">Tambah Field</button>
                    <button type="button" onclick="hapusInputKoordinatPolygon()" class="btn btn-danger">Hapus Field</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<script src="{{asset('js/polygon.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
@endsection