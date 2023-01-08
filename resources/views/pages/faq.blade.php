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
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Permasalahan yang sering ditanyakan</h4>
                                @if ($user->pivot->role_id == 1)
                                    <div class="card-header-action">
                                        <a href="{{ route('faq.create') }}" class="btn btn-danger">Tambah FAQ <i
                                                class="fas fa-chevron-right"></i></a>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                            @foreach ($faqs as $faq)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                        id="faq-{{ $faq->id }}-tab" data-toggle="tab"
                                                        href="#faq{{ $faq->id }}" role="tab"
                                                        aria-controls="faq{{ $faq->id }}"
                                                        aria-selected="true">{{ $faq->role }}-{{ $faq->question }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <div class="tab-content no-padding" id="myTab2Content">
                                            @foreach ($faqs as $faq)
                                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                    id="faq{{ $faq->id }}" role="tabpanel"
                                                    aria-labelledby="faq-{{ $faq->id }}-tab">
                                                    <p>{{ $faq->answer }}</p>

                                                    @if ($user->pivot->role_id == 1)
                                                        <a class="btn btn-primary">Edit</a>
                                                        <form action="{{ route('faq.delete', $faq->id) }}" method="post"
                                                            class="d-inline">
                                                            @csrf
                                                            @method ('delete')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
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
@endpush
