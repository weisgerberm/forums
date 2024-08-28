<?php

namespace Weisgerber\Forums\Domain\Model\Traits;

/**
 * The number of threads per page for the forum
 * */
trait FieldThreadsPerPage
{
	protected int $threadsPerPage = 0;

	public function getThreadsPerPage (): int
	{
		return $this->threadsPerPage;
	}

	public function setThreadsPerPage (int $threadsPerPage): void
	{
		$this->threadsPerPage = max(5, min(30, $threadsPerPage));
	}

}
