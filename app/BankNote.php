<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Queryhelper;
use DB;

class BankNote extends Model {

    protected $table = 'bank_note';


    public function refill() {
        DB::table($this->table)->update(['amount' => 1000]);
    }
}
