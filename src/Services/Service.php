<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use GuzzleHttp\Client;
use Pedros80\TfLphp\Services\Validator;
use Psr\Http\Message\ResponseInterface;

use function Safe\json_decode;
use function Safe\parse_url;

abstract class Service
{
    protected array $url    = [];
    protected array $params = [];

    public function __construct(
        private string $apiKey,
        private Client $client,
        protected Validator $validator
    ) {
    }

    protected function call(string $url, bool $auth): ResponseInterface
    {
        if ($auth) {
            $query = parse_url($url, PHP_URL_QUERY);
            $glue  = $query ? '&' : '?';
            $url   = "{$url}{$glue}api_key={$this->apiKey}";
        }

        return $this->client->get($url);
    }

    protected function get(bool $auth = true): array
    {
        $data = json_decode((string) $this->call($this->getUrl(), $auth)->getBody(), true);

        $this->url    = [];
        $this->params = [];

        return $data;
    }

    protected function getUrl(): string
    {
        $url = implode(
            '/',
            array_map(
                fn (string | array $part) => is_array($part) ? implode(',', $part) : $part,
                $this->url
            )
        );

        if ($this->params) {
            foreach ($this->params as $param => $value) {
                if (is_array($value)) {
                    $this->params[$param] = implode(',', $value);
                }
            }
        }

        $query = $this->params ? http_build_query($this->params) : '';

        if ($query) {
            $url = "{$url}?{$query}";
        }

        return $url;
    }
}
