# Simple PHP HTTP Request Class

This project create a simple HTTP request class in PHP

# Code strucure

        HTTPRequest
          HTTPClient.php
          index.php

# Installation

1, Clone project from git.
2, Use your favourite PHP server, point url to this folder.
3, Open configure url in browser to see the result.

# Detail

HTTPClient.php is the created Http reqeust class
Index.php it the example to use this Class.
You can create your own php file to import this class.

To use this class:

```sh
require_once('HttpClient.php');
$httpClient = new HttpClient();
```

GET request:

```sh
$httpClient->get($uri);
```

#### Explanation

\$url: pass the url you want request

POST request:

```sh
$httpClient->post($uri, $data, $token);
```

#### Explanation

$url: pass the url you want request
$data: request payload, json format
\$token: privide token, set empty if token is not required

PUT request:

```sh
$httpClient->put($uri, $data, $token);
```

#### Explanation

$url: pass the url you want request
$data: request payload, json format
\$token: privide token, set empty if token is not required

Authetication request:

```sh
$httpClient->authenticate($uri);
```

#### Explanation

\$url: pass the url you want request

All request will return respond in follow json structure:

```sh
{
    'data':'123',
    'success':true,
    'errorMsg':'error message',
    'httpRespond':200
}
```

#### Explanation

data: the respond data content, empty when there is no respond;
success: tell wether API call success or not;
errorMsg: provide error message when error happens;
httpRespond: provide http respond code;

# Author

Jason Ping
