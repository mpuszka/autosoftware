<?php

namespace App\API;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class Request
{
  private $client;

  private $response;

  public function __construct(HttpClientInterface $client)
  {
    $this->client = $client;
  }

  public function makeRequest(string $query): void
  {
    $response = $this->client->request(
        'GET',
        $query
    );

    $this->response = $response;
  }

  public function getRequestMessage(): ?string
  {
    if (200 !== $this->getResponseStatusCode()) {
      $content = $this->getResponseContent();
      $jsonEncodeContent = json_decode($content);

      return ($jsonEncodeContent) ? $jsonEncodeContent->message : 'Something goes wrong';
    }

    return null;
  }

  public function getResponseStatusCode(): int
  {
    return $this->response
                ->getStatusCode();
  }

  public function getResponseContent(): string
  {
    return $this->response
                ->getContent(false);
  }

  public function getResponseContentArray(): array
  {
    return $this->response
                ->toArray();
  }
}
