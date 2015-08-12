<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Network\Http\Client;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class SlackComponent extends Component
{
    protected $_defaultConfig = [
        'webhook_url' => null,
		'enabled' => false,
		'debounce' => '1 min',
    ];
	
	private $_debounce = [
		'character' => [],
	];

	private $Slack;
	
	public function startup($event)
	{
		$this->Slack = TableRegistry::get('Slack');
	}
	
    public function post($body, $type, $id)
    {
		if(!$this->config('enabled'))
			return false;
		
		// Find out when the last time an announce was sent for this entity
		$result = $this->Slack->findAllByEntityAndEntityId($type, $id)->first();
		if($result)
		{
			$last_update = $result->modified;
		}
		else
		{
			$result = $this->Slack->newEntity();
			$result->entity = $type;
			$result->entity_id = $id;
			$last_update = new Time('1 year ago');
		}
	
		// Prevent sending out an update too soon
		if($last_update->wasWithinLast($this->config('debounce'))) {
			return false;
		}
		
		$http = new Client();
		$data = (object) ['text' => $body];
		$response = $http->post($this->config('webhook_url'), ['payload' => json_encode($data, JSON_PRETTY_PRINT)]);
		
		$result->messages++;
		$this->Slack->save($result);
    }
	
	public function announceCharacterView($character)
	{
		$message = sprintf("Someone just looked at <%s|%s>", Router::url(['controller' => 'Characters', 'action' => 'view', $character->id], true), $character->name);
		$this->post($message, 'character', $character->id);
	}

	public function announceCharacterCreation($character)
	{
		$message = sprintf("Someone just created a new character, <%s|%s>!", Router::url(['controller' => 'Characters', 'action' => 'view', $character->id], true), $character->name);
		$this->post($message, 'character', $character->id);
	}

		public function announceCharacterEdit($character)
	{
		$message = sprintf("Someone just updated the profile for <%s|%s>!", Router::url(['controller' => 'Characters', 'action' => 'view', $character->id], true), $character->name);
		$this->post($message, 'character', $character->id);
	}

}
