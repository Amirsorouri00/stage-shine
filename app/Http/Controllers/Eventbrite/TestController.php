<?php

namespace App\Http\Controllers\Eventbrite;

use Amirsorouri00\Eventbrite\Factories\Client;
use App\Http\Controllers\Controller;
use Amirsorouri00\Eventbrite\Eventbrite;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getMe()
    {
        return response()->json((new \Amirsorouri00\Eventbrite\Eventbrite(
            new Client(env("EVENTBRITE_BASE_URL"), env("EVENTBRITE_TOKEN"))
        ))->user()->me());
    }
}
