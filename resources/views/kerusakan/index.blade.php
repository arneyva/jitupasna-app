@extends('layouts.main')

@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Kerusakan Dampak Bencana</h4>
                    {{-- <a href="{{ route('bencana.create') }}" class="btn btn-primary">Tambah Data Bencana</a> --}}
                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#inlineForm">Filter</button>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Bencana Ref</th>
                                    <th>Ref</th>
                                    <th>Kategori Bagunan</th>
                                    <th>Estimasi Biaya Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kerusakan as $item)
                                    <tr>
                                        <td class="text-bold-500">{{ $item->bencana->Ref }}</td>
                                        <td>{{ $item->Ref }}</td>
                                        <td>{{ $item->kategori_bangunan->nama }}</td>
                                        <td>{{ 'Rp ' . number_format($item->BiayaKeseluruhan, 2, ',', '.') }}</td>
                                        <td>
                                            <div class="btn-group mb-1">
                                                <div class="dropdown dropdown-color-icon">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButtonEmoji" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonEmoji">
                                                        <a href="{{ route('kerusakan.edit', $item->id) }}"
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
                                                    </div>
                                                </div>
                                            </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{ $kerusakan->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Form Kategori Bencana</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('kerusakan.index') }}" method="GET" id="filterForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="first-name-column">Kategori Bangunan</label>
                                    <div class="form-group">
                                        <select class="form-select" name="kategori_bangunan_id" id="kategori_bangunan_id">
                                            <option selected disabled value="">{{ __('Pilih...') }}</option>
                                            @foreach ($kategoribangunan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request()->input('kategori_bangunan_id') == $item->id ? 'selected' : '' }}>
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
@endsection
<script>
    function resetFilters() {
        document.getElementById('kategori_bangunan_id').value = '';
        // Submit formulir secara otomatis untuk menghapus filter
        document.getElementById('filterForm').submit();
    }
</script>
