<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Language;

use Rcm\Entity\Language;
use Zrcms\Content\Api\Component\FindComponent;
use Zrcms\Content\Model\Trackable;
use Zrcms\ContentLanguage\Model\LanguagesComponent;

/**
 * @deprecated BC ONLY
 */
class FindLanguageByIso6392t extends \Rcm\Api\Repository\Language\FindLanguageByIso6392t
{
    /**
     * @var FindComponent
     */
    protected $findComponent;

    /**
     * @param FindComponent $findComponent
     */
    public function __construct(
        FindComponent $findComponent
    ) {
        $this->findComponent = $findComponent;
    }

    /**
     * @param string $iso639_2t
     * @param array  $options
     *
     * @return null|Language
     */
    public function __invoke(
        string $iso639_2t,
        array $options = []
    ) {
        /** @var LanguagesComponent $component */
        $component = $this->findComponent->__invoke(
            'basic',
            'zrcms-languages'
        );

        $zrcmsLanguage = $component->getLanguage(
            $iso639_2t
        );

        if (empty($zrcmsLanguage)) {
            return null;
        }

        return new \ZrcmsRcmCompatibility\Rcm\Entity\Language(
            $zrcmsLanguage,
            Trackable::UNKNOWN_USER_ID,
            Trackable::UNKNOWN_REASON
        );
    }
}
