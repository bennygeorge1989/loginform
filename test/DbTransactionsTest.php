<?php

require_once('./model/DbTransactions.php');
use PHPUnit\Framework\TestCase;

class DbTransactionsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->transact = new DbTransactions();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     * $covers model/DbTransactions::loginUser 
     */
    public function testLoginUser()
    {
        $emailId = 'test@gmail.com';
        $password = 'test';
        $result = $this->transact->loginUser($emailId, $password);
        $this->assertTrue($result);
    }

    /**
     * @test
     * $covers model/DbTransactions::loginUser 
     */
    public function testLoginUserFail()
    {
        $emailId = 'test@gmail.coms';
        $password = 'testes';
        $result = $this->transact->loginUser($emailId, $password);
        $this->assertFalse($result);
    }
}