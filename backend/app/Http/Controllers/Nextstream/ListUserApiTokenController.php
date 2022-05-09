<?php

namespace App\Http\Controllers\Nextstream;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Ozzie\Nextstream\Nextstream;

class ListUserApiTokenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->json([
            'tokens' => $request->user()->tokens,
            'availablePermissions' => Nextstream::$permissions,
            'defaultPermissions' => Nextstream::$defaultPermissions,
        ]);
    }
}
