@extends('layouts.main')
<style>
    .row {
        margin-bottom: 20px;
    }
</style>
@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" data-aos="fade-up" data-aos-delay="800">
                            <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">{{ __('Informasi Bencana') }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mt-4">
                                    <table id="basic-table" class="table table-striped mb-0" role="grid">
                                        <tbody>
                                            <tr>
                                                <td>{{ __('Ref') }}</td>
                                                <th>{{ $bencana->Ref }}</th>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Bencana') }}</td>
                                                <th>{{ $bencana->kategori_bencana->nama }}</th>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Tanggal') }}</td>
                                                <th>{{ $bencana->tanggal }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card" data-aos="fade-up" data-aos-delay="800">
                            <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">{{ __('Deskripsi') }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! $bencana->deskripsi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="card credit-card-widget" data-aos="fade-up" data-aos-delay="900">
                    <div class="pb-4 border-0 card-header">
                        <div class="p-4 border border-white rounded primary-gradient-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <img src="{{ asset('/frontend/dist/assets/images/avatar/' . $bencana['gambar']) }}"
                                    alt="" style="width: 100%;height: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <table class="table table-striped mb-0" role="grid">
                        <tbody>
                            <tr>
                                <td>{{ __('Kerusakan') }}</td>
                                <th>{{ 'Rp ' . number_format($totalBiayaPerbaikan, 2, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <td>{{ __('Kerugian') }}</td>
                                <th>{{ 'Rp ' . number_format($totalKerugian, 2, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <td>{{ __('Kebutuhan') }}</td>
                                <th>{{ 'Rp ' . number_format($kebutuhan, 2, ',', '.') }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script></script>
@endpush
