@extends('layouts.main')
@section('main')
    @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
    <form method="post" action="{{ route('qna.store') }}" >
        @csrf
        <div class="form-group">
            <label for="pertanyaan">pertanyaan</label>
            <input id="pertanyaan" type="pertanyaan" class="form-control" name="pertanyaan" tabindex="1" required autofocus>
            <div class="invalid-feedback">
                Please fill in your pertanyaan
            </div>
        </div>
        <div class="form-group">
            <label for="jawaban">jawaban</label>
            <input id="jawaban" type="jawaban" class="form-control" name="jawaban" tabindex="1" required autofocus>
            <div class="invalid-feedback">
                Please fill in your jawaban
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Save
            </button>
        </div>
    </form>
@endsection