@extends('layouts.memberlayout')
@section('content')
<div class="container">
    <table class="table table-bordered border-dark table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Proponent</th>
                <th>Event Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proposal as $proposal)
                <tr>
                    <td>{{ $proposal->id }}</td>
                    <td>{{ $proposal->propname }}</td>
                    <td>{{ $proposal->proptitle }}</td>
                    <td>{{ $proposal->propstatus }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection