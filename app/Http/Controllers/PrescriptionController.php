<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function create()
    {
        return view('prescriptions.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'delivery_time' => 'required|in:10:00-12:00,12:00-14:00,14:00-16:00,16:00-18:00,18:00-20:00',
            'images.*' => 'required|image|max:5048' // allow only image files up to 2MB
        ]);

        $user = Auth::user();

        $prescription = new Prescription();
        $prescription->user_id = $user->id;
        $prescription->note = $request->note;
        $prescription->delivery_address = $request->delivery_address;
        $prescription->delivery_time = $request->delivery_time;

        // handle image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('prescriptions', $filename, 'public');
                $images[] = $path;
            }
            $prescription->images = json_encode($images);
        }

        $prescription->save();

        return redirect()->route('prescription.index')->with('success', 'Prescription uploaded successfully.');
    }

    public function index()
    {
        $prescriptions = Prescription::all();
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function show($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription_id = $prescription->id;

        return view('prescriptions.show', compact('prescription', 'prescription_id'));
    }

}
