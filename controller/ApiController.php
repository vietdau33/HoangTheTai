<?php

class ApiController extends Controller{
    private $apiModels;

    public function __construct(){
        parent::__construct();
        $this->apiModels = new ApiModels();
    }

    public function index(){
        echo 'THIS API has blocked!';

//        $contries = file_get_contents('https://restcountries.eu/rest/v2/all');
//        $contries = json_decode($contries, true);
//        $aryInsert = [];
//        foreach ($contries as $contry) {
//            $flag = $contry['flag'];
//            $flag = explode('/', $flag);
//            $flag = $flag[count($flag) - 1];
//            $aryInsert[] = [
//                'name'          => $contry['name'],
//                'alpha2Code'    => $contry['alpha2Code'],
//                'alpha3Code'    => $contry['alpha3Code'],
//                'capital'       => $contry['capital'],
//                'region'        => $contry['region'],
//                'subregion'     => $contry['subregion'],
//                'flag'          => 'images/flag_contry/' . $flag
//            ];
//        }
//        return $this->apiModels->insertData($aryInsert);
    }
}