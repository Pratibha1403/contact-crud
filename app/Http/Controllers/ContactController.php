<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',

        ]);

        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact Deleted Successfully');
    }

    public function importXML(Request $request){
        
        $request->validate([
            'xml_file' => 'required|mimes:xml|max:2048',
        ]);

        $xml = simplexml_load_file($request->file('xml_file')->getRealPath());
        // dd($xml);
        foreach($xml->contact as $contact){
            
            Contact::create([
                'name' => (string)$contact->name,
                'phone' => (string)$contact->phone,
            ]);
        }
        return redirect()->route('contacts.index')->with('success', 'Contacts Imported Successfully');
    }
}
