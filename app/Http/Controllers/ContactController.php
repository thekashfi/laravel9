<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $contacts = Contact::query()->latest()->paginate(10);
        return view('list-contact' , compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContactRequest $request, Contact $contact)
    {
        if ( $request->user() != null )
            $request->merge(['user_id' , auth()->id()]);
        $contact->saveOrFail($request->all());
        return redirect()->route('connectus')->with('flash', 'پیام شما با موفقیت ارسال شد، در سریع ترین زمان تیم پشتیبانی پیام شما را مطالعه می‌کنند.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('flash', 'پیام شما با موفقیت ارسال شد، در سریع ترین زمان تیم پشتیبانی پیام شما را مطالعه می‌کنند.');

    }
}
