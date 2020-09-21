<?php

trait StripeTrait
{

    /**
     * @param $data ['number','month','year','cvc']
     * @param $amount
     * @param $description
     * @param $onSuccess
     * @return array|\Illuminate\Http\RedirectResponse
     */
    function stripePay ($data, $amount, $description, $onSuccess) {
        $stripe = Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $token = $stripe->tokens()->create(
                [
                    'card' => [
                        'number'    => $data['number'],
                        'exp_month' => $data['month'],
                        'exp_year'  => $data['year'],
                        'cvc'       => $data['cvc'],
                    ],
                ]
            );


            if ( !isset($token['id'])) {
                return back();
            }


            $charge = $stripe->charges()->create(
                [
                    'card'        => $token['id'],
                    'currency'    => config('setting.currency'),
                    'amount'      => $amount,
                    'description' => $description,
                ]
            );

            if ($charge['status'] == 'succeeded') {
                call_user_func($onSuccess);
                return ["status" => "success",'msg'=>"Payment Successful"];
            } else {
                return ["status" => "error", "msg" => "Error in Payment"];
            }
        } catch (Exception $e) {
            return ["status" => "exception", "msg" => $e->getMessage()];
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return ["status" => "exception", "msg" => $e->getMessage()];
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return ["status" => "exception", "msg" => $e->getMessage()];
        }
    }


}
