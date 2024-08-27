@extends('layouts.main')

@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Kejadian Bencana</h4>
                    <div>
                        <button class="btn btn-danger" type="button" data-toggle="modal"
                            data-target="#inlineForm">Filter</button>
                        <a href="{{ route('bencana.create') }}" class="btn btn-secondary">Tambah Data Bencana</a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Ref</th>
                                    <th>Bencana</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi (Kelurahan/Desa)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bencana as $item)
                                    <tr>
                                        <td>{{ $item->Ref }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="rounded img-fluid avatar-40 me-3 bg-soft-primary"
                                                    {{-- src="{{ asset('hopeui/html/assets/images/products/' . $item['image']) }}" --}}
                                                    src="{{ asset('/frontend/dist/assets/images/avatar/' . $item['gambar']) }}"
                                                    alt="profile" style="width: 100px; height: 100px; margin-right: 10px;">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-0">{{ $item->kategori_bencana->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td class="text-bold-500">{{ $item->kategori_bencana->nama }}</td> --}}
                                        <td class="text-bold-500">{{ $item->tanggal }}</td>
                                        <td>

                                            @foreach ($item->desa as $desa)
                                                <li> {{ $desa->nama }}</li>
                                            @endforeach
                                        </td>
                                        <td>
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{ $bencana->links() }}
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Filter Bencana</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('bencana.index') }}" method="GET" id="filterForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="first-name-column">Kategori Bencana</label>
                                        <div class="form-group">
                                            <select class="form-select" name="kategori_bencana_id" id="kategori_bencana_id">
                                                <option selected disabled value="">{{ __('Pilih...') }}</option>
                                                @foreach ($kategoribencana as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ request()->input('kategori_bencana_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" onclick="resetFilters()"
                                        data-dismiss="modal">{{ __('Reset') }}</button>
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
<script>
    function resetFilters() {
        document.getElementById('kategori_bencana_id').value = '';
        // Submit formulir secara otomatis untuk menghapus filter
        document.getElementById('filterForm').submit();
    }
</script>
