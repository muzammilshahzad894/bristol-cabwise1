<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Http\Requests\BookingRequest;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use App\Mail\BookingConfirm;
use Illuminate\Support\Facades\Mail;
use App\Mail\Quote;
class BookingController extends Controller
{
    private $_service = null;
    private $_directory = 'auth/pages/bookings';
    private $_route = 'bookings';

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct()
    {
        $this->_service = new bookingService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->_service->index();
        return view($this->_directory . '.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_directory . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(bookingRequest $request)
    {

        $requestType=$request->request_type;
        $paymentType=$request->payment_type;
        if($requestType==='quote')
        {
            $data=$request->all();
            Mail::to($data['email'])->send(new Quote($data));

        }

        if($requestType==='booking')
        {

            if($paymentType==='stripe')
            {
                    $user = Auth::user();
                    $data=$request->all();
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    $amount = $request->payment_amount;

                    // Create a Stripe session with the success URL parameter
                    $session = Session::create([
                        'payment_method_types' => ['card'],
                        'line_items' => [
                            [
                                'price_data' => [
                                    'currency' => 'usd',
                                    'unit_amount' => $amount * 100,
                                    'product_data' => [
                                        'name' => 'Payment',
                                    ],
                                ],
                                'quantity' => 1,
                            ],
                        ],
                        'mode' => 'payment',
                        'success_url' => route('payment-success', ['session_id' => '{CHECKOUT_SESSION_ID}', 'user_id' => $user->id,'data'=>$data]),
                        'cancel_url' => route('payment-fail',['session_id' => '{CHECKOUT_SESSION_ID}', 'user_id' => $user->id,'data'=>$data]),
                    ]);

                    session(['stripe_session_id' => $session->id]);

                 return redirect($session->url);
            }
            elseif($paymentType==='paypal')
            {


                $user = Auth::user();
                $data=$request->all();
                $amount = $request->input('amount');

                $gateway = Omnipay::create('PayPal_Rest');
                $gateway->initialize([
                    'clientId' => env('PAYPAL_CLIENT_ID'),
                    'secret' => env('PAYPAL_CLIENT_SECRET'),
                    'testMode' => true,
                ]);

                $response = $gateway->purchase([
                    'amount' => $request->payment_amount,
                    'currency' => 'USD',
                    'returnUrl' => route('payment-success',['user_id' => $user->id,'data'=>$data]),
                    'cancelUrl' => route('payment-fail',['user_id' => $user->id,'data'=>$data]),
                ])->send();

                if ($response->isRedirect()) {
                    return $response->redirect();
                } else {
                    return redirect()->back()->with('error', 'Payment request failed');
                }

            }
            else
            {
                return redirect()->back()->with('error','Wrong Payment Type Selected');
            }

        }


        try {
            $this->_service->store($request->validated());
            return redirect()->route('frontend.booking')->with('success', 'successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('frontend.booking')->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->_service->show($id);
        return view($this->_directory . '.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->_service->show($id);
        return view($this->_directory . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request Validation $validation
     * @return \Illuminate\Http\Response
     */
    public function update(bookingRequest $request, $id)
    {
        try {
            $this->_service->update($id, $request->validated());
            return redirect()->route($this->_route . '.index')->with('success', 'Something went wrong.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route($this->_route . '.index')->with('error', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->_service->destroy($id);
        return redirect()->route($this->_route . '.index');
    }


    public function stripe($data)
    {


    }


        public function success(Request $request)
        {

            $data = $request->data;
                $data['payment_status']="success";
                $data['booking_status']="success";
                $data['user_id']=$request->user_id;
                $message = "Payment successful. Your booking has been added.";
                $messageAsString = (string) $message;
                if($data)
                {

                    Mail::to($data['email'])->send(new BookingConfirm($data, $messageAsString));

                }

                $booking=$this->_service->store($data);
                return redirect()->route('frontend.booking')->with('success', 'Booking created successfully.');
        }

        public function fail(Request $request)
        {
            $data = $request->data;
            if($data)
            {
                $message="Payment Failed Try Booking Again";
                Mail::to($data['user_email'])->send(new BookingConfirm($data, $message));
            }

            try {

                return redirect()->route('frontend.booking')->with('error', 'Payment failed.');
            } catch (\Throwable $th) {
                // Handle any errors
                return redirect()->route('frontend.booking')->with('error', 'Failed to update booking: ' . $th->getMessage());
            }
        }

        public function quote(Request $request)
        {

            $data=$request->all();
            Mail::to($data['email'])->send(new Quote($data));
            return redirect()->route('frontend.quote')->with('success', 'Quote Send Successfully: ');


        }

}