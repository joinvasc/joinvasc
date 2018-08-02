<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewTest extends TestCase
{
    /**
     * Testing all our views
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/callReport')->assertStatus(200);
        $this->get('/followups')->assertViewAs(1);
        $this->get('/qrcode')->assertStatus(200);
        
        $this->assertTrue(true);
    }
}
