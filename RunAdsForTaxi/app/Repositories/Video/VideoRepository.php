<?php

namespace App\Repositories\Video;

use App\Models\Video;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VideoRepository extends BaseRepository implements IVideoRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel(): string
    {
        return Video::class;
    }

    /**
     * @return Collection
     */
    function getAllVideoAdsNoDeletedAt(): Collection
    {
        return DB::table('video')
            ->where(['deleted_at' => null])
            ->orderByDesc('id')
            ->get(
                array(
                    'id',
                    'video_path',
                    'video_name',
                    'video_description',
                    'video_length',
                    'video_thumbnail',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                )
            );
    }
}
