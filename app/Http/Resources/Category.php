<?php

namespace App\Http\Resources;

use Exception;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $isAdmin = false;
        try {
            $isAdmin = JWTAuth::parseToken()->authenticate()->role === 'ROLE_ADMIN';
        } catch (Exception $error) {

        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'articles' => $this->when($isAdmin, $this->articles),
        ];
    }
}
