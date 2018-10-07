<?php

namespace App\Controller;

use App\Entity\Video;
use App\Http\JsonResponse;
use App\Http\Request;
use App\Mapper\VideoMapper;

/**
 * Class VideoController
 * @package App\Controller
 *
 * @property VideoMapper $mapper
 */
class VideoController extends AbstractController
{
    /**
     * GET /video
     */
    public function index(Request $request)
    {
        return new JsonResponse(['data' => array_map(function (Video $video) {
            return $video->toArray();
        }, $this->mapper->findAll())]);

    }

    public function show(Request $request, array $params)
    {
        ['id' => $uuid] = $params;

        $video = $this->mapper->find($uuid);

        $data = $video ? $video->toArray() : ['code' => 404, 'message' => sprintf("Video [%s] not found.", $uuid)];

        return new JsonResponse(['data' => $data]);
    }

    public function update(Request $request, array $params)
    {
        ['id' => $uuid] = $params;

        $data = $request->getPost();

        if (!$data) {
            return (new JsonResponse(['data' => ['code' => 404, 'message' => 'Data are missing for updating']]))->withStatus(404);
        }

        $response = $this->mapper->update(['uuid' => $uuid] + $data);

        $message = $response
            ? ['code' => 200, 'message' => sprintf("Video [%s] is updated.", $uuid)]
            : ['code' => 404, 'message' => sprintf("Video [%s] not found or already updated.", $uuid)];

        return new JsonResponse(['data' => $message]);
    }

    public function delete(Request $request, array $params)
    {
        ['id' => $uuid] = $params;

        $video = $this->mapper->find($uuid);

        if ($video) {
            $this->mapper->delete($uuid);
            $data = ['code' => 200, 'message' => sprintf("Video [%s] has been deleted.", $uuid)];

            /** @var Video[] $videos */
            $videos = $this->mapper->findBy(['playlist_uuid' => $video->getPlaylistUuid()], ['rank' => 'asc']);

            foreach ($videos as $index => $entity) {
                $entity->setRank($index + 1);
                $this->mapper->update($entity->toArray() + ['uuid' => $entity->getUuid()]);
            }
        } else {
            $data = ['code' => 404, 'message' => sprintf("Video [%s] not found.", $uuid)];
        }

        return new JsonResponse(['data' => $data]);
    }
}