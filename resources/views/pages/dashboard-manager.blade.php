@extends('layouts.app')

@section('title', 'Chart.JS')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Harga Jual Per Hari</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Total Penjualan Saham Per Hari</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>User Name</th>
                                        <th>Company</th>
                                        <th>Amount</th>
                                        <th>Price</th>
                                        <th>Tax</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions_in_day as $transaction)
                                        <tr>
                                            <td>{{ $transaction->type }}</td>
                                            <td>{{ $transaction->user->name }}</td>
                                            <td>{{ $transaction->company->slug }}</td>
                                            <td>{{ $transaction->amount }}</td>
                                            <td>{{ $transaction->price }}</td>
                                            <td>{{ $transaction->tax }}</td>
                                            <td>{{ $transaction->date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Jumlah Penjualan Tiap COmpany</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>Com</th>
                                        <th>Harga Rata-Rata</th>
                                        <th>Total Saham</th>
                                        <th>Earning Per Share</th>
                                        <th>Saham On Sale</th>
                                        <th>Estimation Tax</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_company as $saham)
                                        <tr>
                                            <td>
                                                {{ $saham->slug }}
                                            </td>
                                            <td>Rp {{ number_format(round($saham->price_average)) }}</td>
                                            <td>{{ $saham->total_saham }}</td>
                                            <td>{{ round($saham->earning_per_share, 2) }}</td>
                                            <td>{{ $saham->on_sale }}</td>
                                            <td>Rp {{ number_format($saham->estimation_tax) }}</td>
                                            <td>
                                                <a class="btn btn-info btn-action mr-1" data-toggle="tooltip"
                                                    href="{{ route('detail-saham', $saham->id) }}" title="Details"><i
                                                        class="fas fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('modules/chart.min.js ') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-chartjs.js') }}"></script>
@endpush
