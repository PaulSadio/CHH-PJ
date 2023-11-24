<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\addmember;
use App\Models\Adminmemo;
use App\Models\Fundraiser;
use App\Models\Memberss;
use App\Models\Proposals;
use App\Models\Registrations;
use App\Models\Remarks;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class PageController extends Controller
{
    public function signin() {
        return view('signin');
    }

    public function welcome() {
        return view('welcome');
    }

    public function registermember() {
        return view('auth.register');
    }
    
    public function admin() {
        return view('admin.adminhome');
    }

    public function member() {
        return view('member.memberhome');
    }

    public function annualfee() {
        return view('admin.treasuryannualfee');
    }

    public function evaluation() {
        $member = Memberss::all();
        return view('admin.evaluation', ['member'=>$member]);
    }
    public function view(Memberss $member, Proposals $adminproposal, Remarks $remarks) {
        $adminproposal = Proposals::all();
        $remarks = Remarks::all();
        return view('admin.view', compact('member', 'adminproposal', 'remarks'));
    }
    public function viewstore(Request $request) {
        $data = [
            'memberremark' => $request -> remark
        ];
        $newView = Remarks::create($data);
        return redirect(route('evaluation'));
        
    }

    public function treasury() {
        $data = Fundraiser::all();
        $totalfee = 9000;
        $total = $data->sum('fundraiser_amount');
        $totaltreasury = $total + $totalfee;
        return view('admin.treasury', compact('total'), compact('totaltreasury'));
    }
    public function fundraiser() {
        $totalFund = 0;
        $fund = Fundraiser::all();
        return view('admin.treasuryfundraiser', ['fund'=> $fund] , ['totalFund'=>$totalFund]);
    }
    public function fundstore(Request $request) {
        $data = [
            'fundraiser_title' => $request -> fundraiser_title,
            'fundraiser_amount' => $request -> fundraiser_amount,
            'fundraiser_date' => $request -> fundraiser_date
        ];
        $newFund = Fundraiser::create($data);
        return redirect(route('fundraiser'));
    }


    public function adminmemo(Request $request) {
        $announcement = Adminmemo::all();
        return view('admin.memo', ['announcement'=>$announcement]);
        

    }

    public function announcement() {
        $announcement = Adminmemo::all();
        return view('member.memberannouncement', ['announcement'=>$announcement]);
    }

    // download member announcement
    public function announcementstore(Request $request){
        $request->validate([
            'memofile' => 'required|mimes:pdf,doc,docx,png,jpeg,jpg',
        ]);
        $data = new Adminmemo();

        if($request->hasFile('memofile')) {
            $memofile = $request->file('memofile');
            $announcefile = $memofile->getClientOriginalName();

            $memofile->storeAs('memofile', $announcefile);
            $data->memofile = $announcefile;
        }

        $data->save();
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function downloadannouncement($memofile){
        $announcementpath = storage_path('app/memofile/' .$memofile);

        if (file_exists($announcementpath)){
            return response()->download($announcementpath);
        } else{
            abort(404, 'oh noes!');
        }
    }
    // download member announcement
    

    public function attendance() {
        $attendance = Registrations::all();
        $adminproposal = Proposals::all();
        return view('admin.attendance', ['attendance'=>$attendance], ['adminproposal'=>$adminproposal]);
    }
    public function registration() {
        return view('member.memberregistration');
    }
    public function regstore(Request $request) {
        $data = [
            'eventid'=> $request -> eventid,
            'participantname'=> $request -> participantname,
            'participantid'=> $request -> participantid,
            'participantemail'=> $request -> participantemail
        ];
        $newReg = Registrations::create($data);
        return redirect(route('registration'));
    }
    

    public function addmember() {
        return view('admin.addmember');
    }
    public function adminmembers() {
        $addmember = Memberss::all();
        return view('admin.members', ['addmember'=>$addmember]);
    }
    public function store(Request $request) {
        // $request->validate([
        //     'profilepic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        // $profilepicpath = $request->file('profilepic')->store('profilepic', 'public');

        $data = [
        'membername' => $request -> membername,
        'memberaddress'=> $request -> memberaddress,
        'memberemail'=> $request -> memberemail,
        'contactnumber'=> $request -> contactnumber,
        'memberage'=> $request -> memberage,
        'membersex'=> $request -> membersex,
        'birthday'=> $request -> birthday,
        'profilepic'=> $request ->profilepic
        ];

        $newData = Memberss::create($data);
        return redirect(route('adminmembers'));

        // $member = new Memberss;
        // $member->membername = $request->input('membername');
        // $member->memberaddress = $request->input('memberaddress');
        // $member->memberemail = $request->input('memberemail');
        // $member->contactnumber = $request->input('contactnumber');
        // $member->memberage = $request->input('memberage');
        // $member->membersex = $request->input('membersex');
        // $member->birthday = $request->input('birthday');
        // if ($request->file('profilepic')) {
        //     $file = $request->file('profilepic');
        //     $extention = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$extention;
        //     $file->move('upload/profile/' , $filename);
        //     $member->profilepic = $filename;
        // }
        // $member->save();
        // return redirect()->back()->width('status', 'Member profile added');
    }
    public function update(Memberss $member, Request $request) {
        $data = [
        'membername' => $request -> membername,
        'memberaddress'=> $request -> memberaddress,
        'memberemail'=> $request -> memberemail,
        'contactnumber'=> $request -> contactnumber,
        'memberage'=> $request -> memberage,
        'membersex'=> $request -> membersex,
        'birthday'=> $request -> birthday,
        'profilepic'=> $request ->profilepic
        ];
        $member->update($data);
        return redirect(route('adminmembers'));
    }
    public function edit(Memberss $member) {
        return view('admin.adminmemberedit', ['member'=>$member]);
    }

    public function adminproposal() {
        $adminproposal = Proposals::all();
        return view('admin.proposal', ['adminproposal'=>$adminproposal]);
    }
    public function proposal() {
        return view('member.memberproposal');
    }
    
  // download proposal
  public function propstore(Request $request) {
    $request->validate([
        'propfile' => 'required|mimes:pdf,doc,docx,png,jpeg,jpg',
    ]);

    $data = new Proposals();

    if ($request->hasFile('propfile')) {
        $propfile = $request->file('propfile');
        $ProposeFile = $propfile->getClientOriginalName();

        $propfile->storeAs('proposals', $ProposeFile);
        $data->propfile = $ProposeFile;
    }
    
    $data->propname = $request->input('propname');
    $data->proptitle = $request->input('proptitle');
    $data->propdate = $request->input('propdate');
    $data->proplocation = $request->input('proplocation');
    
    $data->save();

    return redirect()->back()->with('message', 'Proposal submitted successfully!');
}


public function download ($propfile){
    $filePath = storage_path('app/proposals/' . $propfile);
    if (file_exists($filePath)){
        return response()->download($filePath);
    } else {
        abort(404, 'Wala ang file');
    }
}
// download proposal  

// download memo
    public function memostore(Request $request) {
        $request->validate([
            'memofile' => 'required|mimes:pdf,doc,docx,png,jpeg,jpg',
        ]);
        $data = new Adminmemo();

        if($request->hasFile('memofile')) {
            $memofile = $request->file('memofile');
            $memorandumfile = $memofile->getClientOriginalName();

            $memofile->storeAs('memofile', $memorandumfile);
            $data->memofile = $memorandumfile;
        }
        // $data->memofile = $request->input('memofile');
        $data->save();
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

public function downloadmemo($memofile) {
    $memopath = storage_path('app/memofile/' . $memofile);

    if (file_exists($memopath)){
        return response()->download($memopath);
    } else{
        abort(404, 'oh noes! Iyakies');
    }
}
// download memo
}
