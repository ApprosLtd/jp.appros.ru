<?php namespace App\Http\Controllers\Rest;

use App\Http\Requests;

use Illuminate\Http\Request;

class OrdersController extends RestController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        return 'store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return 'show-'.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return 'edit-'.$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $purchase_id
     * @return Response
     */
    public function update($purchase_id)
    {
        if (!$this->user) {
            return \App\Helpers\RestHelper::exceptionAccessDenied();
        }

        $purchase_model = \App\Models\PurchaseModel::find($purchase_id);
        \App\Helpers\Assistant::assertModel($purchase_model);

        $updated_orders_amounts = \Input::get('updated_amounts', []);

        if (empty($updated_orders_amounts)) {
            return ['success' => false];
        }

        foreach ($updated_orders_amounts as $updated_order_amount) {
            $order_model = $this->user->orders()->find($updated_order_amount['order_id']);
            \App\Helpers\Assistant::assertModel($order_model);

            $amount = intval($updated_order_amount['amount']);

            if (!$amount) {
                $order_model->delete();
                continue;
            }

            $order_model->amount = $amount;
            $order_model->save();
        }

        return \App\Helpers\OrdersHelper::getOrdersCollectionsByPurchaseIdAndByUserId($purchase_id, $this->user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $order_id
     * @return Response
     */
    public function destroy($order_id)
    {
        if (!$this->user) {
            return \App\Helpers\RestHelper::exceptionAccessDenied();
        }

        $order_model = $this->user->orders()->find($order_id);
        \App\Helpers\Assistant::assertModel($order_model);

        $order_model->delete();
    }

}
