<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\CustomLogTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use Illuminate\Support\Facades\DB;

class ClubSwanController extends Controller
{
    use CustomLogTrait;
    public function singUp(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v2/auth/signup',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "email": "' . $data['email'] . '",
                    "password": "' . $data['password'] . '",
                    "brand" : "Club Swan",
                    "firstName": "' . $data['name'] . '",
                    "lastName": "' . $data['last_name'] . '",
                    "latinFirstName": "' . $data['name'] . '",
                    "latinLastName": "' . $data['last_name'] . '",
                    "dateOfBirth": "' . $data['birthday'] . '",
                    "phone": "+' . $data['cell'] . '",
                    "postCode": "' . $data['postcode'] . '",
                    "countryCode": "' . $data['country'] . '",
                    "city": "' . $data['city'] . '",
                    "addressLine1": "' . $data['address1'] . '",
                    "addressLine2": "' . $data['address2'] . '",
                    "state": "' . (($data['country'] == 'US') ? $data['state'] : '') . '"
                }',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json'
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success('User Integrated');
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            return $e->getMessage();
        }
    }

    public function login(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/auth/login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "email": "' . $data['email'] . '",
                    "password": "' . $data['password'] . '"
                }',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json'
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error("API Error: " . $error->message);
            return $e;
        }
    }

    public function subscribe(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/membership/subscribe',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "planId": "' . $data['planId'] . '"
                }',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json',
                    'contactId: ' . $data['contactId']
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }

    public function kyc(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/kyc/status',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json',
                    'contactId: ' . $data['contactId']
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }

    static public function kycStatic(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/kyc/status',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json',
                    'contactId: ' . $data['contactId']
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                DB::table('custom_log')->insert(
                    [
                        'content'   => $response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response),
                        'user_id'   => '0',
                        'operation' => 'KYC Status Check',
                        'controller' => 'ClubSwanController',
                        'http_code' => '200',
                        'route'     => 'N',
                        'status'    => 'success',
                    ]
                );
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            DB::table('custom_log')->insert(
                [
                    'content'   => $error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(),
                    'user_id'   => '0',
                    'operation' => 'KYC Status Check',
                    'controller' => 'ClubSwanController',
                    'http_code' => '500',
                    'route'     => 'N',
                    'status'    => 'error',
                ]
            );
            return $e;
        }
    }

    public function availableCrypto(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/crypto/available-currencies',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json'
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }

    public function depositQuote(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/crypto/deposit-quote?fiatCurrency=' . $data['fiatCurrency'] . '&fiatAmount=' . $data['fiatAmount'] . '&cryptoCurrency=' . $data['cryptoCurrency'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json'
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }

    public function depositCreate(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/crypto/deposit',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "fiatAmount": ' . $data['fiatAmount'] . ',
                    "fiatCurrency": "' . $data['fiatCurrency'] . '",
                    "cryptoCurrency": "' . $data['cryptoCurrency'] . '"
                }',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json'
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }

    public function deposit(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/crypto/deposit/' . $data['depositId'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json'
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }

    public function depositCancel(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/crypto/deposit/' . $data['depositId'] . '/cancel',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json'
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }

    public function getWalletList(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v2/account/ewallet',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json',
                    'contactId: ' . $data['contactId']
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }

    public function m2m(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/transaction/m2m',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "senderCurrency": "' . $data['senderCurrency'] . '",
                    "receiverAccountNumber": ' . $data['receiverAccountNumber'] . ',
                    "amount": ' . $data['amount'] . ',
                    "reference": "' . $data['reference'] . '"
                }',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json'
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }

    public function paymentRequest(array $data)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://partner.tst.auws.cloud/v1/transaction/payment-request',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "sourceMemberEmail": "' . $data['sourceMemberEmail'] . '",
                    "beneficiaryAccountNumber": "' . $data['beneficiaryAccountNumber'] . '",
                    "amount": ' . $data['amount'] . ',
                    "currency": "' . $data['currency'] . '",
                    "reference": "' . $data['reference'] . '",
                    "paymentDate": "' . $data['paymentDate'] . '",
                    "recurringPeriod": "' . $data['recurringPeriod'] . '"
                }',
                CURLOPT_HTTPHEADER => array(
                    'X-AU-Key: 2bad9d92-9feb-412c-ad50-95b798602015',
                    'X-AU-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjJiYWQ5ZDkyLTlmZWItNDEyYy1hZDUwLTk1Yjc5ODYwMjAxNSJ9.eyJrZXkiOnsia2V5SWQiOiIyYmFkOWQ5Mi05ZmViLTQxMmMtYWQ1MC05NWI3OTg2MDIwMTUiLCJwYXJ0bmVySWQiOiI0YTU4MTA3Yi01N2IxLTQyZTAtOTc5Mi03MDQ5NjEzYzVkZmIiLCJjb250YWN0SWQiOiJmOTViODBkNy1lNmJiLTQ0NjAtYWFjNC0yNzJiOGQxODRhNjYifSwic2NvcGVzIjpbImFkbWluIiwidXNlciJdLCJpYXQiOjE2NzQwMTkyNzAsImV4cCI6MTcwNTU1NTI3MCwiYXVkIjoicGFydG5lcnMiLCJpc3MiOiJBVSIsImp0aSI6IjAwYTkxMWYyLWJjZWItNDdkMC04OWIzLTc2N2Q4MzRhZjRjZCJ9._L1k9ekEZ7Oh-ePn8WbPckT0Sr1gJBqQrHWmHCC__i8',
                    'Content-Type: application/json'
                ),
            ));
            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            if ($response->status == 'success') {
                $this->createLog($response->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . json_encode($response), 200, 'success', auth()->user()->id);
                Alert::success($response->message);
                return $response;
            } else {
                throw new Exception(json_encode($response));
            }
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            $this->errorCatch($error->message . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
            Alert::error($error->message);
            return $e;
        }
    }
}
