<?php

namespace Tests\Feature\Jobs;

use App\Jobs\MyAnimeListScraperJob;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class MyAnimeListScraperJobTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        Bus::fake();

        MyAnimeListScraperJob::dispatch();

        Bus::assertDispatched(MyAnimeListScraperJob::class);
    }
}
