@extends('layouts.adminlayout')
@section('content')
    @include('sidebar.adminsidebar')
    <div class="container annualfee">
        <div class="container annualfeelayout">
                <div class="searchbar d-flex justify-content-between mt-3">
                    <a href="{{ route('treasury') }}" class="return text-center"><i class="fa-regular fa-circle-left"></i> Return</a>
                    <form class="d-flex justify-content-end" role="search">
                        <div class="search">
                        <input type="search" id="searchInput" class="form-control-me-2" placeholder="Search" aria-label="Search">
                        
                        </div>
                    </form>
                </div>
                <div class="containertable" style="max-height: 350px">
                        <table class="table datatable table-bordered border-dark table-striped mt-3 text-center">
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
                                    <form method="POST" action="{{ route('updateAnnualFeeStatus', $member->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-{{ $member->annualFees->first()->annualfee_status ? 'success' : 'secondary' }}" onclick="confirmStatusChange()">
                                            @if ($member->annualFees->first()->annualfee_status == 1)
                                                Paid
                                            @else
                                                Pending
                                            @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
        </div>
    </div>
    <script>
        function confirmStatusChange() {
            var confirmed = window.confirm("Are you sure you want to change the status?");
            if (confirmed) {
                document.getElementById("updateForm").submit();
            }
        }
    </script>
@endsection