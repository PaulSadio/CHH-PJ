@extends('layouts.adminlayout')
@section('content')
<div class="card proposallayout" style="width: 95%;">
    <h1 class="display-4" style="color: black">Proposal</h1>
    <div class="container proposaltable">
        <div class="container">
            <div class="searchbar d-flex justify-content-end">
                <form class="d-flex justify-content-end" role="search">
                    <div class="search">
                        <input type="search" id="searchInput" class="form-control-me-2" placeholder="Search" aria-label="Search">
                    </div>
                </form>
            </div>
            <div class="containertable" style="max-height: 225px">
                <table class="table datatable table-bordered border-dark table-striped mt-3 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Title</th>
                            <th>Proponent</th>
                            <th>Files</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adminproposal as $adminproposal)
                        <tr>
                            <td>{{ $adminproposal->id }}</td>
                            <td>{{ $adminproposal->proptitle }}</td>
                            <td>{{ $adminproposal->propname }}</td>
                            <td>
                                {{-- download ni--}}
                                <a href="{{ url('download', $adminproposal->propfile) }}" download> {{ $adminproposal->propfile }}</a>
                                {{-- download ni --}}
                            </td>
                            <td style="width: 25%">
                                <div class="container d-flex">
                                    @if ($adminproposal->status == 'approved')
                                        <button disabled>Approved</button>
                                    @else
                                    <form id="approveForm_{{ $adminproposal->id }}" action="{{ route('proposalApprove', ['proposal' => $adminproposal]) }}" method="post">
                                        @csrf
                                        <button type="button" class="btn btn-success mx-3" onclick="confirmAndSubmit('approveForm_{{ $adminproposal->id }}')">
                                            @if ($adminproposal->propstatus === 'approved')
                                                    Approved
                                                @else
                                                    Approve
                                                @endif
                                        </button>
                                    </form>
                                    
                                    <form id="declineForm_{{ $adminproposal->id }}" action="{{ route('proposalDecline', ['proposal' => $adminproposal]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger mx-3" onclick="confirmAndSubmit('declineForm_{{ $adminproposal->id }}')">Decline</button>
                                    </form>
                                    
                                   
                                    
                                        {{-- <form action="{{ route('proposalApprove', ['proposal' => $adminproposal]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-success mx-3" onclick="approve('approveForm_{{ $adminproposal->id }}')">
                                                @if ($adminproposal->propstatus === 'approved')
                                                    Approved
                                                @else
                                                    Approve
                                                @endif
                                        </button>
                                        </form>

                                        <form action="{{ route('proposalDecline', ['proposal' => $adminproposal]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mx-3" onclick="decline('declineForm_{{ $adminproposal->id }}')">Decline</button>
                                        </form> --}}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmAndSubmit(formId) {
                                            var confirmed = window.confirm("Are you sure you want to proceed?");
                                            if (confirmed) {
                                                document.getElementById(formId).submit();
                                            } else {
                                                // Optional: Handle cancellation, for example, show an alert or perform other actions
                                                alert("Action canceled.");
                                            }
                                        }
    //  function approve(formId) {
    //     var confirmed = window.confirm("Are you sure you want to approve?");
    //     if (confirmed) {
    //         document.getElementById(formId).submit();
    //     } else {
    //         alert("Action canceled.");
    //     }
    // }
    // function decline(formID) {
    //     var confirmed = window.confirm("Are you sure you want to decline this proposal?");
    //     if (confirmed) {
    //         document.getElementById(formId).submit();
    //     } else {
    //         alert("Action canceled.");
    //     }
    // }   
</script>
@endsection
