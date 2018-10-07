<?php

namespace App\Controller;


use App\Entity\Playlist;
use App\Http\JsonResponse;
use App\Http\Request;
use App\Mapper\PlaylistMapper;
use Ramsey\Uuid\Uuid;

class PlaylistController extends AbstractController
{
    /**
     * @var PlaylistMapper
     */
    protected $mapper;

    /**
     *
     * GET /playlist
     */
    public function index(Request $request)
    {
        return new JsonResponse(['data' => array_map(function (Playlist $playlist) {
            return $playlist->toArray();
        }, $this->mapper->findAll())]);
    }

    /**
     *
     * POST /playlist
     */
    public function create(Request $request)
    {
        $uuid = Uuid::uuid4()->toString();
        $data = [
                'uuid' => $uuid,
                'created_at' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
            ] + $request->getPost();

        $this->mapper->insert($data);

        return new JsonResponse(['data' => $data]);
    }

    /**
     * @param int $id
     * GET /playlist/{id}
     */
    public function show(Request $request, array $params)
    {
        ['id' => $id] = $params;

        $playlist = $this->mapper->find($id);

        return new JsonResponse(['data' => $playlist ? $playlist->toArray() : []]);
    }

    /**
     * PUT /playlist/{id}
     */
    public function update(Request $request, array $params)
    {
        ['id' => $id] = $params;

        $data = $request->getPost();

        $response = $data ? $this->mapper->update(['uuid' => $id] + $data) : false;

        $message = $response
            ? ['code' => 200, 'message' => sprintf("Playlist [%s] is updated.", $id)]
            : ['code' => 404, 'message' => sprintf("Playlist [%s] not found or already updated.", $id)];

        return new JsonResponse(['data' => $message]);
    }

    /**
     * @param int $id
     * DELETE /playlist/{id}
     */
    public function delete(Request $request, array $params)
    {
        ['id' => $uuid] = $params;

        $response = $this->mapper->delete($uuid);

        $data = $response
            ? ['code' => 200, 'message' => sprintf("Playlist [%s] has been deleted.", $uuid)]
            : ['code' => 404, 'message' => sprintf("Playlist [%s] not found.", $uuid)];

        return new JsonResponse(['data' => $data]);
    }


}