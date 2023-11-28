@extends('layouts.memberlayout')
@section('content')
<div class="containerbody d-flex">
    <div class="sidebar regside">
        <a href="{{ route('registration') }}"><i class="fa-solid fa-file-pen"></i> Registration</a>
    </div>
    <form action="{{ route('regstore') }}" method="POST">
        @csrf
        @method('post')
    <div class="container register" style="width: 70vw;">
        <div class="container registrationlayout text-center">
            <div class="container registerinfo">
                    <div class="mt-3">
                        <label for="eventid" style="color: black;">Event ID:</label>
                        <input type="number" class="form-control" id="eventid" name="event_id" required>
                    </div>
                    <div class="mt-3">
                        <label for="participantname" style="color: black;">Name:</label>
                        <input type="text" class="form-control" id="name" name="participantname" required>
                    </div>
                    <div class="mt-3">
                        <label for="idnumber" style="color: black;">ID No.:</label>
                        <input type="number" class="form-control" id="idnumber" name="participantid" required>
                    </div>
                    <div class="mt-3">
                        <label for="email" style="color: black;">Email:</label>
                        <input type="email" class="form-control" id="email" name="participantemail" required>
                    </div>
            </div>
            <button class="reg mt-3">Register</button>
        </div>
    </div>
    </form>
  </div>
      
@endsection