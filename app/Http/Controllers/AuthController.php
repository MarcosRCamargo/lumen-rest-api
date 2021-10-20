<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (empty($email) || empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'You must fill all fields']);
        }
        $client = new Client();
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:8000/v1/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'client_secret' => 'ntBy1J1SIwkTPeWSU5PS7u05oEQYyHIR47oE2uT0',
                'grant_type' => 'password',
                'client_id' => 2,
                'username' => $request->email,
                'password' => $request->password
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;die;
            $client   = new \GuzzleHttp\Client();
            $response = $client->get('localhost:8000/api/posts');
            return $response;die;
            return $client->request('GET', 'localhost:8000/api/posts', ['debug' => true ]);die;
            return $client->request('POST', 'localhost:8000/v1/oauth/token', [
                'form_params' => [
                    'client_secret' => 'ntBy1J1SIwkTPeWSU5PS7u05oEQYyHIR47oE2uT0',
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'username' => $request->email,
                    'password' => $request->password
                ],[
                    'debug' => true,
                    'connect_timeout' => 3.14
                ]
            ]);
        } catch (BadResponseException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
