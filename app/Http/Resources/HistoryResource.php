<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class HistoryResource extends JsonResource
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
            'id'=>$this->id,
            'name' => $this->product->name,
            'price' => $this->product->price,
            'count'=>$this->count,
            'image'=>Storage::url($this->product->href),
            'category'=>$this->product->category->name,
            'date'=> Carbon::parse($this->created_at)->format('m.d.Y')
        ];
    }
}
