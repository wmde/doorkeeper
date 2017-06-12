<?php
namespace RemotelyLiving\Doorkeeper\Tests\Rules;

use PHPUnit\Framework\TestCase;
use RemotelyLiving\Doorkeeper\Requestor;
use RemotelyLiving\Doorkeeper\Rules\UserId;

class UserIdTest extends TestCase
{
    /**
     * @test
     */
    public function canBeSatisfied()
    {
        $rule      = new UserId(123);
        $requestor = new Requestor();

        $this->assertFalse($rule->canBeSatisfied());
        $this->assertFalse($rule->canBeSatisfied($requestor));

        $this->assertTrue($rule->canBeSatisfied($requestor->withUserId(123)));
    }

    /**
     * @test
     */
    public function getValue()
    {
        $this->assertEquals(234, (new UserId(234))->getValue());
    }
}
