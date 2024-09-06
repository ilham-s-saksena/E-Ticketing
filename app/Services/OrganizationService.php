<?php

namespace App\Services;

use App\Models\Organization;

class OrganizationService
{
    public function upadteOrCreate($data, $user){
        if ($user->organization_id == null) {
            $orgPhoto = time() . '_' . uniqid() . '.' . $data['photo']->getClientOriginalExtension();
            $data['photo']->move('organization_img', $orgPhoto);
            # create
            $org = Organization::create([
                'name' => $data['name'],
                'photo' => '/organization_img/'.$orgPhoto,
                'description' => $data['description'],
                'cp_name' => $data['cp_name'],
                'cp_phone' => $data['cp_phone'],
                'address' => $data['address'],
            ]);
            $user->organization_id = $org->id;
            $user->save();
            // dd($user, "ok");
        } else {
            dd($user->organization_id);
        }
    }
}