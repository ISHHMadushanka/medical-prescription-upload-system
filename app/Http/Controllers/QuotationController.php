<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Mail\QuotationMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\QuotationResponseNotification;
use App\Models\User;
use App\Notifications\QuotationResponse;


class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      // Retrieve quotations for the current user
    $quotations = auth()->user()->quotations;

    // Pass the quotations to the view
    return view('quotations.index', compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $prescription = Prescription::find($id);
        return view('quotations.create', compact('prescription'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'drug.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required',
        ]);

        $prescription = Prescription::find($id);

        foreach($request->drug as $key => $value) {
            $quotation = new Quotation;
            $quotation->prescription_id = $prescription->id;
            $quotation->drug = $value;
            $quotation->quantity = $request->quantity[$key];
            $quotation->amount = $request->amount[$key];
            $quotation->save();
        }

        return redirect()->route('prescriptions.show', $id)->with('success', 'Quotation created successfully!');
       //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $prescription = Prescription::findOrFail($id);
    return view('prescriptions.show', compact('prescription'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

    public function sendQuotationToUser($prescriptionId)
    {
        // Prepare quotation data
        $prescription = Prescription::find($prescriptionId);

        $validatedData = request()->validate([
            'drug.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required|numeric',
        ]);

        $quotations = collect();

        foreach ($validatedData['drug'] as $key => $drug) {
            $quotation = new Quotation([
                'drug' => $drug,
                'quantity' => $validatedData['quantity'][$key],
                'amount' => $validatedData['amount'][$key],
            ]);
            $prescription->quotations()->save($quotation);
            $quotations->push($quotation);
        }

        // Send email to user
        $user = $prescription->user;
        Mail::to($user->email)->send(new QuotationMail($prescription, $quotations));

        // Return response
        return response()->json(['message' => 'Quotation sent to user.']);
    }


    public function acceptRejectForm($id)
{
    $quotation = Quotation::find($id);
    return view('quotations.accept_reject_form', compact('quotation'));
}

public function acceptReject(Request $request, $id)
{
    $quotation = Quotation::find($id);
    $quotation->status = $request->input('status');
    $quotation->save();
    return redirect()->route('quotations.index');
}


public function respond(Request $request, $id)
{
    $quotation = Quotation::findOrFail($id);
    $quotation->response = $request->input('response');
    $quotation->save();

    // Send notification to pharmacy user
    $pharmacyUser = User::find($quotation->user_id);
    $pharmacyUser->notify(new QuotationResponseNotification($quotation, $request->input('response')));

    return redirect()->route('quotations.index')->with('success', 'Quotation response has been recorded.');
}

public function processQuotationResponse(Request $request, User $user, Quotation $quotation)
{
    // Retrieve the response from the request
    $response = $request->input('response');

    // Update the status of the quotation in the 'quotations' table to reflect the user's response.
    $quotation->update(['status' => $response]);

    // Notify the pharmacy user who prepared the quotation
    $user->notify(new QuotationResponse($response, $quotation));

    // Redirect the user to the quotations index page
    return redirect()->route('quotations.index');
}

}
