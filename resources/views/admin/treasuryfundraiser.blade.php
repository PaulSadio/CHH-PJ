@extends('layouts.adminlayout')
@section('content')
    @include('sidebar.adminsidebar')
    <div class="container fundraiser">
        <div class="container fundraiserlayout">
                <div class="searchbar d-flex justify-content-between mt-3">
                    <a href="{{ route('treasury') }}" class="return text-center"><i class="fa-regular fa-circle-left"></i> Return</a>
                    <form class="d-flex justify-content-end" role="search">
                        <div class="search">
                        <input type="search" id="searchInput" class="form-control-me-2" placeholder="Search" aria-label="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </form>
                </div>
                <div class="container fundraiserdetails">
                    <form action="{{ route('fundstore') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="d-flex">
                            <label for="fundtitle" style="color: black;">Fund Raising Title: </label>
                            <input type="text" name="fundraiser_title" placeholder="Enter Value" style="width: 500px;" required>
                        </div>
                        <div class="d-flex mt-3">
                            <label for="totalfundamount" style="color: black">Total Amount: </label>
                            <input type="number" name="fundraiser_amount" value="Enter Value" required>
                        </div>
                        <div class="d-flex mt-3">
                            <label for="eventdate" style="color: black">Date: </label>
                            <input type="date" name="fundraiser_date" required>
                            <div class="d-flex justify-content-end" style="margin-left: 500px;">
                                <button type="submit" class="btn btn-success" style="width: 100px;">Add</button>
                            </div>
                        </div>
                    </form>
                    <div class="containertable" style="max-height: 200px">
                        <table class="table datatable table-bordered border-dark table-striped mt-3 text-center" >
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Fund Raiser Title</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fund as $fund)
                            <tr>
                                <td>{{ $fund->fundraiser_date }}</td>
                                <td>{{ $fund->fundraiser_title }}</td>
                                <td>{{ $fund->fundraiser_amount }}</td>
                            </tr>
                            @php
                                $totalFund += $fund->fundraiser_amount
                            @endphp
                            @endforeach
                        </tbody>
                        </table>
                        
                    </div>
                </div>
        </div>
    
    </div>
@endsection