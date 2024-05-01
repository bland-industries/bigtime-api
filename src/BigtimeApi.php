<?php

namespace BlandIndustries\BigtimeApi;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class BigtimeApi
{
    static $token;

    public function getToken()
    {
        if (static::$token) {
            return static::$token;
        }
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $bodyData = [
            "UserId" => config('bigtime.user'),
            "Pwd" => config('bigtime.password'),
            "firm" => config('bigtime.firm'),
        ];
        $body = json_encode($bodyData);
        $request = new Request('POST', 'https://iq.bigtime.net/BigtimeData/api/v2/session', $headers, $body);
        $res = $client->send($request);
        $returnBody = $res->getBody();
        $resData = json_decode($returnBody->getContents(), true);
        static::$token = $resData['token'];
        return $resData['token'];
    }

    public function getAllClients()
    {

        $body = [
            'view' => '',
            'ShowInactive' => '',
            'ApiSource' => '',
        ];
        $data = $this->request('/client', 'GET', $body);

        return $data;
    }

    public function getAllProjects()
    {

        $body = [
            'view' => '',
            'ShowInactive' => true,
        ];
        $data = $this->request('/project', 'GET', $body);

        return $data;
    }

    public function getAllTasksForProject($projectID)
    {
        // for each of its tasks
        $body = [
            'ShowCompleted' => true,
            'view' => 'Detailed',
            'id' => $projectID
        ];
        $taskData = $this->request("/Task/ListByProject", 'GET', $body);

        return $taskData;
    }

    public function time($start, $end)
    {
        $body = [
            'id' => 0,
            'startdt' => $start,
            'enddt' => $end,
            'view' => 'Detailed',
        ];
        $data = $this->request('/time/sheet', 'GET', $body);
        return $data;
    }

    public function saveTimeEntry($data)
    {
        $response = $this->request("/Time", 'POST', $data);
        return $response;
    }

    /**
     * Show the profile for a given user.
     */
    public function request(string $url, string $method = 'GET', array $body = [])
    {
        $token = $this->getToken();
        $client = new Client();
        $headers = [
            'X-Auth-Token' => $token,
            'X-Auth-Realm' => config('bigtime.firm'),
            'Content-Type' => 'application/json'
        ];

        $request = new Request($method, config('bigtime.url') . $url, $headers, json_encode($body));
        try {
            $res = $client->send($request);
        } catch (ServerException $e) {
            dump(Message::toString($e->getRequest()));
            dump(Message::toString($e->getResponse()));
            return [];
        } catch (ClientException $e) {
            dump(Message::toString($e->getRequest()));
            dump(Message::toString($e->getResponse()));
            return [];
        }
        return json_decode($res->getBody()->getContents(), true);
    }
}
