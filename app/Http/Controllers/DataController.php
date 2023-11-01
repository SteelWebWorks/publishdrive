<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

class DataController extends Controller
{
    public function index()
    {
        $data = $this->getData();
        //dd($data);
        return view('data')->with(compact('data'));
    }

    public function getData(): Collection | array
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request("GET", 'https://account.publishdrive.com/Books/users.json');
        if (!empty($response->getHeaders()['Content-Type'][0])) {
            return collect(json_decode($response->getBody()->getContents()));
        }
        return [];
    }
}
