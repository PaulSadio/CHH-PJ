@extends('layouts.adminlayout')
@section('content')
    <div class="container view">
        <div class="container p-3">
            <div class="d-flex justify-content-end">
                <a href="{{ route('evaluation') }}">
                    <button style="background-color: transparent; border:none; font-size: 30px;"><i class="fa-regular fa-circle-xmark"></i></button>
                </a>
                
            </div>
       

            <div class="container d-flex justify-content-between">
                
                <div class="container text-center mx-4" >
                    <img src="" alt="Profile" style="height: 200px; width: 200px;">
                </div>
                <div class="container">
                        <div class="d-flex flex-column">
                            
                            <label for="membername" style="padding: 0; color:black;">Name:</label>
                            <input type="text" value="{{ $member->membername }}" disabled>
                            <label for="contactnumber" style="padding: 0; color:black;">Contact No:</label>
                            <input type="number" value="{{ $member->contactnumber }}" disabled>
                            <label for="memberemail" style="padding: 0; color:black;">Email:</label>
                            <input type="email" value="{{ $member->memberemail }}" disabled>
                           
                        </div>
                </div>
                
                <div class="container">
                    <div class="container text-center">
                        <div class="container d-flex align-middle">
                            <label for="event" style="padding: 0; color:black;">Events Attended: </label>
                            <input type="number" class="totalnumevent mx-2" style="width: 40px" disabled>
                        </div>
                        <div class="mt-2">
                        <input list="eventname" name="event" id="event" placeholder="Event Name...">
                        <datalist id="eventname">
                            @foreach ($adminproposal as $adminproposal)
                            <option value="{{ $adminproposal->proptitle }}"></option>
                            @endforeach
                        </datalist>
                        </div>
                        <div class="container">
                            <label for="subscription" style="padding: 0; color:black;">Annual subscription fee:</label>
                            <input type="text" disabled>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <form action="{{ route('viewstore', ['member'=>$member]) }}" method="post">
            @csrf
            @method('post')
                <div class="container text-center mb-3" >
                    <label for="remark"style="padding: 0; color:black; font-size: 30px">Remarks: </label>
                    <textarea type="text" name="remark" style="width: 90%; height: 120px;"></textarea>
                    <input type="submit" value="Submit" style="width: 300px">
                </div>
                
        </form>
    </div>

    
@endsection