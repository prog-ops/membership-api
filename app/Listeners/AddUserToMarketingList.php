<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddUserToMarketingList
{
    public function handle(UserRegistered $event)
    {
        $user = $event->user;
        $apiKey = config('services.mailchimp.key');
        $listId = config('services.mailchimp.list_id');
        $serverPrefix = config('services.mailchimp.server_prefix');

        // Panggil API Mailchimp untuk menambahkan subscriber
        $response = Http::withHeaders([
            'Authorization' => 'auth ' . $apiKey,
        ])->post("https://{$serverPrefix}.api.mailchimp.com/3.0/lists/{$listId}/members", [
            'email_address' => $user->email,
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME' => $user->name,
                // Tambah data lain yang relevan
            ],
        ]);

        // Opsional: Log jika gagal
        if (!$response->successful()) {
            Log::error('Failed to add user to Mailchimp list: ' . $response->body());
        }
    }
}
