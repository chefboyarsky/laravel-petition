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
        $thanksMsg    = 'Thanks!';
        $thanksEmail  = '<b>Thanks!</b>';
        $thanksSms    = 'U Rok!';

        $this->actingAs($user)
             ->visit('/petition/create')
             ->type($givenTitle, 'title')
             ->type($givenSummary, 'summary')
             ->type($givenBody, 'body')
             ->type($thanksMsg, 'thanks_message')
             ->type($thanksEmail, 'thanks_email')
             ->type($thanksSms, 'thanks_sms')
             ->press('Save')
             ->seePageIs('/home')
             ->see($givenTitle);

        $this->seeInDatabase('petitions', [
            'title'   => $givenTitle,
            'summary' => $givenSummary,
            'body'    => $givenBody,
            'thanks_message' => $thanksMsg,
            'thanks_email'   => $thanksEmail,
            'thanks_sms'     => $thanksSms,
            'published' => false
        ]);
    }


    /*
    public function testValidation()
    {

    }
    */

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
     *
     */
    public function testsPetitionDeleteAction()
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
             ->see('asdf')
             ->press('delete' . $petition->id)
             ->seePageIs('/home')
             ->dontSee('asdf');

        $this->dontSeeInDatabase('petitions', [
            'title'   => 'asdf'
        ]);
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
             ->see('My Petitions')
             ->see('addbutton')
             ->see('asdf');
    }


    /**
     * Verify that a list of published petitions is shown on the list page.
     */
    public function testPetitionListAction()
    {
        $user = factory(App\User::class)->create();

        $petition = new Petition;
        $petition->title = "asdf";
        $petition->summary = "sdfa";
        $petition->body = "aaff";
        $petition->user_id = $user->id;
        $petition->save();

        $this->actingAs($user)
             ->visit('/')
             ->dontSee('asdf')
             ->visit('/petition')
             ->press('publish' . $petition->id)
             ->visit('/')
             ->see('asdf');
    }

    /**
     * Verify that the publish action works.
     */
    public function testPublishAction()
    {
        $user = factory(App\User::class)->create();

        $petition = new Petition;
        $petition->title = "asdf";
        $petition->summary = "sdfa";
        $petition->body = "aaff";
        $petition->user_id = $user->id;
        $petition->save();

        $this->seeInDatabase('petitions', [
            'title'   => 'asdf',
            'published' => false
        ]); 

        $this->actingAs($user)
             ->visit('/petition')
             ->see('My Petitions')
             ->see('publish' . $petition->id)
             ->press('publish' . $petition->id)
             ->seePageIs('/home');

        $this->seeInDatabase('petitions', [
            'title'   => 'asdf',
            'published' => true
        ]);

       $this->actingAs($user)
             ->visit('/petition')
             ->see('My Petitions')
             ->see('publish' . $petition->id)
             ->press('publish' . $petition->id)
             ->seePageIs('/home');

       $this->seeInDatabase('petitions', [
            'title'   => 'asdf',
            'published' => false
        ]);
    }   
}