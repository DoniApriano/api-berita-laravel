<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public $status;
    public $message;
    public $resource;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'status' => $this->status,
            'message' => $this->message,
            'data' => [],
        ];

        foreach ($this->resource as $comment) {
            // Konversi objek komentar menjadi array
            $commentArray = json_decode(json_encode($comment), true);

            // Buat salinan komentar tanpa 'user_id' dan 'news_id'.
            $commentWithoutIds = array_diff_key($commentArray, ['user_id' => 0, 'news_id' => 0, 'updated_at' => 0]);
            $result['data'][] = $commentWithoutIds;
        }

        return $result;
    }
}
