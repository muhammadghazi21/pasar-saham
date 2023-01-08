@extends('layouts.main')
@section('main')
    <div class="row">
        <div class="col-18 col-md-9 col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit User</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('user-details.update', $user->id) }}" >
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="type" name="type">
                                            <option value="1" {{ $user->type == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="0" {{ $user->type == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="2" {{ $user->type == 'manager' ? 'selected' : '' }}>Manager</option>
                                            <option value="3" {{ $user->type == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection