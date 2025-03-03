<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function countryList()
    {
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name');
        logger($response->json());

        $countries = collect($response->json())->map(function ($country) {
            return  $country['name']['common'];
        });

        return ApiResponse::success(
            "Country List",
            data: ['countries' => $countries]
        );
    }
}
