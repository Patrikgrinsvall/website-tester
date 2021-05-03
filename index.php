<?php


require './vendor/autoload.php';

use Spatie\Crawler\Crawler;

class myCrawler extends \Spatie\Crawler\CrawlObservers\CrawlObserver {
/**
     * Called when the crawler has crawled the given url successfully.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
  public function crawled(
    \Psr\Http\Message\UriInterface $url,
    \Psr\Http\Message\ResponseInterface $response,
    ?\Psr\Http\Message\UriInterface $foundOnUrl = null
      )
  {
      print_r($response->getStatusCode(). "\n");
      // print_r($response->getBody(). "\n");
  }

  public function crawlFailed(
    \Psr\Http\Message\UriInterface $url,
    \GuzzleHttp\Exception\RequestException $requestException,
    ?\Psr\Http\Message\UriInterface $foundOnUrl = null
      )
  {
      echo 'failed';
  }

}

use Spatie\Browsershot\Browsershot;

// Browsershot::url('https://google.com/')->save('./screen.png');

$myObject = new myCrawler(); 
$browsershot = new Browsershot(); 
Crawler::create()
->setCrawlObserver($myObject)
->setBrowsershot($browsershot)
  ->executeJavaScript()
->startCrawling('https://google.com/');