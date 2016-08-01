<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Petition;

class PetitionControllerTest extends TestCase
{

    //TODO: make use of factory for Petition
    
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


    /**
     * Verify the edit/update flow works
     */ 
    public function testPetitionUpdate()
    {
        $user = factory(App\User::class)->create();

        $petition = $this->createAPetition($user->id);

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

        $petition = $this->createAPetition($user->id);

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

        $petition = $this->createAPetition($user->id);

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

        $petition = $this->createAPetition($user->id);

        $this->actingAs($user)
             ->visit('/')
             ->dontSee('asdf');

        $this->publishPetition($user, $petition->id);

        $this->actingAs($user)
             ->visit('/')
             ->see('asdf');
    }

    /**
     * Verify that the publish action works.
     */
    public function testPublishAction()
    {
        $user = factory(App\User::class)->create();

        $petition = $this->createAPetition($user->id);

        $this->seeInDatabase('petitions', [
            'title'   => 'asdf',
            'published' => false
        ]);

        $this->publishPetition($user, $petition->id);

        $this->seeInDatabase('petitions', [
            'title'   => 'asdf',
            'published' => true
        ]);

        $this->publishPetition($user, $petition->id);

       $this->seeInDatabase('petitions', [
            'title'   => 'asdf',
            'published' => false
        ]);
    }

    public function testSigningPetition()
    {
        $user = factory(App\User::class)->create();

        $petition = $this->createAPetition($user->id);
        $this->publishPetition($user, $petition->id);
        $this->signPetition($petition->id);
        $this->verifyPetitionSigned($user, $petition->id);
    }

    //TODO test image upload

    //TODO test image delete

    //TODO test video upload/delete

    //TODO test form validation

    private function createAPetition($user_id)
    {
        $petition = new Petition;
        $petition->title = "asdf";
        $petition->summary = "sdfa";
        $petition->body = "aaff";
        $petition->user_id = $user_id;
        $petition->save();

        return $petition;
    }

    private function publishPetition($user, $petition_id)
    {
        $this->actingAs($user)
            ->visit('/petition')
            ->see('My Petitions')
            ->see('publish' . $petition_id)
            ->press('publish' . $petition_id)
            ->seePageIs('/home');
    }

    private function signPetition($petition_id)
    {
        $this->visit('/')     //not acting as signed-in user
             ->see('asdf')
             ->click('asdf')
             ->see('sdfa')
             ->see('sign'. $petition_id)
             ->press('sign'. $petition_id)
             ->seePageIs('/petition/' . $petition_id . '/sign')
             ->type('Some Person', 'name')
             ->type('chefboyarsky@gmail.com', 'email')
             ->type('1112223333', 'phone')
             ->press('Sign')
             ->seePageIs('/petition/' . $petition_id . '/sign')
             ->see('Signature Added');
    }

    private function verifyPetitionSigned($user, $petition_id)
    {
        $this->actingAs($user)
            ->visit('/petition')
            ->see('My Petitions')
            ->see('view_signatures' . $petition_id)
            ->press('view_signatures' . $petition_id)
            ->seePageIs('/petition/' . $petition_id . '/signatures')
            ->see('Some Person')
            ->see('chefboyarsky@gmail.com')
            ->see('1112223333');
    }
}
