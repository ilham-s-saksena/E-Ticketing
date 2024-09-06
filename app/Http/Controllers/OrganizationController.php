<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Services\OrganizationService;
use Auth;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function organization()
    {
        return view('users.organization');
    }

    public function organization_form(
        Request $request,
        OrganizationService $organizationService
        )
    {
        // dd($request->all());
        $user = Auth::user();
        $organizationService->upadteOrCreate($request->all(), $user);
        return redirect()->back()->with('message', 'Organization successfuly saved');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
