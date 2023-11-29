<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\addmember;
use App\Models\Adminmemo;
use App\Models\Annualfee;
use App\Models\Fundraiser;
use App\Models\Memberss;
use App\Models\Proposals;
use App\Models\Registrations;
use App\Models\Remarks;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use PhpParser\Builder\Property;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class PageController extends Controller
{
    public function signin() {
        return view('signin');
    }

    public function eventsumarry() {
        $member = Memberss::all();
        return view('admin.eventsumarry', compact('member'));
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
        $member = Memberss::all();
        $fees = Annualfee::all();
        return view('admin.treasuryannualfee', ['member'=>$member], ['fees'=>$fees]);
    }
    public function updateAnnualFeeStatus($id)
    {
        $member = Memberss::with('annualFees')->find($id);
        foreach ($member->annualFees as $annualFee) {
            $annualFee->annualfee_status = $annualFee->annualfee_status ? 0 : 1;
            $annualFee->save();
        }
        $firstAnnualFee = $member->annualFees->first();
        if ($firstAnnualFee) {
            $member->update(['annualfee_status' => $firstAnnualFee->annualfee_status]);
        }

        return redirect()->back();
    }

    public function evaluation() {
        $member = Memberss::all();
        return view('admin.evaluation', compact('member'));
    }
    public function view(Memberss $member, Proposals $adminproposal)
    {
        $remarks = $member->remarks()->latest()->get();
        return view('admin.view', compact('remarks', 'adminproposal'), ['member' => $member]);
    }
    public function viewstore(Request $request, Memberss $member) 
{
    $request->validate([
        'memberremark' => 'required|string',
    ]);

    // Assuming 'remarks' is the relationship in your Memberss model
    $remark = $member->remarks()->first();

    // Create or update the remark
    if ($remark) {
        $remark->update(['memberremark' => $request->input('memberremark')]);
    } else {
        $member->remarks()->create(['memberremark' => $request->input('memberremark')]);
    }

    return redirect()->route('evaluation', ['member' => $member])->with('success', 'Remark added successfully');
}


    


    

    public function treasury() {
        $data = Fundraiser::all();
        $totalfee = Annualfee::where('annualfee_status', 1)->sum('annualfee_amount');
        $total = $data->sum('fundraiser_amount');
        $totaltreasury = $total + $totalfee;
        return view('admin.treasury', compact('total', 'totaltreasury', 'totalfee'));
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
    
    public function attendaceid($id) {
        $proposal = Proposals::find($id);

        if ($proposal !== false && $proposal !== null) {
            // Record found, you can safely access $proposal->id
            $proposalId = $proposal->id;
        } else {
            // Record not found, handle accordingly
            // For example, redirect or show an error message
            abort(404); // or redirect()->route('not.found');
        }
    }

    public function attendance() {
        $adminproposal = Proposals::where('propstatus', 'approved')->get();
        // $attendance = Proposals::with('registrations')->get();
        $attendance = Registrations::all();
       
        return view('admin.attendance', compact('adminproposal', 'attendance'));
    }
    public function proposallist() {
        $proposal = Proposals::all();

        return view('member.proposallist', compact('proposal'));
    }


    public function registration() {
        return view('member.memberregistration');
    }
    public function regstore(Request $request) {
        $data = [
            'event_id'=> $request -> eventid,
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
    public function updatestatus($id)
    {
        try {
            $member = Memberss::findOrFail($id);
            $member->memberstatus = $member->memberstatus ? 0 : 1;
            $member->save();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle member not found exception (redirect, show an error, etc.)
            return redirect()->back()->with('error', 'Member not found');
        }
    
        return redirect()->back()->with('success', 'Member status updated successfully');
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

    public function proposalApprove(Proposals $proposal)
    {
        if ($proposal->propstatus === 'pending') {
            $proposal->update(['propstatus' => 'approved']);
            return redirect()->back()->with('propstatus', 'Proposal approved!');
        }

        return redirect()->back()->with('status', 'Proposal is not pending.');
    }

    public function proposalDecline(Proposals $proposal)
    {
        if ($proposal->propstatus === 'pending') {
            $proposal->update(['propstatus' => 'declined']);
            return redirect()->back()->with('propstatus', 'Proposal declined!');
        }

        return redirect()->back()->with('status', 'Proposal is not pending.');
    }
}
