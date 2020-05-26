@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>New Card</h3>
      </div>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Whoops! </strong> there where some problems with your input.<br>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('card.store') }}" method="post">
      @csrf
      <div class="row">
        <div class="col-md-12">
          <strong>Card number:</strong>
          <input type="text" name="card_number" class="form-control" placeholder="Card number" minlength="20" maxlength="20" >
        </div>
        <div class="col-md-12">
          <strong>Pin:</strong>
          <input type="number" name="pin" class="form-control" placeholder="Pin" min="0000" max="9999">
        </div>
        <div class="col-md-12">
          <strong>Activation date:</strong>
          <input type="datetime-local" name="activation_date" class="form-control">
        </div>
        <div class="col-md-12">
          <strong>Expiration date:</strong>
          <input type="datetime-local" name="expiration_date" class="form-control">
        </div>
        <div class="col-md-12">
          <strong>Amount:</strong>
          <input type="number" name="amount" class="form-control" placeholder="Amount" min="0.01" max="999999" step="0.01">
        </div>

        <div class="col-md-12 mt-2">
          <a href="{{ route('card.index') }}" class="btn btn-sm btn-success">Back</a>
          <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
@endsection