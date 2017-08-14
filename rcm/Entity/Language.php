<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class Language extends \Rcm\Entity\Language
{
    /**
     * @param \Zrcms\ContentLanguage\Model\Language $language
     * @param string                                $createdByUserId
     * @param string                                $createdReason
     */
    public function __construct(
        \Zrcms\ContentLanguage\Model\Language $language,
        string $createdByUserId,
        string $createdReason
    ) {

        $this->setIso6391(
            $language->getIso6391()
        );

        $this->setIso6392b(
            $language->getIso6392b()
        );

        $this->setIso6392t(
            $language->getIso6392t()
        );

        $this->setLanguageId(
            $language->getIso6392t()
        );

        $this->setLanguageName(
            $language->getName()
        );

        parent::__construct($createdByUserId, $createdReason);
    }
}
