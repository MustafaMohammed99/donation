<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image_path' => $this->project->projects_paths->first()->image_path ?? '',
            'association_name' => $this->project->association->name,
            'category_name' => $this->project->category->name,
            'title' => $this->project->title,
            'amount' => $this->amount,
        ];
    }
}
