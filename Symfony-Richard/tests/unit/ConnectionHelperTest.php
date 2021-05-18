<?php

namespace App\Tests\Unit;

use App\Entity\ConnectionHelper;
use PHPUnit\Framework\TestCase;

class ConnectionHelperTest extends TestCase{
   
    public function testClientCreation(){
        $client = null;
        $helper = new ConnectionHelper();
        $client = $helper->getClient();
        $this->assertNotNull($client);
    }

}