<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Petition;

class PetitionControllerTest extends TestCase
{

    /**
     * Verify the create/save flow works
     */
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
             ->seePageIs('/home')
             ->see($givenTitle);

        $this->seeInDatabase('petitions', [
            'title'   => $givenTitle,
            'summary' => $givenSummary,
            'body'    => $givenBody
        ]);
    }

    /**
     * Verify the edit/update flow works
     */ 
    public function testPetitionUpdate()
    {
        $user = factory(App\User::class)->create();

        $petition = new Petition;
        $petition->title = "asdf";
        $petition->summary = "sdfa";
        $petition->body = "aaff";
        $petition->user_id = $user->id;
        $petition->save();

        $this->actingAs($user)
             ->visit('/petition/1/edit') //verify correct values for fields on edit page
             ->see('asdf')
             ->see('sdfa')
             ->see('aaff')
             ->type('zzzz', 'title')     //verify fields can be edited
             ->type('yyyy', 'summary')
             ->press('Save')             //verify form saves and redirects
             ->seePageIs('/home')
             ->see('zzzz')               //verify the updated title is visible on the list page
             ->visit('/petition/1/edit') //verify all the updated data is still visible when another edit is made
             ->see('zzzz')
             ->see('yyyy')
             ->see('aaff');
    }


     /**
     * Verify that the title, button, and data for a petition are present
     */
    public function testPetitionIndexAction()
    {
        $user = factory(App\User::class)->create();

        $petition = new Petition;
        $petition->title = "asdf";
        $petition->summary = "sdfa";
        $petition->body = "aaff";
        $petition->user_id = $user->id;
        $petition->save();

        $this->actingAs($user)
             ->visit('/petition')
             ->see('Dashboard')
             ->see('Add New')
             ->see('asdf');
    }   
}
