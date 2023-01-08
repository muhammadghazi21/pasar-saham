@extends('layouts.app')

@section('title', 'Ecommerce Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('main')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12" style="display: flex; flex-direction: column;">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card" style="margin-top: auto;">
                        <div class="card-header">
                            <h4>Budget vs Sales</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="199"></canvas>
                        </div>
                        <input type="hidden" id="data_id" value="<?= $company->id ?>">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
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
                                    <div class="profile-widget-item-value">{{ round($company->earning_per_share, 2) }}</div>
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
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center pt-0">
                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                <a type="button" class="btn btn-danger">
                                    <i class="fas fa-sign-out-alt"></i> Withdrawal
                                </a>
                                <a type="button" class="btn btn-danger" id="modal-1">
                                    <i class="fas fa-handshake"></i> Sell Saham
                                </a>
                                @if (isset($saham_owned))
                                    <a type="button" class="btn btn-danger" id="modal-2">
                                        <i class="fas fa-plus-square"></i> Edit Saham
                                    </a>
                                @else
                                    <a type="button" class="btn btn-danger" id="modal-3">
                                        <i class="fas fa-plus-square"></i> Make Saham
                                    </a>
                                @endif

                                {{-- ini modal sell saham --}}
                                <form class="modal-part" id="modal-sell-saham" method="post"
                                    action="{{ route('store-sell-saham', $saham_owned->id) }}">
                                    @csrf
                                    <table class="table table-striped">
                                        <tr>
                                            <td>Jumlah Saham tersisa</td>
                                            <td>{{ number_format($saham_owned->amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Yang sedang dijual</td>
                                            <td>{{ number_format($saham_sale->amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Harga sebelumnya</td>
                                            <td>{{ number_format($saham_owned->price) }}</td>
                                        </tr>
                                    </table>
                                    <div class="form-group">
                                        <label for="amount">Jumlah yang ingin dijual</label>
                                        <input type="number" class="form-control" name="amount" id="amount"
                                            placeholder="jumlah" value="{{ $saham_sale->amount }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Harga yang diinginkan</label>
                                        <input type="number" class="form-control" name="price" id="price"
                                            placeholder="harga" required>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                                {{-- ini modal make/edit saham --}}
                                <form class="modal-part" id="modal-edit-saham" method="post"
                                    action="{{ route('store-edit-saham', $saham_owned->id) }}">
                                    @csrf
                                    <table class="table table-striped">
                                        <tr>
                                            <td>Jumlah Saham tersisa</td>
                                            <td>{{ number_format($saham_owned->amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Seluruh Saham yang beredar</td>
                                            <td>{{ number_format($company->total_saham) }}</td>
                                        </tr>
                                    </table>
                                    <div class="form-group">
                                        <label for="amount">Jumlah saham yang ada</label>
                                        <input type="number" class="form-control" name="amount" id="amount"
                                            placeholder="jumlah" value="{{ $saham_owned->amount }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Harga saham</label>
                                        <input type="number" class="form-control" name="price" id="price"
                                            placeholder="harga" value="{{ $saham_owned->price }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">net income</label>
                                        <input type="number" class="form-control" name="net_income" id="net_income"
                                            placeholder="net income" value="{{ $company->net_income }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">dividend</label>
                                        <input type="number" class="form-control" name="dividend" id="dividend"
                                            placeholder="dividend" value="{{ $company->dividend }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Assets</label>
                                        <input type="number" class="form-control" name="assets" id="assets"
                                            placeholder="assets" value="{{ $company->assets }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Debt</label>
                                        <input type="number" class="form-control" name="debt" id="debt"
                                            placeholder="debt" value="{{ $company->debt }}" required>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card card-statistic-2">
                        <div class="row">
                            <div class="col">
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fas fa-archive"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Saham Spread</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ number_format($user_has_saham_company->count()) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Balance</h4>
                                    </div>
                                    <div class="card-body">
                                        <span class="text-muted small">Rp
                                        </span>{{ number_format($user->wallet->balance) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Sales</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ number_format($saham_owned->amount) }} <span
                                            class="text-muted small">lembar</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Member</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-danger">View More <i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table-striped table">
                                    <tr>
                                        <th>User Email</th>
                                        <th>User Name</th>
                                        <th>Verified</th>
                                        <th>Amount</th>
                                        <th>Last Buy Price</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($user_has_saham_company as $item)
                                        <tr>
                                            <td><a href="#">{{ $item->user->email }}</a></td>
                                            <td class="font-weight-600">{{ $item->user->name }}</td>
                                            <td>
                                                <div class="badge badge-success">{{ $item->user->email_verified_at }}
                                                </div>
                                            </td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card chat-box" id="mychatbox">
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
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('js/page/components-chat-box.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-chartjs2.js') }}"></script>
    <script src="{{ asset('js/page/components-user.js') }}"></script>
@endpush
