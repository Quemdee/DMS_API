<?php

namespace App\Http\Controllers\Api;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuotationResource;

class QuotationController extends Controller
{
    //

    public function index(){

        $quotations = Quotation::get();
        if($quotations)
        {

            return QuotationResource::collection($quotations);

        }
        else {

            return response()-> json(['message'=> 'No quotation available'], 200); 

        }

       
    }

    public function store (Request $request){

     
        //$quotation = $request->user()->quotations()->create(
        $quotation = Quotation::create([
            'ClientName' => $request -> ClientName,
            // 'Organisation' => $request -> Organisation,
            // 'ClientPhone' => $request -> ClientPhone,
            // 'ClientEmail' => $request -> ClientEmail,
            'ClientAddress' => $request -> ClientAddress
        ]);

   

        return response()->json(['message'=> 'The Quotation was created', 'data'=> new QuotationResource($quotation)], 200);

    }

    public function show(Quotation $quotation){

        return new QuotationResource($quotation);
    }

    public function update(Request $request, Quotation $quotation){

        $quotation -> update([
            'ClientName' => $request -> ClientName,
            // 'Organisation' => $request -> Organisation,
            // 'ClientPhone' => $request -> ClientPhone,
            // 'ClientEmail' => $request -> ClientEmail,
            'ClientAddress' => $request -> ClientAddress
        ]);

   

        return response()->json(['message'=> 'The Quotation was updated', 'data'=> new QuotationResource($quotation)], 200);

        
    }

    public function destroy(Quotation $quotation){

        $quotation -> delete(); 



        return response()-> json(['message'=> 'the quotation has been deleted'], 200);
    }
}