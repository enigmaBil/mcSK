
@php
    $totalDebt = 0;
   $totalAmtPaid = 0;
@endphp
            <table id="example1"   class="table table-bordered table-striped paymentTable">
                <thead>
                    <tr>
                        <th>Nom de l'étudiant</th>
                        <th>{{__('matricule')}}</th>
                        <th>{{__('discipline')}}</th>
                        <th>{{__('level')}}</th>
                        <th>Date de paiement</th>
                        <th>{{__('amount')}}</th>
                    </tr>
                </thead>
                <tbody>

              @if(!$academic_year_id && !$level_id && !$discipline_id)
                @foreach ($studentsPayments as $payment)
                    <tr>
                        <form>
                            <td contenteditable="false">{{$payment->oneInscription->oneStudent->last_name}} {{$payment->oneInscription->oneStudent->first_name}}</td>
                            <td contenteditable="false">{{$payment->oneInscription->oneStudent->code}}</td>
                            <td contenteditable="false">{{$payment->oneInscription->oneClass->oneDiscipline->name}}</td>
                            <td contenteditable="false">{{$payment->oneInscription->oneClass->oneLevel->name}}</td>
                            <td contenteditable="false">{{$payment->created_at}}</td>
                            <td contenteditable="false">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                            @php
                                $totalAmtPaid += $payment->amount
                            @endphp
                        </form>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <form>
                            <td contenteditable="false"style="font-size: 16px;font-weight:bold;">Montant total</td>
                            <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                            <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalAmtPaid, 2, ',', ' ')}}</td>
                        </form>
                    </tr>
                </tfoot>
              @endif

                @if($academic_year_id && !$level_id && !$discipline_id)
                    @foreach ($studentsPayments as $payment)
                      @if($payment->oneInscription->oneAcademic_year->id == $academic_year_id)
                        <tr>
                            <form>
                                <td contenteditable="false">{{$payment->oneInscription->oneStudent->last_name}} {{$payment->oneInscription->oneStudent->first_name}}</td>
                                <td contenteditable="false">{{$payment->oneInscription->oneStudent->code}}</td>
                                <td contenteditable="false">{{$payment->oneInscription->oneClass->oneDiscipline->name}}</td>
                                <td contenteditable="false">{{$payment->oneInscription->oneClass->oneLevel->name}}</td>
                                <td contenteditable="false">{{$payment->created_at}}</td>
                                <td contenteditable="false">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                                @php
                                    $totalAmtPaid += $payment->amount
                                @endphp
                            </form>
                        </tr>
                      @endif
                    @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <form>
                                <td contenteditable="false"style="font-size: 16px;font-weight:bold;">Montant total</td>
                                <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalAmtPaid, 2, ',', ' ')}}</td>
                            </form>
                        </tr>
                        </tfoot>
                @endif

              @if(!$academic_year_id && $level_id && !$discipline_id)
                  @foreach ($studentsPayments as $payment)
                      @if($payment->oneInscription->oneClass->oneLevel->id == $level_id)
                          <tr>
                              <form>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->last_name}} {{$payment->oneInscription->oneStudent->first_name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->code}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneDiscipline->name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneLevel->name}}</td>
                                  <td contenteditable="false">{{$payment->created_at}}</td>
                                  <td contenteditable="false">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                                  @php
                                      $totalAmtPaid += $payment->amount
                                  @endphp
                              </form>
                          </tr>
                      @endif
                  @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                              <form>
                                  <td contenteditable="false"style="font-size: 16px;font-weight:bold;">Montant total</td>
                                  <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                  <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalAmtPaid, 2, ',', ' ')}}</td>
                              </form>
                          </tr>
                          </tfoot>
              @endif

              @if(!$academic_year_id && !$level_id && $discipline_id)
                  @foreach ($studentsPayments as $payment)
                      @if($payment->oneInscription->oneClass->oneDiscipline->id == $discipline_id)
                          <tr>
                              <form>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->last_name}} {{$payment->oneInscription->oneStudent->first_name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->code}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneDiscipline->name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneLevel->name}}</td>
                                  <td contenteditable="false">{{$payment->created_at}}</td>
                                  <td contenteditable="false">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                                  @php
                                      $totalAmtPaid += $payment->amount
                                  @endphp
                              </form>
                          </tr>
                      @endif
                  @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                              <form>
                                  <td contenteditable="false"style="font-size: 16px;font-weight:bold;">Montant total</td>
                                  <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                  <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalAmtPaid, 2, ',', ' ')}}</td>
                              </form>
                          </tr>
                          </tfoot>
              @endif

              @if($academic_year_id && $level_id && !$discipline_id)
                  @foreach ($studentsPayments as $payment)
                      @if($payment->oneInscription->oneAcademic_year->id == $academic_year_id && $payment->oneInscription->oneClass->oneLevel->id == $level_id)
                          <tr>
                              <form>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->last_name}} {{$payment->oneInscription->oneStudent->first_name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->code}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneDiscipline->name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneLevel->name}}</td>
                                  <td contenteditable="false">{{$payment->created_at}}</td>
                                  <td contenteditable="false">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                                  @php
                                      $totalAmtPaid += $payment->amount
                                  @endphp
                              </form>
                          </tr>
                      @endif
                  @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                              <form>
                                  <td contenteditable="false"style="font-size: 16px;font-weight:bold;">Montant total</td>
                                  <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                  <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalAmtPaid, 2, ',', ' ')}}</td>
                              </form>
                          </tr>
                          </tfoot>
              @endif


              @if($academic_year_id && !$level_id && $discipline_id)
                  @foreach ($studentsPayments as $payment)
                      @if($payment->oneInscription->oneAcademic_year->id == $academic_year_id && $payment->oneInscription->oneClass->oneDiscipline->id == $discipline_id)
                          <tr>
                              <form>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->last_name}} {{$payment->oneInscription->oneStudent->first_name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->code}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneDiscipline->name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneLevel->name}}</td>
                                  <td contenteditable="false">{{$payment->created_at}}</td>
                                  <td contenteditable="false">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                                  @php
                                      $totalAmtPaid += $payment->amount
                                  @endphp
                              </form>
                          </tr>
                      @endif
                  @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                              <form>
                                  <td contenteditable="false"style="font-size: 16px;font-weight:bold;">Montant total</td>
                                  <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                  <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalAmtPaid, 2, ',', ' ')}}</td>
                              </form>
                          </tr>
                          </tfoot>
              @endif


              @if(!$academic_year_id && $level_id && $discipline_id)
                  @foreach ($studentsPayments as $payment)
                      @if($payment->oneInscription->oneClass->oneLevel->id == $level_id && $payment->oneInscription->oneClass->oneDiscipline->id == $discipline_id)
                          <tr>
                              <form>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->last_name}} {{$payment->oneInscription->oneStudent->first_name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->code}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneDiscipline->name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneLevel->name}}</td>
                                  <td contenteditable="false">{{$payment->created_at}}</td>
                                  <td contenteditable="false">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                                  @php
                                      $totalAmtPaid += $payment->amount
                                  @endphp
                              </form>
                          </tr>
                      @endif
                  @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                              <form>
                                  <td contenteditable="false"style="font-size: 16px;font-weight:bold;">Montant total</td>
                                  <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                  <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalAmtPaid, 2, ',', ' ')}}</td>
                              </form>
                          </tr>
                          </tfoot>
              @endif

              @if($academic_year_id && $level_id && $discipline_id)
                  @foreach ($studentsPayments as $payment)
                      @if($payment->oneInscription->oneAcademic_year->id == $academic_year_id && $payment->oneInscription->oneClass->oneLevel->id == $level_id && $payment->oneInscription->oneClass->oneDiscipline->id == $discipline_id)
                          <tr>
                              <form>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->last_name}} {{$payment->oneInscription->oneStudent->first_name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneStudent->code}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneDiscipline->name}}</td>
                                  <td contenteditable="false">{{$payment->oneInscription->oneClass->oneLevel->name}}</td>
                                  <td contenteditable="false">{{$payment->created_at}}</td>
                                  <td contenteditable="false">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                                  @php
                                      $totalAmtPaid += $payment->amount
                                  @endphp
                              </form>
                          </tr>
                      @endif
                   @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                              <form>
                                  <td contenteditable="false"style="font-size: 16px;font-weight:bold;">Montant total</td>
                                  <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                  <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalAmtPaid, 2, ',', ' ')}}</td>
                              </form>
                          </tr>
                          </tfoot>
              @endif
            </table>
