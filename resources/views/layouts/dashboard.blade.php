@extends('layouts.main')

@section('content')
    <div class="page-title">
        <h3>Dashboard</h3>
    </div>
    <section class="section">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class='table mb-0' id="table1">
                                <thead>
                                    <tr>
                                        <th>Bencana</th>
                                        <th>Kejadian Dalam Setahun</th>
                                        <th>Estimasi Kebutuhan Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reportData as $data)
                                        <tr>
                                            <td>{{ $data['kategori'] }}</td>
                                            <td>{{ $data['kejadian_dalam_setahun'] }}</td>
                                            <td>Rp {{ number_format($data['estimasi_kebutuhan_total'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
