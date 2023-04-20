<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignStoreRequest;
use Promopult\TikTokMarketingApi\Exception\ErrorResponse;

class CampaignCreateController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(CampaignStoreRequest $request)
    {
        //TODO: Create service to implement all logic, move every API request to separate method
        //upload file to S3
        $path = \Storage::disk('s3')->put('videos', $request->video);
        $path = \Storage::disk('s3')->url($path);

        //setup client for API
        $credentials = \Promopult\TikTokMarketingApi\Credentials::fromAccessTokenSandbox(
            env('TIKTOK_TOKEN'));
        $advertiser_id = env('TIKTOK_ADVERTISER');

        $httpClient = new \GuzzleHttp\Client();
        $client = new \Promopult\TikTokMarketingApi\Client(
            $credentials,
            $httpClient
        );

       try{
            $response = $client->video->upload(
                $advertiser_id,
                'video' . random_int(0, 9999999),
                $path
            );
       } catch (ErrorResponse $e) {
           return back()->with('error',$e->getMessage());
           //Option for Vue + API would look like this:
           //return response()->json(['code' => 500,'message' => $e->getMessage()]);
       }
        $video_id  = $response['data'][0]['id'];
        $poster_id = $response['data'][0]['poster_url'];

        try{
        $response = $client->images->upload(
            $advertiser_id,
            'image' . random_int(0, 9999999),
            $poster_id
        );
        } catch (ErrorResponse $e) {
            return back()->with('error',$e->getMessage());
        }
        $image_id = $response['data']['id'];

        try{
            $response =$client->campaign->create(
                $advertiser_id,
                $request->campaign_name,
                $request->objective_type,
                $request->budget_mode,
                $request->budget
            );
        } catch (ErrorResponse $e) {
            return back()->with('error',$e->getMessage());
        }
        $campaign_id = $response['data']['campaign_id'];

        try {
            $response = $client->adGroup->create(
                $advertiser_id,
                $campaign_id,
                'adGroupName' . random_int(0, 9999999),
            );
        } catch (ErrorResponse $e) {
            return back()->with('error',$e->getMessage());
        }
        $adgroup_id = $response['data']['adgroup_id'];

        try {
            $response = $client->ad->create(
                $advertiser_id,
                $adgroup_id,
                $video_id,
                $image_id
            );
        } catch (ErrorResponse $e) {
            return back()->with('error',$e->getMessage());
        }

        return back()
            ->with('success','You have successfully created campaign');
    }
}
