<!DOCTYPE html>
<html lang="en-US">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ATM Simulator</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

        <link href="{{asset('css/atm.css')}}" rel="stylesheet">
        

    </head>

    <body>
        <div class="container pt-3">
              <h6 class="mb-2">Remaining Bank Notes</h6>
              <div class="row">
              <div class="col col-12 clearfix">
                <div class="bank-note-info-box clearfix float-left">
                  <div class="bank-note-box float-left">
                    <i class="fas fa-money-bill text-muted"></i>
                    <small class="text-muted">1,000</small>
                  </div>
                  <div class="bank-note-info float-left pl-2">
                    @if($bankAmount->where('bank_note_type',1000) )
                        {{$bankAmount->where('bank_note_type',1000)->first()->amount}}
                    @else 
                        0
                    @endif
                  </div>
                </div>
                <div class="bank-note-info-box ml-5 clearfix float-left">
                  <div class="bank-note-box float-left">
                    <i class="fas fa-money-bill text-muted"></i>
                    <small class="text-muted">500</small>
                  </div>
                  <div class="bank-note-info  float-left pl-2">
                    @if($bankAmount->where('bank_note_type',500) )
                        {{$bankAmount->where('bank_note_type',500)->first()->amount}}
                    @else 
                        0
                    @endif
                  </div>
                </div>

                <div class="bank-note-info-box ml-5 clearfix float-left">
                  <div class="bank-note-box float-left">
                    <i class="fas fa-money-bill text-muted"></i>
                    <small class="text-muted">100</small>
                  </div>
                  <div class="bank-note-info  float-left pl-2">
                    @if($bankAmount->where('bank_note_type',100) )
                        {{$bankAmount->where('bank_note_type',100)->first()->amount}}
                    @else 
                        0
                    @endif
                  </div>
                </div>

                <div class="bank-note-info-box ml-5 clearfix float-left">
                  <div class="bank-note-box float-left">
                    <i class="fas fa-money-bill text-muted"></i>
                    <small class="text-muted">50</small>
                  </div>
                  <div class="bank-note-info  float-left pl-2">
                    @if($bankAmount->where('bank_note_type',50) )
                        {{$bankAmount->where('bank_note_type',50)->first()->amount}}
                    @else 
                        0
                    @endif
                  </div>
                </div>

                <div class="bank-note-info-box ml-5 clearfix float-left">
                  <div class="bank-note-box float-left">
                    <i class="fas fa-money-bill text-muted"></i>
                    <small class="text-muted">20</small>
                  </div>
                  <div class="bank-note-info  float-left pl-2">
                    @if($bankAmount->where('bank_note_type',20) )
                        {{$bankAmount->where('bank_note_type',20)->first()->amount}}
                    @else 
                        0
                    @endif
                  </div>
                </div>


                <div class="bank-note-info-box ml-5 clearfix float-left">
                  <div class="bank-note-box float-left">
                  <a href="/refill" class="btn btn-info btn-sm">Refill Bank note</a>
                  </div>
                </div>
              </div>
            </div>
          <hr>
          <div class="main-screen">
            <h4 class="mt-4">How much do you want to dispense?</h4>
            <form id="fmDispense" action="" method="POST">
              {{ csrf_field() }}
              <div class="row dispense-form-content">
                <div class="col col-12">
                  <div>Select amount</div>
                  <button type="button" class="btn btn-outline-success" data-dispense="1000">1,000</button>
                  <button type="button" class="btn btn-outline-success" data-dispense="3000">3,000</button>
                  <button type="button" class="btn btn-outline-success" data-dispense="5000">5,000</button>
                  <button type="button" class="btn btn-outline-success" data-dispense="10000">10,000</button>
                </div>
                <div class="col col-md-6 col-lg-4 mt-3">
                  <div>or enter the number</div>
                  <div class="input-group">
                    <input type="text" id="txtCustomAmt" name="dispense_amt" class="form-control" placeholder="Enter the number you want to dispense" aria-label="Enter the number you want to dispense" aria-describedby="btnDispenseCustom">
                    <input type="hidden" name="mode" value="dispense">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" id="btnDispenseCustom" data-dispense="custom">Dispense</button>
                    </div>
                  </div>
                  @if ($errors->any())
                    @foreach ($errors->all() as $error)
                      <small class="text-danger input-error-label">
                        <i class="fas fa-exclamation-triangle"></i> {{ $error }}
                      </small>
                    @endforeach
                  @endif
                </div>
              </div>
            </form>
            <hr />

            <div class="alert alert-danger {{ ($errorMessages == '') ? "d-none" : "" }}">
                {{$errorMessages}}
            </div>

            @if($returnCash != '')
                <div class="row">
                  <div class="col col-12 clearfix">
                    For cash {{number_format($dispense_amt)}} : You got
                  </div>
                  <div class="col col-12 clearfix">
                    <div class="bank-note-info-box clearfix float-left">
                      <div class="bank-note-box float-left">
                        <i class="fas fa-money-bill text-muted"></i>
                        <small class="text-muted">1,000</small>
                      </div>
                      <div class="bank-note-info float-left pl-2">
                        @if(isset($returnCash[1000]))
                            {{$returnCash[1000]}}
                        @else
                            0
                        @endif
                      </div>
                    </div>
                    <div class="bank-note-info-box ml-5 clearfix float-left">
                      <div class="bank-note-box float-left">
                        <i class="fas fa-money-bill text-muted"></i>
                        <small class="text-muted">500</small>
                      </div>
                      <div class="bank-note-info  float-left pl-2">
                        @if(isset($returnCash[500]))
                            {{$returnCash[500]}}
                        @else
                            0
                        @endif
                      </div>
                    </div>

                    <div class="bank-note-info-box ml-5 clearfix float-left">
                      <div class="bank-note-box float-left">
                        <i class="fas fa-money-bill text-muted"></i>
                        <small class="text-muted">100</small>
                      </div>
                      <div class="bank-note-info  float-left pl-2">
                        @if(isset($returnCash[100]))
                            {{$returnCash[100]}}
                        @else
                            0
                        @endif
                      </div>
                    </div>

                    <div class="bank-note-info-box ml-5 clearfix float-left">
                      <div class="bank-note-box float-left">
                        <i class="fas fa-money-bill text-muted"></i>
                        <small class="text-muted">50</small>
                      </div>
                      <div class="bank-note-info  float-left pl-2">
                        @if(isset($returnCash[50]))
                            {{$returnCash[50]}}
                        @else
                            0
                        @endif
                      </div>
                    </div>

                    <div class="bank-note-info-box ml-5 clearfix float-left">
                      <div class="bank-note-box float-left">
                        <i class="fas fa-money-bill text-muted"></i>
                        <small class="text-muted">20</small>
                      </div>
                      <div class="bank-note-info  float-left pl-2">
                        @if(isset($returnCash[20]))
                            {{$returnCash[20]}}
                        @else
                            0
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            @endif


          </div>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
        <script src="{{asset('js/atm_form.js')}}"></script>
    </body>
</html>