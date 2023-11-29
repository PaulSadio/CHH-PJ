@extends('layouts.memberlayout')
@section('content')
<div class="card proposallayout " style="width: 95%;">
    <button style="width: 500px; margin-left: 2rem; border: none; border-radius: 25px;" class="justify-content-center mb-3">
      <h1 class="display-4" style="color: black">
        <a href="{{ route('proposallist') }}">Proposals</a>
      </h1>
    </button>
    <form action="{{ route('propstore') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('post')
    <div class="container proposalsubmit d-flex">
        <div class="container text-center text-white" style="width: 50%;">
            <h4>To download template</h4>
            <h4><a href="{{ asset('Project-Proposal-chh.docx') }}" class="link-offset-2 text-white" download><u>click here</u></a>:</h4>

            <div class="container submitfile ">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <h6 class="mt-2">Upload File here:</h6>
                <input type="file" name="propfile" id="proposalfile" class="my-2" required>
            </div>
            <button type="submit" class="submit mt-3">Submit</button>
        </div>

        <div class="container proposalinfo" style="width: 50%;">
                <div class="mb-2">
                  <label for="propname" class="form-label">Name:</label>
                  <input type="text" class="form-control" id="propname" name="propname" required>
                </div>
                <div class="mb-2">
                  <label for="proptitle" class="form-label">Event Name:</label>
                  <input type="text" class="form-control" id="proptitle" name="proptitle" required>
                </div>
                <div class="mb-2">
                    <label for="propdate" class="form-label">Date:</label>
                    <input type="date" class="form-control" id="propdate" name="propdate" required>
                  </div>
                  <div class="mb-2">
                    <label for="proplocation" class="form-label">Location:</label>
                    <select id="proplocation" name="proplocation" style="width: 300px" required>
                      <option value="Bacolod City"> Bacolod City</option>
                      <option value="Talisay City"> Talisay City</option>
                      <option value="Silay City"> Silay City</option>

                    </select>
                  </div>
        </div>
    </div>
  </form>
</div>
  
@endsection