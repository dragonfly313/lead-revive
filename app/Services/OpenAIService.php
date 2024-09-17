<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function extractAreaOfInterest($content)
    {
        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ],
            'json'    => [
                "model"      => "gpt-4o",
                "messages"   => [
                    [
                        "role"    => "system",
                        "content" => "Extract specific informations from content when I send you. Give me concise keywork info separating by ' / ' in one line. For example if the content is about car sale, give me car name/number/color/size/cost and if the content is about house give me address/size/cost etc. When no content is provided, tell me 'No content' Please don't tell me any unnecessary words including greetings. Just wait until I give you content then answer shortly."
                    ],
                    [
                        "role"    => "user",
                        "content" => $content
                    ]
                ],
                'max_tokens' => 150,
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);
        return $body['choices'][0]['message']['content'] ?? '';
    }
}
