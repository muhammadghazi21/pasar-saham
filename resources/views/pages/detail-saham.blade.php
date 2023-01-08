@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>
                    <div class="text-muted d-inline font-weight-normal">detail saham</div>
                    {{ $company->name }}
                    <div class="text-muted d-inline font-weight-normal">
                        <div class="slash"> </div>{{ $company->slug }}
                    </div>
                </h1>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistic Last Week</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-primary">Week</a>
                                    <a href="#" class="btn">Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="182"></canvas>
                        </div>
                        <input type="hidden" id="data_id" value="<?= $company->id ?>">
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Penjualan saham</h4>
                            <div class="card-header-action">
                                <form method="GET" action="{{ route('dashboard-general') }}">
                                    <div class="input-group">
                                        <input name="search" type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Seller</th>
                                            <th>Title</th>
                                            <th>Sell Amount</th>
                                            <th>Sell Price</th>
                                            <th>Price To Book Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($saham_sale as $saham)
                                            <tr>
                                                <td>
                                                    {{ $saham->user->email }}
                                                    <div class="table-links">
                                                        <a href="#">{{ $saham->user->name }}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $saham->company->slug }}
                                                    <div class="table-links">
                                                        <a href="#">{{ $saham->company->name }}</a>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($saham->amount) }} lembar</td>
                                                <td>Rp {{ number_format($saham->price) }}</td>
                                                <td>{{ round($saham->price_to_book_value, 2) }}</td>
                                                <td>
                                                    <a class="btn btn-info btn-action mr-1" data-toggle="tooltip"
                                                        href="{{ route('detail-saham', $saham->company->id) }}"
                                                        title="Details"><i class="fas fa-info-circle"></i></a>
                                                    <a class="btn btn-dark btn-action"
                                                        href="/form-buy-saham/{{ $saham->id }}" data-toggle="tooltip"
                                                        title="Buy"><i class="fas fa-shopping-cart "></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Saham yang Dikeluarkan</div>
                                    <div class="profile-widget-item-value">{{ number_format($company->total_saham) }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">EPS</div>
                                    <div class="profile-widget-item-value">{{ round($company->earning_per_share, 2) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description pb-0">
                            <div class="profile-widget-name">{{ $company->name }} <div
                                    class="text-muted d-inline font-weight-normal">
                                    <div class="slash"> </div>{{ $company->slug }}
                                </div>
                            </div>
                            <table class="table-striped table">
                                <tbody>
                                    <tr>
                                        <td>Net Income</td>
                                        <td>Rp {{ number_format($company->net_income) }},00</td>
                                    </tr>
                                    <tr>
                                        <td>Dividend</td>
                                        <td>Rp {{ number_format($company->dividend) }},00</td>
                                    </tr>
                                    <tr>
                                        <td>Assets</td>
                                        <td>Rp {{ number_format($company->assets) }},00</td>
                                    </tr>
                                    <tr>
                                        <td>Debt</td>
                                        <td>Rp {{ number_format($company->debt) }},00</td>
                                    </tr>
                                    <tr>
                                        <td>Owner</td>
                                        <td>{{ $company->user->email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="card chat-box" id="mychatbox2">
                        <div class="card-header">
                            <h4>Chat with Admin</h4>
                        </div>
                        <div class="card-body chat-content">
                        </div>
                        <div class="card-footer chat-form">
                            <form action="{{ route('send-qna') }}" method="POST">
                                @csrf
                                <input id="message" name="message" type="text" class="form-control"
                                    placeholder="Type a message">
                                <button class="btn btn-primary" id="submit">
                                    <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col">

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('js/page/components-chat-box.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-chartjs2.js') }}"></script>
@endpush
