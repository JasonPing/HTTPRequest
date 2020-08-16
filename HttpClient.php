<?php

class HttpClient
{

    public function __construct()
    {
    }

    public function authenticate(string $uri)
    {
        return $this->apiCall($uri, 'OPTIONS');
    }

    public function post(string $uri, string $data, string $token = '')
    {
        return $this->apiCall($uri, 'POST', $data, $token);
    }

    public function get(string $uri)
    {
        return $this->apiCall($uri, 'GET');
    }

    public function put(string $uri, string $data, string $token = '')
    {
        return $this->apiCall($uri, 'PUT', $data, $token);
    }


    private function apiCall(string $uri, string $method, string $data = '', string $token = '')
    {

        try {

            $status = '';
            //valid json input
            if ($data !== '') {
                json_decode($data);

                if (!(json_last_error() == JSON_ERROR_NONE)) {
                    throw new Exception("invalid json input");
                };
            }


            // form header
            $header = [
                "Content-Type: application/json",
            ];
            if (isset($token)) {
                $header[] = 'Authorization: Bearer ' . $token;
            }

            $options = array(
                'http' => array(
                    "header" => implode("\r\n", $header),
                    'method'  => $method,
                    'content' => $data,
                ),
            );
            $context  = stream_context_create($options);

            // HTTP Request
            $response  = file_get_contents($uri, false, $context);

            // check respond header
            $status_line = $http_response_header[0];
            preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
            $status = $match[1];

            // if respond code not 200 or 202 throw error
            if ($status !== "200" && $status !== "202") {
                throw new Exception("HTTP error: {$status_line}\n" . $response);
            }

            return array(
                "data" => $response,
                "success" => true,
                "errorMsg" => '',
                'httpRespond' => $status
            );
        } catch (Exception $e) {
            return array(
                "data" => '',
                "success" => false,
                "errorMsg" => $e->getMessage(),
                'httpRespond' => $status
            );
        }
    }
}
