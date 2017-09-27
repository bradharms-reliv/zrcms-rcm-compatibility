<?php

namespace ZrcmsRcmCompatibility\Rcm\Acl;

use Rcm\Acl\ResourceName;

/**
 * @deprecated BC ONLY
 * @todo Page types do not exist anymore and pageNames contain slashes
 *
 * @author James Jervis - https://github.com/jerv13
 */
class ResourceNameZrcms implements ResourceName
{
    /**
     * @param string|null $root
     * @param string|null $siteId
     * @param string|null $pages
     * @param string|null $pageType NOT USED in ZRCMS
     * @param string|null $pageName
     *
     * @return null|string
     */
    public function get(
        $root = null,
        $siteId = null,
        $pages = null,
        $pageType = null,
        $pageName = null
    ) {
        if (empty($root)) {
            $root = self::RESOURCE_SITES;
        }

        if (empty($siteId)) {
            return $root;
        }

        if (empty($pages)) {
            return $root . '.' . $siteId;
        }

        if (empty($pageName)) {
            return $root . '.' . $siteId . '.' . $pages;
        }

        $pageName = $this->preparePageName($pageName);

        return $root . '.' . $siteId . '.' . $pages . $pageName;
    }

    /**
     * @param array $resources
     *
     * @return null|string
     */
    public function getFromArray(
        array $resources
    ) {
        $root = (empty($resources[0])) ? null : $resources[0];
        $siteId = (empty($resources[1])) ? null : $resources[1];
        $pages = (empty($resources[2])) ? null : $resources[2];
        $pageName = $this->parsePageName($resources);

        return $this->get(
            $root,
            $siteId,
            $pages,
            null,
            $pageName
        );
    }

    /**
     * @param string $resourceId
     *
     * @return bool
     */
    public function isSitesResourceId($resourceId)
    {
        $needle = ResourceProvider::RESOURCE_SITES . '.';
        $length = strlen($needle);

        return (substr($resourceId, 0, $length) === $needle);
    }

    /**
     * @param string $resourceId
     *
     * @return bool
     */
    public function isPagesResourceId($resourceId)
    {
        $resources = explode('.', $resourceId);

        return ($this->isSitesResourceId($resourceId) && !empty($resources[2]) && $resources[2] === self::RESOURCE_PAGES);
    }

    /**
     * @param string $resourceId
     *
     * @return bool
     */
    public function isPageResourceId($resourceId)
    {
        $resources = explode('.', $resourceId);

        return (!empty($resources[3]));
    }

    /**
     * @param $resources
     *
     * @return string
     */
    protected function parsePageName($resources)
    {
        $pageName = '';
        $index = 3;
        $last = count($resources) - 1;

        while ($index <= $last) {
            $pageName = '/' . $resources[$index];
        }

        return $pageName;
    }

    /**
     * Turns page path into resource path
     * /page/example => .page.example
     * @param $pageName
     *
     * @return string
     */
    protected function preparePageName($pageName) {
        return str_replace('/', '.', $pageName);
    }
}
