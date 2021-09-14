<?php

namespace App\Http\Controllers\Services\Twilio;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessInboundTwilioMessageJob;
use Illuminate\Http\Request;
use Twilio\TwiML\MessagingResponse;

class MessagingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProcessInboundTwilioMessageJob::dispatch($request->all());

        return response(new MessagingResponse)
            ->header('Content-Type', 'text/xml');
    }
}
