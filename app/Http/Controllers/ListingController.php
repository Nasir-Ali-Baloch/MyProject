<?php

namespace App\Http\Controllers;
use id;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    //show all listings
    public function index()
    {
        $listings = Listing::latest()->Filter(request(['tag','search']))->paginate(4);
        return view('listings.index ', [

            'listings' => $listings
        ]);
    }
    
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required',Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required',
            
        ]);
        if ($request->hasFile('logo')) {
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        $formFields['user_id'] = Auth::id();
        Listing::create($formFields);
        return redirect('/')->with('message','Listing Created Successfully');
    }
//show single listing..
    public function show(Listing $listing)
    {
        // dd($listing);
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
    
        return view('listings.edit',['listing'=>$listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {   
        //Make sure logged in user is owner
        if ($listing->user_id !=auth::id()) {
            abort(403,'Unauthorized Action'); 
        }
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if ($request->hasFile('logo')) {
            $formFields['logo']=$request->file('logo')->store('logos','public');
    }
    
    $formFields['user_id']=auth::id();
    $listing->update($formFields);
    return back()->with('message','Listing Updated  Successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //Make sure logged in user is owner
        if ($listing->user_id !=auth::id()) {
            abort(403,'Unauthorized Action'); 
        } 
        $listing->delete();

        return redirect('/')->with('message','Listing Deleted successfully');
    }
    public function manage()
    {
        return view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
    }
}
