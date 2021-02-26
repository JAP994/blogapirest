<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tittle' => $this->tittle,
            'summary' => $this->summary,
            'content' => $this->content,
            'url' => $this->url,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
        ];
    }
}