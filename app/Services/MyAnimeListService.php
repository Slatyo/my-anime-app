<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class MyAnimeListService
{
    public const MAL_V2_API_URI = "https://api.myanimelist.net/v2/";

    /**
     * List of available fields you can request from MyAnimeList API
     *
     * @var array|string[]
     */
    public static array $fields = [
        'id',
        'title',
        'main_picture',
        'alternative_titlesv',
        'start_date',
        'end_date',
        'synopsis',
        'mean',
        'rank',
        'popularity',
        'num_list_users',
        'num_scoring_users',
        'nsfw',
        'created_at',
        'updated_at',
        'media_type',
        'status',
        'genres',
        'my_list_status',
        'num_episodes',
        'start_season',
        'broadcast',
        'source',
        'average_episode_duration',
        'rating',
        'pictures',
        'background',
        'related_anime',
        'related_manga',
        'recommendations',
        'studios',
        'statistics',
    ];

    /**
     * @return PendingRequest
     */
    public static function client(): PendingRequest
    {
        return Http::withHeaders([
            'X-MAL-CLIENT-ID' => config('mal.client.id')
        ])->acceptJson()->retry(3, 250)->connectTimeout(30);
    }

    /**
     * @param string $query
     * @param int $limit
     * @param int $offset
     *
     * @return Collection
     */
    public static function search(string $query, int $limit = 100, int $offset = 0): Collection
    {
        // We cannot have a limit higher then 100
        if ($limit > 100) {
            $limit = 100;
        }

        $client = MyAnimeListService::client();

        return $client->get(self::MAL_V2_API_URI . 'anime', [
            'q' => $query,
            'limit' => $limit,
            'offset' => $offset,
        ])->collect();
    }

    /**
     * @param int $id
     * @param array|null $fields
     *
     * @return Collection
     */
    public static function anime(int $id, ?array $fields = null): Collection
    {
        if (!is_null($fields) && count(array_diff($fields, self::$fields))) {
            throw new InvalidParameterException('Fields are not supported.');
        }

        $client = MyAnimeListService::client();

        return $client->get(self::MAL_V2_API_URI . 'anime/' . $id, [
            'fields' => $fields ? implode(',', $fields) : implode(',', self::$fields)
        ])->collect();
    }
}
