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
                @if (session('error'))
                    <div class="row">
                        <div class="col mt-0">
                            <div class="card">
                                <div class="alert alert-danger mb-0">
                                    {{ session('error') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (session('success'))
                    <div class="row">
                        <div class="col mt-0">
                            <div class="card">
                                <div class="alert alert-success mb-0">
                                    {{ session('success') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-9 col-md-7 col-7 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Semua saham yang anda miliki</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>Slug</th>
                                                <th>Perusahaan</th>
                                                <th>Harga Beli</th>
                                                <th>Jumlah</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($saham_owned as $saham)
                                                <tr>
                                                    <td>
                                                        {{ $saham->company->slug }}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="font-weight-600"><img
                                                                src="{{ asset('img/avatar/avatar-1.png') }}" alt="avatar"
                                                                width="30" class="rounded-circle mr-1">
                                                            {{ $saham->company->name }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $saham->price }}
                                                    </td>
                                                    <td>
                                                        {{ $saham->amount }}
                                                    <td>
                                                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                            title="Jual" onclick="fillForm({{ $saham->id }})"><i
                                                                class="fas fa-money-bill-wave"></i></a>
                                                        <a class="btn btn-danger btn-action" data-toggle="tooltip"
                                                            title="Delete"
                                                            data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                            data-confirm-yes="alert('Deleted')"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Semua saham yang sedang dijual</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>Slug</th>
                                                <th>Perusahaan</th>
                                                <th>Harga Jual</th>
                                                <th>Jumlah</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($saham_sale as $saham)
                                                <tr>
                                                    <td>
                                                        {{ $saham->company->slug }}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="font-weight-600"><img
                                                                src="{{ asset('img/avatar/avatar-1.png') }}" alt="avatar"
                                                                width="30" class="rounded-circle mr-1">
                                                            {{ $saham->company->name }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $saham->price }}
                                                    </td>
                                                    <td>
                                                        {{ $saham->amount }}
                                                    <td>
                                                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                            title="Jual" onclick="fillForm({{ $saham->id }})"><i
                                                                class="fas fa-money-bill-wave"></i></a>
                                                        <a class="btn btn-danger btn-action" data-toggle="tooltip"
                                                            title="Delete"
                                                            data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                            data-confirm-yes="alert('Deleted')"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-5 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('store-sell-saham-user') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="saham_id">saham Perusahaan</label>
                                        <select name="company_id" id="company_id" class="form-control" required>
                                            <option value="">Pilih Perusahaan</option>
                                            @foreach ($saham_owned as $saham)
                                                <option id="saham-{{ $saham->id }}" value="{{ $saham->company->id }}">
                                                    {{ $saham->company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Jumlah yang ingin dijual</label>
                                        <input type="number" class="form-control" name="amount" id="amount"
                                            placeholder="jumlah" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Harga Jual</label>
                                        <input type="number" class="form-control" name="price" id="price"
                                            placeholder="harga" required>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
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
        function fillForm(id) {
            let items = JSON.parse('{!! json_encode($saham_owned) !!}');
            let item = items.find(item => item.id == id);

            console.log('Found item:', item);
            $('#saham_id option').removeAttr('selected');
            $('#saham-' + item.id).attr('selected', 'selected');
            $('#amount').val(item.amount);
            $('#price').val(item.price);

        }
    </script>
@endpush
