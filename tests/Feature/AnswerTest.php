<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Answer;

class AnswerTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function getAnswers()
    {
        $response = $this->get('/api/answers');

        $response->assertStatus(200)
                 ->assertJsonStructure([[
                     'id',
                     'text',
                     'created_at',
                     'updated_at'
                 ]]);
    }

    /** @test */
    public function showAnswer()
    {
        $response = $this->get('/api/answers/1');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id',
                     'text',
                     'created_at',
                     'updated_at'
                 ]);
    }

    /** @test */
    public function createAnswer()
    {
        $answer = factory(\App\Models\Answer::class)->make();

        $response = $this->post('/api/answers', [
            'text' => $answer->text
        ]);
        
        $response->assertStatus(200)
                 ->assertJson([
                    'text' => $answer->text
                 ]);
    }

    /** @test */
    public function updateAnswer()
    {
        $answer = factory(Answer::class)->make();
        $response = $this->put('/api/answers/1', [
            'text' => $answer->text
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                    'text' => $answer->text
                 ]);
    }

    /** @test */
    public function deleteAnswer()
    {
        $id = 1;
        $this->delete('/api/answers/' . $id);
        $answer = Answer::find($id);
        $this->assertNull($answer);
    }
}
