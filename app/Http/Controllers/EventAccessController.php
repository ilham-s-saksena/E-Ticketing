<?php

namespace App\Http\Controllers;

use App\Models\EventAccess;
use App\Services\EventAccessService;
use App\Services\PurchaseService;
use Illuminate\Http\Request;

class EventAccessController extends Controller
{
    public function eventaccess(
        Request $request,
        $token,
        PurchaseService $purchaseService,
        EventAccessService $eventAccessService
        )
    {
        $purchases = $purchaseService->findWithToken($token);
        if ($request->query('result')) {   
            $resultJson = $request->query('result');
            $result = json_decode($resultJson, true);
            if ($result['transaction_status'] == "settlement") {
                $purchaseService->updatePaidPurchases($purchases);
            }
        }
        $eventAccess = $eventAccessService->generate($purchases);
        dd($eventAccess);
        return view('eventaccess.index');
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
    public function show(EventAccess $eventAccess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventAccess $eventAccess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventAccess $eventAccess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventAccess $eventAccess)
    {
        //
    }
}
