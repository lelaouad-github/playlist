<?php

namespace App\Controller;

use App\Entity\Video;
use App\Http\JsonResponse;
use App\Http\Request;
use App\Mapper\VideoMapper;
use Ramsey\Uuid\Uuid;

class PlaylistVideoController extends AbstractController
{
    /**
     * @var VideoMapper
     */
    protected $mapper;

    /**
     * GET /video
     */
    public function index(Request $request, array $params)
    {
        ['playlist_id' => $playlistId] = $params;

        $videos = $this->mapper->findBy(['playlist_uuid' => $playlistId], ['rank' => 'asc']);

        return new JsonResponse(['data' => array_map(function (Video $video) {
            return $video->toArray();
        }, $videos)]);

    }

    /**
     * @param int $id
     * POST /playlist/{id}/video
     */
    public function create(Request $request, array $params)
    {
        ['playlist_id' => $playlistUuid] = $params;

        $data = $request->getPost();

        $uuid = Uuid::uuid4()->toString();
        $data = [
                'uuid' => $uuid,
                'created_at' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
                'playlist_uuid' => $playlistUuid,
                'duration' => preg_replace('/^(\d+):(\d+):(\d+)$/', 'PT$1H$2M$3S', $data['duration'])
            ] + $data;

        $videos = $this->mapper->findBy(['playlist_uuid' => $playlistUuid]);
        $this->mapper->insert($data + ['rank' => count($videos) + 1]);

        return new JsonResponse(['data' => $data]);
    }
}