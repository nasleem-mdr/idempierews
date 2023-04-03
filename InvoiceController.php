<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class InvoiceController extends Controller
{
    
    public function Invoice(Request $request)
    {
        $client = new Client();
        $url = "http://localhost:8080/ADInterface/services/rest/model_adservice/read_data";
        $var = $request->input('id');
        $params = [
            //If you have any Params Pass here
            'ModelCRUDRequest' => [
                'ModelCRUD'=> [
                    'serviceType'=> 'ReadInvoice1',
                    'TableName'=> 'C_Invoice',
                    'RecordID'=> $var,
                    'Action'=> 'Read'
                ],
                'ADLoginRequest' => [
                    'user' => 'SuperUser',
                    'pass'=> 'System',
                    'lang'=> 'en_US',
                    'ClientID'=> '11',
                    'RoleID'=> '50004',
                    'OrgID'=> '0',
                    'WarehouseID'=> '0',
                    'stage'=> '9'
                ]
            ]
        ];
        $response = Http::acceptJson()->post($url, $params);
        $responseBody = json_decode($response->body(), TRUE);

        foreach($responseBody['WindowTabData']['DataSet']['DataRow'] as $link=>$value ){
             $var2 = $value[1]['val'];
        }
        
  
        $param2 = [
            //If you have any Params Pass here
            'ModelCRUDRequest' => [
                'ModelCRUD'=> [
                    'serviceType'=> 'ReadBPartner',
                    'TableName'=> 'C_BPartner',
                    'RecordID'=> $var2,
                    'Action'=> 'Read'
                ],
                'ADLoginRequest' => [
                    'user' => 'SuperUser',
                    'pass'=> 'System',
                    'lang'=> 'en_US',
                    'ClientID'=> '11',
                    'RoleID'=> '50004',
                    'OrgID'=> '0',
                    'WarehouseID'=> '0',
                    'stage'=> '9'
                ]
            ]
        ];
        $response2 = Http::acceptJson()->post($url, $param2);
        $responseBody2 = json_decode($response2->body(), TRUE);

        //dd($responseBody2);
                                   
        
        
        //dd($responseBody, $responseBody2) ;
        return view('invoice.invoice', compact('responseBody','responseBody2'));
    }
    
}
