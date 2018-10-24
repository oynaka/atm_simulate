<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use View;
use Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BankNote;


class BankNoteController extends Controller {

    private $data = array();

    public function dispense(Request $request) {


        $errorMessages = "";
        $returnCash = "";
        $dispense_amt = "";
        $params = $request->all();

        $allCash = BankNote::select('bank_note_type','amount')->orderBy('bank_note_type','desc')->get();

        if(isset($params['mode'])) {

            $validatedData = $request->validate([
                'dispense_amt' => 'required|numeric|min:20',
            ], $this->errorMessages(2) );

            $dispense_amt = $params['dispense_amt'];
            $result = $this->calculate($dispense_amt,$allCash);

            //echo '<pre>';print_r($result);echo '</pre>';

            if(isset($result['errorMessages'])) {
                $errorMessages = $result['errorMessages'];
            }

            if(isset($result['return_cash'])) {
                $returnCash = $result['return_cash'];

                //Check and remove cash from ATM
                foreach($returnCash as $bank => $reqAmt) {
                    $obj = BankNote::where('bank_note_type',$bank)->first();
                    $obj->amount = $obj->amount - $reqAmt;
                    $obj->save();
                }
            }

            if(isset($result['remain_cash'])) {
                $allCash = collect($result['remain_cash']);
            }

        }


        $this->data = null;
        $this->data['bankAmount'] = $allCash;
        $this->data['returnCash'] = $returnCash;
        $this->data['dispense_amt'] = $dispense_amt;
        $this->data['errorMessages'] = $errorMessages;
        return view('dispense', $this->data);
    }

    public function calculate($input,$allCash) {

        if(empty($allCash)) {
            $result['errorMessages'] = $this->errorMessages(1);
            return $result;
        }

        $bankNotes = null;
        $bankAmount = null;
        foreach($allCash as $item) {
            if($item->amount > 0) {
                $bankNotes[$item->bank_note_type] = $item->bank_note_type;
                $bankAmount[$item->bank_note_type] = $item->amount;
            }
        }

        if(empty($bankNotes)) {
            $result['errorMessages'] = $this->errorMessages(1);
            return $result;
        }

        $totalNotesValue = 0;
        $output = null;

        foreach($bankNotes as $key => $value) {

            $remainder = $input - $totalNotesValue;
            $remainder = round($remainder,2);
            //echo $remainder.' ';

            if($key == 50) {
                if(isset($bankNotes[20])) {
                    if($remainder % 50 != 0) {
                        if($remainder % 20 == 0) {
                            continue;
                        }
                    }
                }
            }

            $numNotes = intval($remainder / $value);
            if($numNotes != 0) {
                $output[$key] = $numNotes;
            }
            $totalNotesValue += $numNotes * $value;
        }

        //re-check input
        $total = 0;
        if(!empty($output)) {
            foreach($output as $bank => $amt) {
                $total += $bank*$amt;
            }
        }

        if($total != $input) {
            $result['errorMessages'] = $this->errorMessages(1);
            return $result;
        }

        //check if available bank note in DB
        $isAvailableNote = 1;
        foreach($output as $bank => $reqAmt) {
            $availAmt = $bankAmount[$bank];
            if($reqAmt > $availAmt) {
                $isAvailableNote = 0;
                break;
            }
        }

        if($isAvailableNote == 0) {
            $result['errorMessages'] = $this->errorMessages(1);
            return $result;
        }

        //calculate remain cash
        $remain_cash = null;
        foreach($allCash as $item) {
            $newObj = $item;
            if(isset($output[$item->bank_note_type])) {
                $newObj->amount = $newObj->amount-$output[$item->bank_note_type];
            }
            $remain_cash[] = $newObj;
        }

        //echo '<pre>';print_r($remain_cash);echo '</pre>';

        $result['return_cash'] = $output;
        $result['remain_cash'] = $remain_cash;

        return $result;

    }

    public function refill(Request $request) {
        $obj = new BankNote;
        $obj->refill();
        return redirect()->route('dispense');
    }

    public function errorMessages($mode)
    {
        switch($mode) {
            case 1 : $result = 'Couldn\'t process, we don\'t have enough bank note to provide';
                     break;
            case 2 : $result = ['dispense_amt.required' => 'Please input amount.',
                      'dispense_amt.numeric' => 'Please input amount in number only.',
                      'dispense_amt.min' => 'Please input amount more than or equal 20.',
                     ];
                     break;

        }

        return $result;
    }    


}
