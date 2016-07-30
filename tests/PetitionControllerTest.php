<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PetitionControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testPetitionCreation()
    {
        $user = factory(App\User::class)->create();

        $givenTitle   = 'A cool petition title';
        $givenSummary = 'A cool summary';
        $givenBody    = 'A cool body';

        $this->actingAs($user)
             ->visit('/petition/create')
             ->type($givenTitle, 'title')
             ->type($givenSummary, 'summary')
             ->type($givenBody, 'body')
             ->press('Save')
             ->seePageIs('/home');

        $this->seeInDatabase('petitions', [
            'title'   => $givenTitle,
            'summary' => $givenSummary,
            'body'    => $givenBody
        ]);
    }


    public function testPetitionIndex()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/petition')
             ->see('Dashboard')
             ->see('Add New');

        //Could add a few petitions and verify list looks correct
    }
}
