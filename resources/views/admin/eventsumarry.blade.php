@extends('layouts.adminlayout')
@section('content')
<div class="container">
    <div>
        <div class="searchbar d-flex justify-content-between mt-3">
            <a href="{{ route('attendance') }}" class="return text-center"><i class="fa-regular fa-circle-left"></i> Return</a>
            <form class="d-flex justify-content-end" role="search">
                <div class="search">
                <input type="search" id="searchInput" class="form-control-me-2" placeholder="Search" aria-label="Search">
                
                </div>
            </form>
        </div>
        <table class="table datatable table-bordered border-dark table-striped mt-3 text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>No. of Events Attended</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($member as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->membername }}</td>
                    <td>Number of Events</td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection