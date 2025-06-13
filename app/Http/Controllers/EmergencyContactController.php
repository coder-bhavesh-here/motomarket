<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyContact;
use Illuminate\Support\Facades\Auth;

class EmergencyContactController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $contact = $user->emergencyContact;

        return view('emergency_contacts.form', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'emergency_contact_1_name' => 'nullable|string|max:255',
            'emergency_contact_1_phone' => 'nullable|string|max:20',
            'emergency_contact_1_email' => 'nullable|email|max:255',

            'emergency_contact_2_name' => 'nullable|string|max:255',
            'emergency_contact_2_phone' => 'nullable|string|max:20',
            'emergency_contact_2_email' => 'nullable|email|max:255',

            'emergency_contact_3_name' => 'nullable|string|max:255',
            'emergency_contact_3_phone' => 'nullable|string|max:20',
            'emergency_contact_3_email' => 'nullable|email|max:255',
        ]);

        $user = Auth::user();

        $user->emergencyContact()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'emergency_contact_1_name',
                'emergency_contact_1_phone',
                'emergency_contact_1_email',
                'emergency_contact_2_name',
                'emergency_contact_2_phone',
                'emergency_contact_2_email',
                'emergency_contact_3_name',
                'emergency_contact_3_phone',
                'emergency_contact_3_email',
            ])
        );

        return redirect()->route('emergency-contacts.edit')->with('success', 'Emergency contacts updated successfully.');
    }
}
