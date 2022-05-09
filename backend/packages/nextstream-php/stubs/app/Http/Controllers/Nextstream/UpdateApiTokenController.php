<?php

namespace App\Http\Controllers\Nextstream;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Ozzie\Nextstream\Nextstream;

class UpdateApiTokenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $tokenId)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'string',
        ]);

        $token = $request->user()->tokens()->where('id', $tokenId)->firstOrFail();

        $token->forceFill([
            'abilities' => Nextstream::validPermissions($request->input('permissions', [])),
        ])->save();

        return response()->json(['token' => $token->fresh()]);
    }
}
