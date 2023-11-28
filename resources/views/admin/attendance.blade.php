@extends('layouts.adminlayout')

@section('content')
    @include('sidebar.adminsidebar')

    <div class="container attendance">
        <div class="container eventname mt-3">
            <select id="eventTitle" name="myHouse" class="form-control text-center"style="width: 400px">
                @foreach ($adminproposal as $admin)
                    <option value="{{ $admin->proptitle }}" style="width: 400px">{{ $admin->proptitle }}</option>
                @endforeach
            </select>
        </div>

        <div class="container table mt-5">
            <div class="searchbar">
                <form class="d-flex justify-content-end" role="search">
                    <div class="search">
                        <input type="search" id="searchInput" class="form-control-me-2" placeholder="Search" aria-label="Search">
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
                        @foreach ($attendance as $attendee)
                            @php
                                $admin = $adminproposal->where('id', $attendee->event_id)->first();
                            @endphp

                            @if ($admin)
                                <tr>
                                    <td>{{ $attendee->participantname }}</td>
                                    <td class="text-center">
                                        <button style="background-color: #32D942; width: 100px;" onclick="attendanceBtn()" id="attendancebtn">Present</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
