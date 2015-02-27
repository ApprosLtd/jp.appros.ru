<?php namespace App\Http\Controllers;

class PurchasesController extends Controller {

    public function getPurchase($id)
    {
        $purchase_model = \App\Models\Purchase::find($id);

        if (!$purchase_model) {
            // TODO: 404 - not found
        }

        return view('purchase.index');
    }

    public function getIndex()
    {
        //
    }
}
