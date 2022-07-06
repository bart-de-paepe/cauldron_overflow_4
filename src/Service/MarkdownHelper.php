<?php

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    private $myCache;
    private $myParser;
    private $myIsDebug;
    private $myLogger;
    public function __construct(CacheInterface $cache, MarkdownParserInterface $markdownParser, bool $isDebug, LoggerInterface $mdLogger) {
        $this->myCache = $cache;
        $this->myParser = $markdownParser;
        $this->myIsDebug = $isDebug;
        $this->myLogger = $mdLogger;
    }

    public function parse(string $source): string {
        if(stripos($source, 'cat') !== false) {
            $this->myLogger->info('Meow!');
        }
        if($this->myIsDebug) {
            return $this->myParser->transformMarkdown($source);
        }
        return $this->myCache->get('markdown_'.md5($source), function () use ($source) {
            return $this->myParser->transformMarkdown($source);
        });
    }
}