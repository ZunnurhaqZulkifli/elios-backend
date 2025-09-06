<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // 'profile_type' => $this->profile_type,
            // 'profile_id' => $this->profile_id,
            // 'username' => $this->username,
            // 'password' => $this->password,
            // 'avatar' => $this->avatar,
            // 'id_type' => $this->id_type,
            // 'id_number' => $this->id_number,
            // 'phone' => $this->phone,
            // 'register_source' => $this->register_source,
            // 'status' => $this->status,
            // 'remember_token' => $this->remember_token,
            // 'deleted_at' => $this->deleted_at,
            // 'email_verified_at' => $this->email_verified_at,
            // 'profile_view' => $this->profile_view,
            // 'initials' => $this->initials,
            // 'profile' => $this->whenLoaded('profile', function () {
            //     return match ($this->profile_type) {
            //         'individual' => $this->profile->load('city', 'state'),
            //         'organization' => $this->profile,
            //         'staff' => $this->profile->load('branch', 'subBranch', 'state', 'unit', 'section'),
            //         default => null,
            //     };
            // }),
            // 'roles' => $this->whenLoaded('roles', function () {
            //     return $this->roles()->pluck('name')->toArray();
            // }),
            // 'permissions' => $this->whenLoaded('permissions', function () {
            //     $permissions = $this->roles->flatMap(function ($role) {
            //         return $role->permissions;
            //     })->toArray();

            //     return $permissions;
            // }),
        ];
    }
}
