@extends('layouts.main')
@section('main')
    <div class="row">
        <div class="col-18 col-md-9 col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Semua Pegawai</h4>
                            <div class="card-header-action">
                                <a href="{{ route('user-details.create') }}" class="btn btn-danger">Tambah User <i class="fas fa-chevron-right"></i></a>
                              </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                <tr>
                                    <td>id</td>
                                    <td>Username</td>
                                    <td>Email</td>
                                    <td>Type</td>
                                    <td>Action</td>
                                </tr>
                                    @foreach($users as $u)
                                <tr>
                                    
                                    <td>{{$u->id}}</td>
                                    <td>{{$u->username}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>{{$u->type}}</td>
                                    <td style="display:flex">
                                        <div class="group-btn">
                                            
                                            <form action="{{ route('user-details.delete', $u->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('user-details.edit', $u->id) }}" class="btn btn-primary">Edit</a>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection