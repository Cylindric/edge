<?php
class WebTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://develop.edge.local');
    }
    
    public function testLogin()
    {
        $this->url('/users/login');
        $this->assertEquals('Edge: Users', $this->title());

        $this->byId('username')->value('admin');
        $this->byId('password')->value('admin');
        
        $this->clickOnElement('login');
        
        $this->assertNotEquals('Edge: Users', $this->title());
    }
    
    public function testBasicCharacterCreation()
    {
        $name = 'Selenium Test User ' . date('c');
        $this->testLogin();
        $this->url('characters/create');
        $this->byId('name')->value($name);
        $this->clickOnElement('submit');
        
        $this->assertContains('/characters/edit/', $this->url());
        $this->assertEquals('Selenium Test User', $this->byId('character_name')->text());
    }
    
    public function testCharacterListControlls()
    {
        $this->testLogin();
        $this->url('characters');
        
    }
}