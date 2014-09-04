<?php
namespace Aura\Html\_Config;

use Aura\Di\ContainerAssertionsTrait;

class CommonTest extends \PHPUnit_Framework_TestCase
{
    use ContainerAssertionsTrait;

    public function setUp()
    {
        $this->setUpContainer(array(
            'Aura\Html\_Config\Common',
        ));
    }

    public function test()
    {
        $this->assertGet('html_escaper', 'Aura\Html\Escaper');
        $this->assertGet('html_helper', 'Aura\Html\HelperLocator');
        $this->assertNewInstance('Aura\Html\HelperLocator');
        $this->assertNewInstance('Aura\Html\Helper\Input');
    }
}
