<?php

namespace App\Http\Controllers;

use App\Models\CurrencyPair;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCurrencyPairRequest;
use App\Http\Requests\UpdateCurrencyPairRequest;


class   CurrencyPairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCurrencyPairs()
    {
        //
        $currencyPairs = CurrencyPair::all();

        return response()->json([
            'data' => $currencyPairs
        ], 200);
    }

    /**
     * creating a new resource.
     */
    public function addCurrencyPair(Request $request)
    {
        $validatedData = $request->validate([
            'pair' => 'required|string',
            'rate' => 'required|numeric|between:0,99.9',
        ]);
        $convert = CurrencyPair::create([
            'pair' => $validatedData['pair'],
            'rate' => $validatedData['rate'],
        ]);
        return response()->json([
            'message' => 'La paire de devises a été ajoutée avec succès',
            'data' => $convert
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurrencyPairRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showCurrencyPair($id)
    {
        //
        $currency = CurrencyPair::find($id);

        if ($currency) {
            return response()->json([
                'message' => 'La paire de devises a été trouvée',
                'data' => $currency
            ], 200);
        } else {
            return response()->json([
                'message' => 'La paire de devises n\'a pas été trouvée',
                'data' => null
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CurrencyPair $currencyPair)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCurrencyPairs(Request $request, $pair)
    {
        $validatedData = $request->validate([
            'rate' => 'required|numeric|between:0,99.9',
        ]);

        $convert = CurrencyPair::where('pair', $pair)->update([
            'rate' => $validatedData['rate'],
        ]);

        if ($convert) {
            return response()->json([
                'message' => 'La paire de devises a été mise à jour avec succès',
                'data' => $convert
            ], 201);
        } else {
            return response()->json([
                'message' => 'La paire de devises n\'a pas été mise à jour. Veuillez vérifier l\'identifiant de la paire de devises.',
                'data' => null
            ], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function deleteCurrencyPair($id)
    {
        $currency = CurrencyPair::find($id);

        if ($currency) {
            $currency->delete();
            return response()->json([
                'message' => 'La paire de devises a été supprimée avec succès',
            ], 200);
        } else {
            return response()->json([
                'message' => 'La paire de devises n\'a pas été trouvée',
            ], 404);
        }
    }

}
