<?php

namespace App\Repositories\Photo;

use App\Models\Photo;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PhotoRepository extends BaseRepository implements IPhotoRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Photo::class;
    }

    /**
     * @return Collection
     */
    public function getAllPhotoNoDeletedAt(): Collection
    {
        return DB::table('photo')
            ->where(['deleted_at' => null])
            ->orderByDesc('id')
            ->get(
                array(
                    'id',
                    'photo_path',
                    'photo_name',
                    'photo_description',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                )
            );

    }
}
