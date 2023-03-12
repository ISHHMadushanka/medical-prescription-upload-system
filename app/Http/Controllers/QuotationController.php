<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Prescription;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Quotation $quotation)
    {
        //
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
}
