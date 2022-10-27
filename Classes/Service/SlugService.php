<?php

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\DataHandling\Model\RecordStateFactory;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Weisgerber\Forums\Domain\Model\Post;
use Weisgerber\Forums\Domain\Model\Thread;

class SlugService
{
    /**
     * Calculates the slug for a entity
     *
     * @param array  $entity Warning: Dont use the mapped model!
     * @param string $table for security only the last part!
     * @param string $slugFieldName
     *
     * @return string
     * @throws \TYPO3\CMS\Core\Exception\SiteNotFoundException
     */
    public function getSlug(array $entity, string $table, $slugFieldName = 'slug'):String
    {
        $tableName = 'tx_forums_domain_model_'.$table;
        $slugFieldName = $slugFieldName;

        //      Get field configuration
        $fieldConfig = $GLOBALS['TCA'][$tableName]['columns'][$slugFieldName]['config'];
        $evalInfo = GeneralUtility::trimExplode(',', $fieldConfig['eval'], true);

        //      Initialize Slug helper
        /** @var SlugHelper $slugHelper */
        $slugHelper = GeneralUtility::makeInstance(
            SlugHelper::class,
            $tableName,
            $slugFieldName,
            $fieldConfig
        );

        //      Generate slug

        $slug = $slugHelper->generate((array) $entity, $entity['pid']);
        $state = RecordStateFactory::forName($tableName)
            ->fromArray($entity, $entity['pid'], $entity['uid']);

        //      Build slug depending on eval configuration
        if (in_array('uniqueInSite', $evalInfo)) {
            $slug = $slugHelper->buildSlugForUniqueInSite($slug, $state);
        } else if (in_array('uniqueInPid', $evalInfo)) {
            $slug = $slugHelper->buildSlugForUniqueInPid($slug, $state);
        } else if (in_array('unique', $evalInfo)) {
            $slug = $slugHelper->buildSlugForUniqueInTable($slug, $state);
        }
        return $slug;
    }
}
