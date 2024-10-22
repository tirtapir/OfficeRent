<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfficeSpaceResource;
use App\Models\OfficeSpace;
use Illuminate\Http\Request;

class OfficeSpaceController extends Controller
{
    //
    public function index(Request $request)
    {
        $limit = 6;
        $page = $request->input('page', 1);
        $officeSpace = OfficeSpace::with('city')->paginate($limit, ['*'], 'page', $page);
        return OfficeSpaceResource::collection($officeSpace);
    }

    public function show(OfficeSpace $officeSpace)
    {
        $officeSpace->load(['city', 'photos', 'benefits']);
        return new OfficeSpaceResource($officeSpace);
    }
}
