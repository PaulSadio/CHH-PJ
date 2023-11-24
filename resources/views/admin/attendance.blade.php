@extends('layouts.adminlayout')
@section('content')
    @include('sidebar.adminsidebar')
    <div class="container attendance">
        <div class="container eventname mt-3">
            <input list="magicHouses" id="eventTitle" name="myHouse" placeholder="Event Name..." />
            <datalist id="magicHouses">
                @foreach ($adminproposal as $adminproposal)
                <option value="{{ $adminproposal->proptitle }}">
                @endforeach
            </datalist>
        </div>
    
        <div class="container table mt-5">
            <div class="searchbar">
                <form class="d-flex justify-content-end" role="search">
                    <div class="search">
                    <input type="search" id="searchInput" class="form-control-me-2" placeholder="Search" aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </form>
            </div>
            <div class="containertable" style="max-height: 225px">
            <table class="table table-bordered border-dark table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center" style="width: 30%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendance as $attendance)
                <tr>
                    <td>{{ $attendance->participantname }}</td>
                    <td class="text-center">
                        <button style="background-color: #32D942; width: 100px;" onclick="attendacebtn()" id="attendancebtn">Present</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
    </div>
@endsection