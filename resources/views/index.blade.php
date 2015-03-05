@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table" role="table">
                            <thead>
                            <th>Item</th>
                            <th>Vendor</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->item}}</td>
                                    <td>{{$transaction->vendor}}</td>
                                    <td>{{$transaction->amount}}</td>
                                    <td>{{$transaction->payment}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

