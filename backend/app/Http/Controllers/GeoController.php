<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeoController extends Controller
{
    public function getCountries(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Country::all());
    }

    public function getRegions(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Region::all());
    }

    public function getCities($name = false): \Illuminate\Http\JsonResponse
    {
        $cities = [];
        if ($name) {
            $name = mb_ucfirst($name);
            $cities = City::with( ['country', 'region'])
                ->select(['id', 'name', 'country_id', 'region_id'])
                ->where('name', 'LIKE', "$name%")
                ->get();
            $cities->makeHidden(['name', 'country', 'region', 'country_id', 'region_id']);
        }


        return response()->json($cities);
    }

}
