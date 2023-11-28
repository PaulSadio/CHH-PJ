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
                    <img src="{{ url($member->profilepic) }}" alt="Profile" style="height: 200px; width: 200px;">
                </div>
                <div class="container">
                        <div class="d-flex flex-column">
                            
                            <label for="membername" style="padding: 0; color:black;">Name:</label>
                            <input type="text" value="{{ $member->membername }}" disabled>
                            <label for="contactnumber" style="padding: 0; color:black;">Contact No:</label>
                            <div class="input-group" style="margin: 0; padding: 0;">
                            <span class="input-group-text" id="basic-addon1">+63-9</span>
                            <input type="number" class="form-control" value="{{ $member->contactnumber }}" disabled>
                            </div>
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
                            <option value="{{ $adminproposal->proptitle }}"></option>
                        </datalist>
                        
                        
                        </div>
                        <div class="container">
                            <label for="subscription" style="padding: 0; color:black;">Annual subscription fee:</label>
                            <input type="text" class="text-center">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <form action="{{ route('viewstore', ['member' => $member]) }}" method="post">
            @csrf
            @method('post')
            <div class="container text-center mb-3">
                <label for="remark" style="padding: 0; color:black; font-size: 30px">Remarks: </label>
                @foreach ($member->remarks as $remark)
                    <textarea type="text" name="memberremark" style="width: 90%; height: 120px;">{{ $remark->memberremark }}</textarea>
                @endforeach
                {{-- Display an empty textarea if there are no remarks --}}
                @if ($member->remarks->isEmpty())
                    <textarea type="text" name="memberremark" style="width: 90%; height: 120px;"></textarea>
                @endif
                <input type="submit" value="Submit" style="width: 300px">
            </div>
        </form>
        
        
    </div>

    
@endsection