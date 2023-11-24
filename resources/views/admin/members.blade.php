@extends('layouts.adminlayout')
@section('content')
    @include('sidebar.adminsidebar')
    <div class="container members">
        <div class="container memberlayout">
            <div class="membersearchbar d-flex justify-content-between">
                <div>
                    <a href="{{ route('addmember') }}">
                        <input type="button" value="Add Member:">
                    </a>
                </div>
                <form class="d-flex justify-content-end" role="search">
                    <div class="search">
                        <input type="search" id="searchInput" class="form-control-me-2" placeholder="Search" aria-label="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </form>
            </div>
    
            <div class="containertable text-center mb-3" style="max-height: 350px">
                <table class="table datatable table-bordered border-dark table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($addmember as $member)
                    <tr scope="row">
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->membername }}</td>
                        <td>{{ $member->memberemail }}</td>
                        <td style="width: 25%">
                            <div class="d-flex text-center">
                                <a href="{{ route('edit', ['member'=>$member]) }}">
                                    <input type="button" value="Update" class="mx-3" style="background-color: #4e7edb; width: 100px;">
                                </a>
                                <button class="mx-3" onclick="btn()" id="status" style="background-color: #32D942; width: 100px;">Active</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection