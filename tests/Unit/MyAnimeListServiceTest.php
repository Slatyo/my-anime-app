<?php

namespace Tests\Unit;

use App\Services\MyAnimeListService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Tests\TestCase;

class MyAnimeListServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '*' => Http::response(),
        ]);
    }

    /**
     * @return void
     */
    public function test_that_search_request_route_is_correct()
    {
        MyAnimeListService::search('one');
        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.myanimelist.net/v2/anime?q=one&limit=100&offset=0'
                && $request->method() === 'GET';
        });

        MyAnimeListService::search('one', 5, 50);
        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.myanimelist.net/v2/anime?q=one&limit=5&offset=50'
                && $request->method() === 'GET';
        });

        // Limit over 100 will always set to 100
        MyAnimeListService::search('one', 120, 50);
        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.myanimelist.net/v2/anime?q=one&limit=100&offset=50'
                && $request->method() === 'GET';
        });
    }

    /**
     * @return void
     */
    public function test_that_anime_request_route_is_correct()
    {
        MyAnimeListService::anime(21);
        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.myanimelist.net/v2/anime/21?fields=id%2Ctitle%2Cmain_picture%2Calternative_titlesv%2Cstart_date%2Cend_date%2Csynopsis%2Cmean%2Crank%2Cpopularity%2Cnum_list_users%2Cnum_scoring_users%2Cnsfw%2Ccreated_at%2Cupdated_at%2Cmedia_type%2Cstatus%2Cgenres%2Cmy_list_status%2Cnum_episodes%2Cstart_season%2Cbroadcast%2Csource%2Caverage_episode_duration%2Crating%2Cpictures%2Cbackground%2Crelated_anime%2Crelated_manga%2Crecommendations%2Cstudios%2Cstatistics'
                && $request->method() === 'GET';
        });

        MyAnimeListService::anime(21, ['id', 'title']);
        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.myanimelist.net/v2/anime/21?fields=id%2Ctitle'
                && $request->method() === 'GET';
        });
    }

    /**
     * @return void
     */
    public function test_that_exception_is_thrown_on_unsupported_field()
    {
        $this->expectException(InvalidParameterException::class);
        MyAnimeListService::anime(21, ['id', 'randomValue']);
    }
}
