<?php

namespace App\Mapper;

use App\Entity\Video;
use DateInterval;
use DateTime;

/**
 * Class VideoMapper
 * @package App\Mapper
 *
 * @method Video find($id)
 */
class VideoMapper extends AbstractMapper
{
    protected $entityClass = Video::class;

    protected $table = 'video';

    protected function createEntity(array $data)
    {
        [
            'uuid' => $uuid,
            'title' => $title,
            'thumbnail' => $thumbnail,
            'duration' => $duration,
            'view_count' => $viewCount,
            'rank' => $rank,
            'created_at' => $createdAt,
            'published_at' => $publishedAt,
            'playlist_uuid' => $playlistUuid
        ] = $data;

        $duration = preg_replace('/^(\d+):(\d+):(\d+)$/', 'PT$1H$2M$3S', $duration);

        return (new Video())
            ->setUuid($uuid)
            ->setTitle($title)
            ->setThumbnail($thumbnail)
            ->setDuration(new DateInterval($duration))
            ->setRank($rank)
            ->setViewCount($viewCount)
            ->setCreatedAt(new DateTime($createdAt))
            ->setPublishedAt(new DateTime($publishedAt))
            ->setPlaylistUuid($playlistUuid)
            ;
    }

    public function findBy(array $criteria = [], array $orders = [])
    {
        $qb = $this->connection->createQueryBuilder();

        $qb
            ->select('*')
            ->from($this->table)
        ;

        foreach ($criteria as $field => $value) {
            $qb
                ->andWhere($field . ' = :' . $field)
                ->setParameter($field, $value)
            ;
        }

        foreach ($orders as $sort => $order) {
            $qb->addOrderBy($sort, $order);
        }

        $stm =  $qb->execute();

        return array_map(function (array $row) {
            return $this->createEntity($row);
        }, $stm->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function insert(array $data)
    {
        ['uuid' => $uuid, 'playlist_uuid' => $playlistUuid] = $data;

        $data = array_intersect_key($data, (new $this->entityClass)->toArray());

        $this->connection->insert($this->table, $data + ['uuid' => $uuid, 'playlist_uuid' => $playlistUuid]);
    }
}