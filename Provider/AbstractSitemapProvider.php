<?php
namespace Werkspot\Bundle\SitemapBundle\Provider;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Werkspot\Bundle\SitemapBundle\Sitemap\SitemapSection;
use Werkspot\Bundle\SitemapBundle\Sitemap\SitemapSectionPage;

abstract class AbstractSitemapProvider implements ProviderInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    protected $urlGenerator;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @return int
     */
    final public function getNumberOfPages()
    {
        return ceil($this->getCount() / $this->getMaxItemsPerPage());
    }

    /**
     * @return SitemapSection
     */
    public function getSection()
    {
        return new SitemapSection($this->getSectionName());
    }

    /**
     * @param string $routeName
     * @param array $options
     * @return string
     */
    final protected function generateUrl($routeName, $options = [])
    {
        return $this->urlGenerator->generate($routeName, $options, UrlGeneratorInterface::ABSOLUTE_URL);
    }

    /**
     * Just to get consistent paging even with smaller limits
     *
     * @param array $data
     * @param int $page
     * @return array
     */
    protected function getSimpleArrayPage(array $data, $page)
    {
        $limit = $this->getMaxItemsPerPage();
        $offset = ($page - 1) * $limit;

        return array_slice($data, $offset, $limit);
    }

    /**
     * @return int
     */
    protected function getMaxItemsPerPage()
    {
        return SitemapSectionPage::MAX_ITEMS_PER_PAGE;
    }
}
