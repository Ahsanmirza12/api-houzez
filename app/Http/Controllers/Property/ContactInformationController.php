<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\ContactInformationRequest;
use App\Models\Property;
use App\Models\Property\ContactInformation;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
{
    //
    public function index()
    {
        $settings = ContactInformation::first();
        return response()->json(['data' => $settings]);
    }

    // Save or update settings
    // Save or update settings
public function storeOrUpdate(ContactInformationRequest $request, Property $property = null)
{
    // Ensure the property exists
    $property = Property::findOrFail($property->id);

    // Debug validated data
    $validatedData = $request->validated();
    

    // Create or update the agent contact setting
    $contact = $property->contactInformation()->updateOrCreate(
        ['property_id' => $property->id],
        $validatedData
    );

    return response()->json([
        'message' => 'Contact information updated successfully',
        'data' => $contact,
    ]);
}
}
