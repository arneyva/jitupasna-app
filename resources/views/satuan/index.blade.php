@extends('layouts.main')

@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Satuan</h4>
                    <div>
                        {{-- <button class="btn btn-danger">Filter</button> --}}
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#inlineForm">
                            Tambah Data
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($satuan as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem"
                                                viewBox="0 0 24 24" data-toggle="modal"
                                                data-target="#UpdateData{{ $item->id }}">
                                                <path fill="#5A8DEE"
                                                    d="M21 12a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h6a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-6a1 1 0 0 0-1-1m-15 .76V17a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .71-.29l6.92-6.93L21.71 8a1 1 0 0 0 0-1.42l-4.24-4.29a1 1 0 0 0-1.42 0l-2.82 2.83l-6.94 6.93a1 1 0 0 0-.29.71m10.76-8.35l2.83 2.83l-1.42 1.42l-2.83-2.83ZM8 13.17l5.93-5.93l2.83 2.83L10.83 16H8Z" />
                                            </svg>
                                            <div class="modal fade text-left" id="UpdateData{{ $item->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">Form Update Satuan
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('satuan.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="modal-body">
                                                                <label>Nama: </label>
                                                                <div class="form-group">
                                                                    <input type="text" placeholder=""
                                                                        class="form-control" name="nama"
                                                                        value="{{ $item->nama }}" required>
                                                                </div>
                                                                <label>Deskripsi: </label>
                                                                <div class="form-group">
                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi"> {{ $item->deskripsi }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <button type="submit"
                                                                    class="btn btn-primary mr-1 mb-1">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{ $satuan->links() }}
                        </div>
                    </div>
                </div>
                <!--login form Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Form Satuan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('satuan.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <label>Nama: </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="" class="form-control" name="nama" required>
                                    </div>
                                    <label>Deskripsi: </label>
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
