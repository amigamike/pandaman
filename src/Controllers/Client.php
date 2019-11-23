<?php
/**
 * Client controller.
 *
 * @package     AmigaMike\Pandaman\Controllers\Client
 * @author      Mike Welsh (mike@amigamike.com)
 * @copyright   2019 AmigaMike (amigamike.com)
 * @link        https://amigamike.com
 * @version     0.0.1
 */
namespace AmigaMike\Pandaman\Controllers;

use GuzzleHttp\Client as Guzzle;

class Client
{
    /**
     * Guzzle client.
     */
    private $guzzle = null;    

    public function __construct()
    {
        $this->guzzle = new Guzzle(
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $GLOBALS['slack']['bot_access_token'],
                    'Content-type' => 'application/json'
                ]
            ]
        );
    }

    public function send(string $channel, string $message)
    {
        $response = $this->guzzle->post(
            'https://slack.com/api/chat.postMessage',
            [
                "json" => [
                    "channel" => $channel,
                    "text" => $message,
                    "username" => $GLOBALS['slack']['username']
                ]
            ]
        );
    }
}
