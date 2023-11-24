@extends('layouts.memberlayout')
@section('content')
<div class="containerbody d-flex">
    <div class="sidebar annside">
        <a href="{{ route('announcement') }}"><i class="fa-solid fa-envelope"></i> Memo</a>
    </div>

    <div class="container membermemo">
        <div class="container membermemolayout">
            <div class="container d-flex justify-content-between">
                <h5 class="mt-2">To open memo download file:</h5>
                <form class="d-flex justify-content-end" role="search">
                    <div class="search">
                        <input type="search" id="searchInput" class="form-control-me-2" placeholder="Search" aria-label="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </form>
            </div>
            <div class="containertable memotable mt-3" style="max-height: 325px">
                <table class="table datatable table-bordered border-dark table-striped text-center  ">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcement as $announcement)
                    <tr>
                        <td>{{ $announcement->id }}</td>
                        <td>{{ $announcement->created_at }}</td>
                        <td>{{ $announcement->memofile }}</td>
                        <td>
                            {{-- <a href="">{{ $announcement->memofile }}</a> --}}
                            
                            {{-- download announcement --}}
                            <a href="{{ route('downloadannouncement', $announcement->memofile) }}" download>{{ $announcement->memofile }}</a>
                            {{-- download announcement --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection