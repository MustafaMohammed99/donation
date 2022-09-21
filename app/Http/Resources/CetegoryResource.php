<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CetegoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image_path'=>$this->projects_paths->first()->image_path ?? '',
            'association_id' => $this->association_id,
            'category_id' => $this->category_id,
//            'duration_unit' => $this->duration_unit,
            'interval' => $this->interval,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
