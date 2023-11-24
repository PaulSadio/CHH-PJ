@extends('layouts.adminlayout')
@section('content')
    @include('sidebar.adminsidebar')
    <div class="container evaluation">
        <div class="container evaluationlayout">
            <div class="membersearchbar d-flex justify-content-end">
                <form class="d-flex justify-content-end" role="search">
                    <div class="search">
                        <input type="search" id="searchInput" class="form-control-me-2" placeholder="Search" aria-label="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </form>
            </div>
            <div class="containertable" style="max-height: 350px">
            <table class="table datatable table-bordered border-dark table-striped text-center">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($member as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->membername }}</td>
                    <td>
                        <div>
                            <a href="{{ route('view', ['member'=>$member]) }}"><i class="fa-solid fa-circle-info"></i> View</a>
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