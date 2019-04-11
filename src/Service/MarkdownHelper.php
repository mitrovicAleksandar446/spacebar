<?php
/**
 * Created by PhpStorm.
 * User: aleksa446
 * Date: 4/12/19
 * Time: 12:57 AM
 */

namespace App\Service;


use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    /**
     * @var AdapterInterface
     */
    private $cache;

    /**
     * @var MarkdownInterface
     */
    private $markdown;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * MarkdownHelper constructor.
     * @param AdapterInterface $cache
     * @param MarkdownInterface $markdown
     * @param LoggerInterface $logger
     */
    public function __construct(AdapterInterface $cache, MarkdownInterface $markdown, LoggerInterface $logger)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
        $this->logger = $logger;
    }

    /**
     * @param string $source
     * @return string
     */
    public function parse(string $source): string
    {
        if (strpos($source, "bacon") !== false) {
            $this->logger->info("Talking about bacon!!!");
        }

        $item = $this->cache->getItem('markdown_'.md5($source));
        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }
        return $item->get();
    }
}