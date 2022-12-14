<?php


namespace Weisgerber\Forums\Domain\Model;

/**
 * Class Constraint
 *
 * Helper-Class für leichtere Constraint-Definition in Repositories, sodass die Infos nicht als Array übergeben werden
 *
 */
class Constraint
{
	/**
	 * @var int
	 */
	protected int $type;

	/**
	 * @var string
	 */
	protected string $property;

	/**
	 * @var mixed
	 */
	protected $value;

	public function __construct($type, $property, $value){
		$this->type = $type;
		$this->property = $property;
		$this->value = $value;
	}

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return $this->type;
	}

	/**
	 * @param int $type
	 */
	public function setType(int $type): void
	{
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getProperty(): string
	{
		return $this->property;
	}

	/**
	 * @param string $property
	 */
	public function setProperty(string $property): void
	{
		$this->property = $property;
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param mixed $value
	 */
	public function setValue($value): void
	{
		$this->value = $value;
	}
}
