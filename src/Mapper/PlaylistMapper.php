<?php

namespace App\Mapper;

use App\Entity\Playlist;
use DateTime;

/**
 * Class PlaylistMapper
 * @package App\Mapper
 *
 * @property PlaylistMapper $mapper
 *
 * @method Playlist find($id)
 */
class PlaylistMapper extends AbstractMapper
{
    protected $entityClass = Playlist::class;

    protected $table = 'playlist';

    protected function createEntity(array $data)
    {
        ['uuid' => $uuid, 'name' => $name, 'created_at' => $createdAt, 'published_at' => $publishedAt] = $data;

        return (new Playlist())
            ->setUuid($uuid)
            ->setName($name)
            ->setCreatedAt(new DateTime($createdAt))
            ->setPublishedAt(new DateTime($publishedAt));
    }


}