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
                <h1>Deashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i> Withdrawal
                        </a>
                        <a type="button" class="btn btn-danger" href="{{ route('detail-sell-saham') }}">
                            <i class="fas fa-handshake"></i> Sell Saham
                        </a>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Posts</h4>
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
                                            <th>Title</th>
                                            <th>Sell Amount</th>
                                            <th>Sell Price</th>
                                            <th>Earning Per Share</th>
                                            <th>Price To Book Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($saham_sale as $saham)
                                            <tr>
                                                <td>
                                                    {{ $saham->company->slug }}
                                                    <div class="table-links">
                                                        <a href="#">{{ $saham->company->name }}</a>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($saham->amount) }} lembar</td>
                                                <td>Rp {{ number_format($saham->price) }}</td>
                                                <td>{{ round($saham->earning_per_share, 2) }}</td>
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
                <div class="col-lg-3 col-md-12 col-12 col-sm-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Balance</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($wallet) }}
                            </div>
                        </div>
                    </div>
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Saham</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($saham_owned->count()) }}
                            </div>
                        </div>
                    </div>
                    <div class="card gradient-bottom">
                        <div class="card-header">
                            <h4>Your Saham</h4>
                            <div class="card-header-action">
                                <div class="btn-group dropdown">
                                    <a href="#" class="btn btn-primary dropdown-toggle"
                                        data-toggle="dropdown">Sorting</a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <a class="dropdown-item">Naik Teratas</a>
                                        <a class="dropdown-item">Turun Teratas</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="top-5-scroll">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($saham_owned as $saham)
                                    <li class="media">
                                        <img class="mr-3 rounded" width="55"
                                            src="{{ asset('img/products/product-3-50.png') }}" alt="product">
                                        <div class="media-body">
                                            <div class="float-right">
                                                <div class="font-weight-600 text-muted text-small">{{ $saham->amount }}
                                                    lembar</div>
                                            </div>
                                            <div class="media-title">{{ $saham->company->slug }}</div>
                                            <div class="mt-1">
                                                <div class="budget-price">
                                                    <div class="budget-price-square bg-primary"
                                                        data-width="{{ $saham->price / 100 }}%"></div>
                                                    <div class="budget-price-label">Rp{{ $saham->price }}</div>
                                                </div>
                                                <div class="budget-price">
                                                    <div class="budget-price-square bg-danger"
                                                        data-width="{{ $saham->company->price_average / 100 }}%"></div>
                                                    <div class="budget-price-label">
                                                        Rp{{ round($saham->company->price_average) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer d-flex justify-content-center pt-3">
                            <div class="budget-price justify-content-center">
                                <div class="budget-price-square bg-primary" data-width="20"></div>
                                <div class="budget-price-label">Buy Price</div>
                            </div>
                            <div class="budget-price justify-content-center">
                                <div class="budget-price-square bg-danger" data-width="20"></div>
                                <div class="budget-price-label">Avg Selling Price</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->

    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
