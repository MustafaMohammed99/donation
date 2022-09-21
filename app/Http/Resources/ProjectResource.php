<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'reason' => $this->project_stopping->reason_stopping ?? '',
//            'reason_stopping'=>$this->project_stopping ?? '',
            'id' => $this->id,
            'image_path' => $this->projects_paths->first()->image_path ?? '',
            'association_id' => $this->association_id,
            'category_id' => $this->category_id,
            'price_stock' => $this->price_stock,
            'require_amount' => $this->require_amount,
            'received_amount' => $this->received_amount,
            'duration_unit' => $this->duration_unit,
            'interval' => $this->interval,
            'num_beneficiaries' => $this->num_beneficiaries,
            'current_num_beneficiaries' => $this->current_num_beneficiaries,
            'status' => $this->status,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => [$this->category],
            'association' => [$this->association],
            'projects_paths' => $this->projects_paths,
        ];
    }
}
