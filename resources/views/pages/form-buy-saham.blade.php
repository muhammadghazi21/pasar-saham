@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat Lembar Saham</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Advanced Forms</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-body">
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
                                <div class="row">
                                    <div class="col">
                                        <div class="chocolat-parent">
                                            <a href="{{ asset('img/example-image.jpg') }}" class="chocolat-image"
                                                title="Just an example">
                                                <div>
                                                    <img alt="image" src="{{ asset('img/example-image.jpg') }}"
                                                        class="img-fluid">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5 col-lg-5">
                                        <br>
                                        <h5>Form Buy Saham</h5>
                                        <table class="table table-striped table-sm">
                                            <tr>
                                                <td>Company</td>
                                                <td>{{ $saham_sale->company->name }} ({{ $saham_sale->company->slug }})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{ $saham_sale->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Stock available</td>
                                                <td>{{ $saham_sale->amount }}</td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td>Rp {{ number_format($saham_sale->price, 0, ',', '.') }} /lembar</td>
                                            </tr>
                                        </table>
                                        <form method="post" action="{{ route('store-buy-saham', $saham_sale->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>Amount purchased</label>
                                                <input type="text" class="form-control" name="amount" id="amount"
                                                    value="{{ $saham_sale->amount }}" placeholder="jumlah lembar saham">
                                            </div>
                                            <p>Total pembayaran (harga x jumlah + tax) = <span id="total-price"></span></p>
                                            <button id="submit" class="btn btn-primary"
                                                style="display: none;">Confirmation</button>
                                        </form>
                                        <button id="cancel" class="btn btn-danger" style="display: none;">Cancel</button>
                                        <button id="submit-button" class="btn btn-primary">Buy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    {{-- <script>
        document.getElementById('amount').addEventListener('change', function() {
            if (this.value > {{ $saham_sale->amount }}) {
                // Menampilkan pesan pemberitahuan
                alert("Input melebihi jumlah saham yang tersedia!");
            }
        });
    </script> --}}
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
    <script>
        document.getElementById("amount").addEventListener("change", function() {
            // Ambil nilai amount dan price yang diinputkan oleh user
            var amount = document.getElementById("amount").value;
            var price = '{{ $saham_sale->price }}';

            // Hitung amount * price
            var total = (amount * price) + (amount * price * 0.1);

            // Tampilkan hasil perhitungan di elemen div atau span
            document.getElementById("total-price").innerHTML = total;
        });

        document.getElementById("submit-button").addEventListener("click", function() {
            // Tampilkan tombol konfirmasi
            document.getElementById("submit").style.display = "block";
            document.getElementById("cancel").style.display = "block";

            // Sembunyikan tombol "Buy"
            document.getElementById("submit-button").style.display = "none";
        });

        document.getElementById("cancel").addEventListener("click", function() {
            // Sembunyikan tombol konfirmasi
            document.getElementById("submit").style.display = "none";
            document.getElementById("cancel").style.display = "none";

            // Tampilkan tombol "Buy"
            document.getElementById("submit-button").style.display = "block";
        });
    </script>
@endpush
