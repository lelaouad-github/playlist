<?php

namespace App\Entity;

use App\Traits\Arrayable;
use DateInterval;
use DateTime;

class Video
{
    use Arrayable;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $thumbnail;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var DateTime
     */
    protected $publishedAt;

    /**
     * @var DateInterval
     */
    protected $duration;

    /**
     * @var int
     */
    protected $viewCount;

    /**
     * @var int
     */
    protected $rank;

    /**
     * @var Playlist
     */
    protected $playlist;

    /**
     * @var string
     */
    protected $playlistUuid;

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlaylistUuid(): ?string
    {
        return $this->playlistUuid;
    }

    public function setPlaylistUuid(string $playlistUuid): self
    {
        $this->playlistUuid = $playlistUuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getPublishedAt(): DateTime
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(DateTime $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return DateInterval
     */
    public function getDuration(): DateInterval
    {
        return $this->duration;
    }

    public function setDuration(DateInterval $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function setViewCount(int $viewCount): self
    {
        $this->viewCount = $viewCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * @return Playlist
     */
    public function getPlaylist(): Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(Playlist $playlist): self
    {
        $this->playlist = $playlist;
        return $this;
    }

    function toArray(): array
    {
        return [
            'id' => $this->uuid,
            'title' => $this->title,
            'thumbnail' => $this->thumbnail,
            'created_at' => $this->createdAt ? $this->createdAt->format('Y-m-d H:i:s') : null,
            'published_at' => $this->publishedAt ? $this->publishedAt->format('Y-m-d H:i:s') : null,
            'duration' => $this->duration ? $this->duration->format('%H:%I:%S') : null,
            'view_count' => $this->viewCount,
            'rank' => $this->rank,
            'playlist_uuid' => $this->playlistUuid
        ];
    }
}