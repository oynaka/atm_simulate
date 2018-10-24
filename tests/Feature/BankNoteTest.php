<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\BankNoteController as BankNote;

class BankNoteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCase1()
    {
        $calMock = new BankNote;
        $userInput = 5550;

        $cashArray = [ (object)['bank_note_type' => 1000 , 'amount' => 100] ,
                       (object)['bank_note_type' => 500 , 'amount' => 100] ,
                       (object)['bank_note_type' => 100 , 'amount' => 100] ,
                       (object)['bank_note_type' => 50 , 'amount' => 100] ,
                       (object)['bank_note_type' => 20 , 'amount' => 100] 
                     ];
        $cashArray = collect($cashArray);

        $result = $calMock->calculate($userInput,$cashArray);

        $expect['return_cash'] = ['1000' => 5 , '500' => 1 , '50' => 1];
        $expect['remain_cash'] = [ (object)['bank_note_type' => 1000 , 'amount' => 95] ,
                                   (object)['bank_note_type' => 500 , 'amount' => 99] ,
                                   (object)['bank_note_type' => 100 , 'amount' => 100] ,
                                   (object)['bank_note_type' => 50 , 'amount' => 99] ,
                                   (object)['bank_note_type' => 20 , 'amount' => 100] 
                                 ];



        $this->assertEquals($expect,$result);
    }

    public function testCase2()
    {
        $calMock = new BankNote;
        $userInput = 280;

        $cashArray = [ (object)['bank_note_type' => 1000 , 'amount' => 100] ,
                       (object)['bank_note_type' => 500 , 'amount' => 100] ,
                       (object)['bank_note_type' => 100 , 'amount' => 100] ,
                       (object)['bank_note_type' => 50 , 'amount' => 100] ,
                       (object)['bank_note_type' => 20 , 'amount' => 100] 
                     ];
        $cashArray = collect($cashArray);

        $result = $calMock->calculate($userInput,$cashArray);

        $expect['return_cash'] = ['100' => 2 , '20' => 4];
        $expect['remain_cash'] = [ (object)['bank_note_type' => 1000 , 'amount' => 100] ,
                                   (object)['bank_note_type' => 500 , 'amount' => 100] ,
                                   (object)['bank_note_type' => 100 , 'amount' => 98] ,
                                   (object)['bank_note_type' => 50 , 'amount' => 100] ,
                                   (object)['bank_note_type' => 20 , 'amount' => 96] 
                                 ];



        $this->assertEquals($expect,$result);
    }


    public function testCase3()
    {
        $calMock = new BankNote;
        $userInput = 1080;

        $cashArray = [ (object)['bank_note_type' => 1000 , 'amount' => 0] ,
                       (object)['bank_note_type' => 500 , 'amount' => 100] ,
                       (object)['bank_note_type' => 100 , 'amount' => 100] ,
                       (object)['bank_note_type' => 50 , 'amount' => 100] ,
                       (object)['bank_note_type' => 20 , 'amount' => 100] 
                     ];
        $cashArray = collect($cashArray);

        $result = $calMock->calculate($userInput,$cashArray);

        $expect['return_cash'] = ['500' => 2 , '20' => 4];
        $expect['remain_cash'] = [ (object)['bank_note_type' => 1000 , 'amount' => 0] ,
                                   (object)['bank_note_type' => 500 , 'amount' => 98] ,
                                   (object)['bank_note_type' => 100 , 'amount' => 100] ,
                                   (object)['bank_note_type' => 50 , 'amount' => 100] ,
                                   (object)['bank_note_type' => 20 , 'amount' => 96] 
                                 ];



        $this->assertEquals($expect,$result);
    }
}
