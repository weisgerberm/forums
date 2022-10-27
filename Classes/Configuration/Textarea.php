<?php
namespace Weisgerber\Forums\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\ViewHelpers\Form\TypoScriptConstantsViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;

class TextArea
{

    /**
     * Tag builder instance
     *
     * @var \TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder|null
     */
    protected TagBuilder|null $tagBuilder = NULL;

    /**
     * constructor of this class
     */
    public function __construct()
    {
        $this->tagBuilder = GeneralUtility::makeInstance(\TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder::class);
    }

    /**
     * render textarea for extConf
     *
     * @param array $parameter
     * @param TypoScriptConstantsViewHelper $parentObject
     * @return string
     */
    public function render(array $parameter, TypoScriptConstantsViewHelper $parentObject): string
    {
        $this->tagBuilder->setTagName('textarea');
        $this->tagBuilder->forceClosingTag(TRUE);
        $this->tagBuilder->addAttribute('cols', 45);
        $this->tagBuilder->addAttribute('rows', 7);
        $this->tagBuilder->addAttribute('name', $parameter['fieldName']);
        $this->tagBuilder->addAttribute('id', 'em-' . $parameter['fieldName']);
        if ($parameter['fieldValue'] !== NULL) {
            $this->tagBuilder->setContent(trim($parameter['fieldValue']));
        }
        return $this->tagBuilder->render();
    }
}
