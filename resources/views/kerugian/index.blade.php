@extends('layouts.main')

@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data kerugian Akibat Bencana</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Bencana Ref</th>
                                    <th>Ref</th>
                                    <th>Sektor Terdampak</th>
                                    <th>Jumlah Terdampak</th>
                                    <th>Estimasi Nilai Ekonomi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kerugian as $item)
                                    <tr>
                                        <td class="text-bold-500">{{ $item->bencana->Ref }}</td>
                                        <td class="text-bold-500">{{ $item->Ref }}</td>
                                        <td>
                                            @if ($item->tipe == 1)
                                                <h6>Pariwisata</h6>
                                            @elseif ($item->tipe == 2)
                                                <h6>Pertanian</h6>
                                            @elseif ($item->tipe == 3)
                                                <h6>Transportasi</h6>
                                            @endif
                                        </td>
                                        <td class="text-bold-500">{{ $item->kuantitas }} {{ $item->satuan }}</td>
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
                                                        <a href="{{ route('kerugian.edit', $item->id) }}"
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
                                                        {{-- <a href="{{ route('bencana.show', $item->id) }}"
                                                            class="dropdown-item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem"
                                                                height="2rem" viewBox="0 0 24 24">
                                                                <path fill="#5A8DEE"
                                                                    d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0" />
                                                            </svg>
                                                            Detail
                                                        </a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{ $kerugian->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
