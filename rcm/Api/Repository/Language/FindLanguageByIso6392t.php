<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Language;

use Rcm\Entity\Language;
use Zrcms\Content\Model\Trackable;
use Zrcms\ContentCore\Basic\Api\Component\FindBasicComponent;
use Zrcms\ContentLanguage\Model\LanguagesComponent;

/**
 * @deprecated BC ONLY
 */
class FindLanguageByIso6392t extends \Rcm\Api\Repository\Language\FindLanguageByIso6392t
{
    /**
     * @var FindBasicComponent
     */
    protected $findBasicComponent;

    /**
     * @param FindBasicComponent $findBasicComponent
     */
    public function __construct(
        FindBasicComponent $findBasicComponent
    ) {
        $this->findBasicComponent = $findBasicComponent;
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
        $component = $this->findBasicComponent->__invoke(
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
