<?php

namespace App\Http\Controllers;

use App\Models\EventAccess;
use App\Services\EventAccessService;
use App\Services\PurchaseService;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

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
        $purchaseService->updatePaidPurchases($purchases);
        $eventAccess = $eventAccessService->generate($purchases);

        return view('eventaccess.index', compact('eventAccess'));
    }

    public function uploadTicketImage(
        Request $request,
        PurchaseService $purchaseService
        )
    {
        try {
        $images = $request->input('images');
        $email = $request->input('email');
        $purchaseId = $request->input('purchase_id');

        $attachments = [];

        foreach ($images as $imageData) {
            $imagePath = storage_path('app/public/tickets/' . uniqid() . '.png');
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
            file_put_contents($imagePath, $imageData);
            $attachments[] = $imagePath;
        }

        // Kirim email dengan semua lampiran gambar
        Mail::send('emails.ticket', [], function ($message) use ($email, $attachments) {
            $message->to($email)
                    ->subject('Tiket Anda');
            foreach ($attachments as $filePath) {
                $message->attach($filePath);
            }
        });

        $purchaseService->updateSendedTicket($purchaseId);
            return response()->json(['success' => true, 'message' => 'All tickets sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send tickets. Please try again.'. $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_admin(
        Request $request, 
        EventAccessService $eventAccessService,
        TicketService $ticketService        
        )
    {
        $jumlah = $request->jumlah;
        $eventAccess = $eventAccessService->generate_admin($jumlah, $request->ticket_id);
        $ticket = $ticketService->find($request->ticket_id);
        return view('users.eventAccessCreate', compact('eventAccess', 'ticket'));
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
