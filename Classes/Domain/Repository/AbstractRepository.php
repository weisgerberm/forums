<?php
namespace Weisgerber\Forums\Domain\Repository;


use Weisgerber\Forums\Service\Configuration\ConfigurationService;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Qom\AndInterface;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Abstract repo
 */
abstract class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

	/**
	 * Liefert das TS der Extension
	 * @return array
	 */
	public function getSettings() {
	    return $this->getConfigurationService()->getSettings();
	}

	/**
	 * Liefert die ExtensionConfig
	 * @return array
	 */
	public function getExtensionConfig() {
		return $this->getConfigurationService()->getExtensionConfiguration();
	}

	/**
	 * @return ConfigurationManagerInterface
	 */
	public function getConfigurationManager() {
		return $this->objectManager->get(ConfigurationManagerInterface::class);
	}

    /**
     * @return ConfigurationService
     */
	protected function getConfigurationService() {
	    return $this->objectManager->get(ConfigurationService::class);
    }

	/**
	 * Baut weitere Bedingungen ein, welche an jedes Repository angehangen werden können
	 *
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 * @param array $additionalConstraints
	 *
	 * @return array
	 */
	protected function buildConstraints($query, $additionalConstraints){
		$constraints = [];
		/** @var \Weisgerber\Forums\Domain\Model\Constraint $additionalConstraint */
		foreach ($additionalConstraints as $additionalConstraint){
			$operator = '';
			switch ($additionalConstraint->getType()){
				case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_EQUAL_TO:
					$operator = 'equals';
					break;
				case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_GREATER_THAN:
					$operator = 'greaterThan';
					break;
				case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_LESS_THAN:
					$operator = 'lessThan';
					break;
				case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_CONTAINS:
					$operator = 'contains';
					break;
				case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_IN:
					$operator = 'in';
					break;
				default:
					break;
			}
			$constraints[] = $query->{$operator}($additionalConstraint->getProperty(),$additionalConstraint->getValue());
		}
		return $constraints;
	}

    /**
     * Generische Funktion, welche anhand des additionalConstraints-Storages Datensätze findet. So muss nicht für jede
     * Konstilation eine extra Funktion gebaut werden wie z.B. findNewestInPid & findOldestInPid & findOldestInPidWithTitle !
     *
     * @param array $constraints Bedingungen
     * @param array $ordering    Sortierung
     * @param bool $ignoreEnableFields
     * @param bool $respectSysLanguage
     * @param bool $respectStoragePage
     * @param bool $includeDeleted
     *
     * @param bool $returnSingle
     *
     * @return array|object|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
	public function findGenericByConstraints($constraints = [], $ordering = null, $ignoreEnableFields = false, $respectSysLanguage = true, $respectStoragePage = true, $includeDeleted = false, $returnSingle = false)
	{
		if(!$ordering){ // Extra als null default gewählt, dass man nicht jedesmal das array durchreichen muss, wenn ein dahinter liegender Parameter geändert werden soll
			$ordering = array('uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
		}

		$query = $this->createQuery();
		$querySettings = $query->getQuerySettings();
        $querySettings->setIgnoreEnableFields($ignoreEnableFields);
        $querySettings->setRespectSysLanguage($respectSysLanguage);
        $querySettings->setRespectStoragePage($respectStoragePage);
        $querySettings->setIncludeDeleted($includeDeleted);

		// die internen Constraints in doctrine Constraints umwandeln
		$constraints = $this->buildConstraints($query, $constraints);


		$query->matching(
			$query->logicalAnd($constraints)
		);
		$query->setOrderings($ordering);

		// Output-Möglichkeit, um den raw query auszugeben
		if(1==0) {
            $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL(), 'SQL');
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters(), 'SQL-Params');
        }
		if($returnSingle){
		    return $query->execute()->getFirst();
        }
		return $query->execute();
	}

    /**
     * @param \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $entity
     */
    public function save($entity) {
        if ($entity->getUid()) {
            $this->update($entity);
        }
        else {
            $this->add(($entity));
        }

        $this->persistenceManager->persistAll();
    }

    /**
     * @param int[] $uids
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findByUids($uids) {
        $query = $this->createQuery();

        $query->matching(
            $query->in('uid', $uids)
        );

        return $query->execute();
    }

    /**
     * @param QueryInterface $query
     * @param string $propertyName
     * @param int|string|null $minTimestamp
     * @param int|string|null $maxTimestamp
     * @return AndInterface|null
     */
    protected function createTimeFrameConstraint($query, $propertyName, $minTimestamp = null, $maxTimestamp = null)
    {
        $constraints = [];
        if ($minTimestamp) {
            $constraints[] = $query->greaterThanOrEqual($propertyName, $minTimestamp);
        }
        if ($maxTimestamp) {
            $constraints[] = $query->lessThanOrEqual($propertyName, $maxTimestamp);
        }
        if (!$constraints) {
            return null;
        }
        return $query->logicalAnd($constraints);
    }
}
