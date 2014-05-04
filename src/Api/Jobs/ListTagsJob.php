<?php
class ListTagsJob extends AbstractPageJob
{
	public function execute()
	{
		$pageSize = $this->getPageSize();
		$page = $this->getArgument(self::PAGE_NUMBER);
		$query = $this->getArgument(self::QUERY);

		$tags = TagSearchService::getEntitiesRows($query, $pageSize, $page);
		$tagCount = TagSearchService::getEntityCount($query);

		return $this->getPager($tags, $tagCount, $page, $pageSize);
	}

	public function getDefaultPageSize()
	{
		return intval(getConfig()->browsing->tagsPerPage);
	}

	public function requiresPrivilege()
	{
		return Privilege::ListTags;
	}

	public function requiresAuthentication()
	{
		return false;
	}

	public function requiresConfirmedEmail()
	{
		return false;
	}
}
