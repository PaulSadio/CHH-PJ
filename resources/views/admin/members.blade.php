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
                                        <a href="{{ route('edit', ['member' => $member]) }}">
                                            <input type="button" value="Update" class="mx-3" style="background-color: #4e7edb; width: 100px;">
                                        </a>
                                        <form action="{{ route('updatestatus', $member->id) }}" method="POST" id="updateForm-{{ $member->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" class="mx-3 btn btn-{{ $member->memberstatus ? 'success' : 'secondary' }}" onclick="confirmStatusChange({{ $member->id }})" style=" width: 100px;">
                                                @if ($member->memberstatus)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function confirmStatusChange(memberId) {
            var confirmed = window.confirm("Are you sure you want to change the status?");
            if (confirmed) {
                document.getElementById("updateForm-" + memberId).submit();
            }
        }
    </script>
@endsection
