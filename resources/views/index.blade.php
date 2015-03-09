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
                            <th colspan="2" style="padding-left:22px">Amount</th>
                            <th>Payment</th>
                            <th>edit</th>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->item}}</td>
                                        <td>{{$transaction->vendor}}</td>
                                        <td style="width: 14px; padding: 8px 0 0;">
                                            @if($transaction->receipt)
                                                <i class="fa fa-file-o"></i>
                                            @endif
                                        </td>
                                        <td>{{"$".number_format($transaction->amount, 1, '.', ',') }}</td>
                                        <td>{{$transaction->payment}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{route('transactions.edit', $transaction->id)}}">edit</a>
                                        </td>
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

