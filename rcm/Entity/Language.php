<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

use Zrcms\ContentLanguage\Model\LanguageCmsResource;
use Zrcms\ContentLanguage\Model\LanguageVersion;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class Language extends \Rcm\Entity\Language
{
    /**
     * @param LanguageCmsResource $languageCmsResource
     * @param LanguageVersion     $languageVersion
     */
    public function __construct(
        LanguageCmsResource $languageCmsResource,
        LanguageVersion $languageVersion
    ) {
        $createdByUserId = $languageVersion->getCreatedByUserId();
        $createdReason = $languageVersion->getCreatedReason();

        $this->setIso6391(
            $languageVersion->getIso6391()
        );

        $this->setIso6392b(
            $languageVersion->getIso6392b()
        );

        $this->setIso6392t(
            $languageVersion->getIso6392t()
        );

        $this->setLanguageId(
            $languageCmsResource->getId()
        );

        $this->setLanguageName(
            $languageVersion->getName()
        );

        parent::__construct($createdByUserId, $createdReason);
    }
}
