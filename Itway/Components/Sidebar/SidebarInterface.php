<?php 

namespace Itway\Components\Sidebar;

interface SidebarInterface{

	public function getLastPosts();

	public function getLastIdeas();

	public function getLastJobs();

	public function getLastTeams();

	public function getLastEvents();

	public function formLastModelsCollection();
}
