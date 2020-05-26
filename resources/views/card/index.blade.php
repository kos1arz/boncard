@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10">
    <h3>List cards</h3>
    </div>
    <div class="col-sm-2">
    <a class="btn btn-sm btn-success" href="{{ route('card.create') }}">Create New Card</a>
    </div>
</div>

@if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{$message}}</p>
      </div>
    @endif

<table class="table table-hover table-sm">
    <tr>
        <th><b>No.</b></th>
        <th><b>Card number</b></th>
        <th><b>Pin</b></th>
        <th><b>Activation date</b></th>
        <th><b>Expiration date</b></th>
        <th><b>Amount</b></th>
    </tr>

    @foreach ($cards as $card)
    <tr>
        <td><b>{{++$i}}.</b></td>
        <td>{{$card->card_number}}</td>
        <td>{{$card->pin}}</td>
        <td>{{$card->activation_date}}</td>
        <td>{{$card->expiration_date}}</td>
        <td>{{$card->amount}}zł</td>
        <td>
        <form action="{{ route('card.destroy', $card->id) }}" method="post">
            <a class="btn btn-sm btn-warning" href="{{ route('card.edit',$card->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
        </td>
    </tr>
    @endforeach
</table>
{!! $cards->links() !!}
@endsection
