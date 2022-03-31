<html lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    </head>
    
    <style>
    
    
    
    
      
          #invoice{
            padding-top: 50px;
            padding-bottom: 10px;
        }
    
        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }
    
        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }
    
        .invoice .company-details {
            text-align: right
        }
    
        .invoice .company-details .name {
           margin-top: 0;
            margin-bottom: 0
        }
    
        .invoice .contacts {
            margin-bottom: 20px
        }
    
        .invoice .invoice-to {
            text-align: left
        }
    
        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }
    
        .invoice .invoice-details {
            text-align: right
        }
    
        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }
    
        .invoice main {
            padding-bottom: 50px
        }
    
        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }
    
        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }
    
        .invoice main .notices .notice {
            font-size: 1.2em
        }
    
        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }
    
        .invoice .table td,.invoice table th {
            border-bottom: 1px solid #fff;
            background: #eee;
    padding: 2px;
        }
        
    
        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }
    
        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }
    
        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }
    
        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }
    
        .invoice table .unit {
            background: #ddd
        }
    
        .invoice table .total {
            background: #3989c6;
            color: #fff
        }
    
        .invoice table tbody tr:last-child td {
            border: none
        }
    
        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }
    
        .invoice table tfoot tr:first-child td {
            border-top: none
        }
    
        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }
    
        .invoice table tfoot tr td:first-child {
            border: none
        }
    
        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }
    
        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important
            }
    
            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }
    
            .invoice>div:last-child {
                page-break-before: always
            }
        }
    
        /*ce que j ai ecris moi même*/
    img{
      max-width: 600%;
        height: auto;
    }
    body{
      font-size: x-small;
    }
    .cell td{
      height: 2%;
      padding: 0px;
      margin: 0px;
    }
    </style>
    
    <div id="invoice">
     
      <header>
          <div class="toolbar hidden-print">
              <div class="text-left">
                <b>{{__('Reçu de paiement des frais d \' education')}}</b>
              </div>
              <hr>
          </div>
      </header>
        
        <div class="invoice overflow-auto">
            <div style="min-width: 35%;max-height: 50%;max-width: 100%">
                   
                <main>
                      <table style="background-color: #FFF ;margin-right: 20%">
                        <tr >
                          <td class="cell">
                              <div >
                                  <a target="_blank" href="https://site de l'ecole.com.com">
                                    <img src={{  public_path('images/institutions/'.$company_logo)}} alt="No LOGO" data-holder-rendered="true" />
                                </a>
                              </div>
                          </td>
                          <td >
                              <div style="text-align: center;">
                                 
                                    <b> {{$company_name}}</b>
                                      
                                 
                              <div style="text-align: center;">BP : {{$BP}}</div>
                                <div style="text-align: center;">TEL : {{$tel}}</div>
                                <div style="text-align: center;">email : {{$email}}</div>
                              </div>
                          </td>
                        </tr>
                      </table>
                        
                        
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <b> Reçu N°    :</b> {{$reçu}}
                        <span style="margin-right:5%;float:right;"> <b >B.P.F. CFA:</b>{{number_format($amount, 2, ',', ' ')}}</span>
                        </div>
                       
                    </div>
                    <div style="margin-left:2%">
                      <table class="table">
                        <tr>
                          <td>Reçu de Mr/Mme :</td>
                          <td>{{$student}}</td>
                        </tr>
                        <tr>
                            <td>La somme de :</td>
                            <td>{{$amount}}</td>
                          </tr>
                          <tr>
                              <td>Inscription N° :</td>
                              <td>{{$inscription}}</td>
                            </tr>
                          <tr>
                              <td style="color:royalblue">Pour :</td>
                              <td style="color:royalblue"> PAIEMENT DES FRAIS D'EDUCATION</td>
                            </tr>
                      </table>
                     
    
                      <div class="row">
                          <span style="margin-left:5%; width: 30% !important;"><b> Filière:</b> {{$department}} </span>
                          <span style="width: 30% !important;"><b> Discipline:</b> {{$discipline}} </span>
    
                          <span style="margin-right:5%;float:right;width: 30% !important"><b> Niveau:</b> {{$level}} </span>
                      </div>
    
                    </div>
                    
                    <div style="margin-right:5%;float:right;">
                      <div>
                       <b> Date :</b>{{$date}}
                      </div>
                      <div>
                          <b>Econome :</b> {{$econome}}                 
                    </div>
                   
                </main>
               
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <footer>
                footer
            </footer>
        <div>
        <br> 
        <div style="height:10%; ">
    
        </div>
        <header>
            <div class="toolbar hidden-print">
                <div class="text-left">
                  <b>{{__('Reçu de paiement des frais d \' education')}}</b>
                </div>
            </div>
        </header>
          
          <div class="invoice overflow-auto">
              <div style="min-width: 35%;max-height: 50%;">
                     
                  <main>
                        <table style="background-color: #FFF">
                          <tr>
                            <td>
                                <div >
                                    <a target="_blank" href="https://site de l'ecole.com.com">
                                      <img src={{  public_path('images/institutions/'.$company_logo)}} alt="No LOGO" data-holder-rendered="true" />
                                  </a>
                                </div>
                            </td>
                            <td>
                                <div style="text-align: center;">
                                   
                                      <b> {{$company_name}}</b>
                                        
                                   
                                <div style="text-align: center;">BP : {{$BP}}</div>
                                  <div style="text-align: center;">TEL : {{$tel}}</div>
                                  <div style="text-align: center;">email : {{$email}}</div>
                                </div>
                            </td>
                          </tr>
                        </table>
                          
                          
                      <div class="row contacts">
                          <div class="col invoice-to">
                              <b> Reçu N° numero:</b> {{$reçu}}
                          <span style="margin-right:5%;float:right;"> <b >B.P.F. CFA: amount</b>{{$amount}}</span>
                          </div>
                         
                      </div>
                      <div style="margin-left:2%">
                        <table class="table">
                          <tr>
                            <td>Reçu de Mr/Mme :</td>
                            <td>{{$student}}</td>
                          </tr>
                          <tr>
                              <td>La somme de :</td>
                              <td>{{$amount}}</td>
                            </tr>
                            <tr>
                                <td>Inscription N° :</td>
                                <td>{{$inscription}}</td>
                              </tr>
                            <tr>
                                <td style="color:royalblue">Pour :</td>
                                <td style="color:royalblue"> PAIEMENT DES FRAIS D'EDUCATION</td>
                              </tr>
                        </table>
                       
      
                        <div class="row">
                            <span style="margin-left:5%; width: 30% !important;"><b> Filière:</b> {{$department}} </span>
                            <span style="width: 30% !important;"><b> Discipline:</b> {{$discipline}} </span>
      
                            <span style="margin-right:5%;float:right;width: 30% !important"><b> Niveau:</b> {{$level}} </span>
                        </div>
      
                      </div>
                      
                      <div style="margin-right:5%;float:right;">
                        <div>
                         <b> Date :</b>{{$date}}
                        </div>
                        <div>
                         <b>Econome :</b> {{$econome}}
                        </div>
                      </div>
                     
                  </main>
                  <footer>
                    footer
                  </footer>
              </div>
              <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
          <div>
      
      </div>
    
    
    
            </div>
    
     
    
    
    
    

    <div id="invoice">
     
    </html>
    