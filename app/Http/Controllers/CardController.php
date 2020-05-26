<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::latest()->paginate(5);
        return view('card.index', compact('cards'))
                  ->with('i', (request()->input('page',1) -1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('card.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|unique:cards',
            'pin' => 'required',
            'activation_date' => 'required',
            'expiration_date' => 'required',
            'amount' => 'required',
          ]);
  
          Card::create($request->all());
          return redirect()->route('card.index')
                            ->with('success', 'new card created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = Card::find($id);
        $activation_date = explode(" ", $card->activation_date);
        $card->activation_date = $activation_date[0].'T'.$activation_date[1];
        $expiration_date = explode(" ", $card->expiration_date);
        $card->expiration_date = $expiration_date[0].'T'.$expiration_date[1];
        return view('card.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pin' => 'required',
            'activation_date' => 'required',
            'expiration_date' => 'required',
            'amount' => 'required',
          ]);
          $card = Card::find($id);
          $card->pin = $request->get('pin');
          $card->activation_date = $request->get('activation_date');
          $card->expiration_date = $request->get('expiration_date');
          $card->amount = $request->get('amount');
          $card->save();
          return redirect()->route('card.index')
                          ->with('success', 'Card updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Card::find($id);
        $card->delete();
        return redirect()->route('card.index')
                        ->with('success', 'Card siswa deleted successfully');
    }
}
