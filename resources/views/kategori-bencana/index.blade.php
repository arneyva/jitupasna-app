@extends('layouts.main')

@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Kategori Bencana</h4>
                    <div>
                        <button class="btn btn-danger">Filter</button>
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
                                @foreach ($kategoriBencana as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        {{-- <td>
                                            <div class="btn-group mb-1">
                                                <div class="dropdown dropdown-color-icon">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButtonEmoji" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonEmoji">
                                                        <a href="{{ route('bencana.edit', $item->id) }}"
                                                            class="dropdown-item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem"
                                                                height="1.5rem" viewBox="0 0 24 24">
                                                                <g fill="none" stroke="#5A8DEE" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2">
                                                                    <path
                                                                        d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                                    <path
                                                                        d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                                </g>
                                                            </svg>
                                                            Update Data
                                                        </a>
                                                        <a href="{{ route('kerusakan.create', $item->id) }}"
                                                            class="dropdown-item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2em"
                                                                height="2em" viewBox="0 0 512 512">
                                                                <path fill="#5A8DEE"
                                                                    d="M87.195 53.838v79.494h44.213V53.838zm344.291 89.422q.51 10.83 1.014 21.662l27.861 41.004l-46.379 17.504l9.409 16.57l-24.334 32.486h86.273V143.26zm-387.562 2.303v124.619H266.61l5.389-54.61l-63.18-17.166l21.7-38.656l-9.46-14.188zm6.709 134.802v201.711h53.316V321.408h96.614v160.668h271.152v-201.71h-83.766l-34.537 13.61l-23.178 30.768l-34.505-29.69l-26.827-14.689z" />
                                                            </svg>
                                                            Kerusakan
                                                        </a>
                                                        <a href="{{ route('kerugian.create', $item->id) }}"
                                                            class="dropdown-item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem"
                                                                height="1.5rem" viewBox="0 0 14 14">
                                                                <path fill="#5A8DEE" fill-rule="evenodd"
                                                                    d="M1.315.606a.75.75 0 0 1 .99-.38l8.591 3.828l.361-.795a.75.75 0 0 1 1.386.05l.8 2.16a.75.75 0 0 1-.438.963l-2.15.81a.75.75 0 0 1-.948-1.013l.368-.81l-8.58-3.822a.75.75 0 0 1-.38-.99ZM1.25 5.5a1 1 0 0 0-1 1v7a.5.5 0 0 0 .5.5h2.5a.5.5 0 0 0 .5-.5v-7a1 1 0 0 0-1-1zm4.293 1.793A1 1 0 0 1 6.25 7h1.5a1 1 0 0 1 1 1v5.5a.5.5 0 0 1-.5.5h-2.5a.5.5 0 0 1-.5-.5V8a1 1 0 0 1 .293-.707M11.25 8.5a1 1 0 0 0-1 1v4a.5.5 0 0 0 .5.5h2.5a.5.5 0 0 0 .5-.5v-4a1 1 0 0 0-1-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Kerugian
                                                        </a>
                                                        <a href="{{ route('bencana.show', $item->id) }}"
                                                            class="dropdown-item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem"
                                                                height="2rem" viewBox="0 0 24 24">
                                                                <path fill="#5A8DEE"
                                                                    d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0" />
                                                            </svg>
                                                            Detail
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td> --}}
                                        <td>
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="#5A8DEE" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5" color="#5A8DEE">
                                                    <path
                                                        d="M21.544 11.045c.304.426.456.64.456.955c0 .316-.152.529-.456.955C20.178 14.871 16.689 19 12 19c-4.69 0-8.178-4.13-9.544-6.045C2.152 12.529 2 12.315 2 12c0-.316.152-.529.456-.955C3.822 9.129 7.311 5 12 5c4.69 0 8.178 4.13 9.544 6.045" />
                                                    <path d="M15 12a3 3 0 1 0-6 0a3 3 0 0 0 6 0" />
                                                </g>
                                            </svg> --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem"
                                                viewBox="0 0 24 24">
                                                <path fill="#5A8DEE"
                                                    d="M21 12a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h6a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-6a1 1 0 0 0-1-1m-15 .76V17a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .71-.29l6.92-6.93L21.71 8a1 1 0 0 0 0-1.42l-4.24-4.29a1 1 0 0 0-1.42 0l-2.82 2.83l-6.94 6.93a1 1 0 0 0-.29.71m10.76-8.35l2.83 2.83l-1.42 1.42l-2.83-2.83ZM8 13.17l5.93-5.93l2.83 2.83L10.83 16H8Z" />
                                            </svg>
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem"
                                                viewBox="0 0 24 24">
                                                <path fill="#5A8DEE"
                                                    d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" />
                                            </svg> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{-- {{ $bencana->links() }} --}}
                        </div>
                    </div>
                    {{-- {{ $bencana->links() }} --}}
                </div>
                <!--login form Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Form Kategori Bencana</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('kategori-bencana.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <label>Nama: </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="" class="form-control" name="name" required>
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
                                    <button type="submit" class="btn btn-primary ml-1" data-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
