<?php
declare(strict_types=1);

namespace Werkspot\Bundle\SitemapBundle\Sitemap;

class Alternate
{
    /**
     * @var string
     */
    private $href;

    /**
     * @var string
     */
    private $hreflang;

    /**
     * @param string $href
     * @param string $hreflang
     */
    public function __construct(string $href, string $hreflang)
    {
        $this->href = $href;
        $this->hreflang = $hreflang;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @return string
     */
    public function getHreflang(): string
    {
        return $this->hreflang;
    }
}
