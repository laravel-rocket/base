<?php
namespace App\Http\Responses\Api\V1;

class AccessToken extends Response
{
    protected $columns = [
        'accessToken'  => '',
        'tokenType'    => '',
        'refreshToken' => '',
        'expiresIn'    => 0,
    ];

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return static
     */
    public static function updateWithResponse($response)
    {
        $body = (string) $response->getBody();

        $response = new static([], 400);
        if (!empty($body)) {
            $json       = json_decode($body, true);
            $modelArray = [
                'tokenType'    => array_get($json, 'token_type', ''),
                'accessToken'  => array_get($json, 'access_token', ''),
                'refreshToken' => array_get($json, 'refresh_token', ''),
                'expiresIn'    => array_get($json, 'expires_in', ''),
            ];
            $response   = new static($modelArray, 200);
        }

        return $response;
    }
}
