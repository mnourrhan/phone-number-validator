<?php

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Assert;

class PhoneListTest extends TestCase
{
    /**
     * @test
     */
    public function is_phone_list_data_retrieved_paginated_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        Assert::assertArrayHasKey('phone_list', $response->getOriginalContent()->getData());
        Assert::assertArrayHasKey('phone_number_states', $response->getOriginalContent()->getData());
        Assert::assertArrayHasKey('countries', $response->getOriginalContent()->getData());
        $response->assertSee('Next');
    }
}
