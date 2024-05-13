<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }
    
    public function countryCompetitions(){
        $client = new Client();
        $res = $client->get(config('app.api.apiURL'). "/?action=get_countries&APIkey=". config('app.api.apiKey'));
        $resCountries = json_decode($res->getBody()->getContents());
        
        return view('countryCompetitions', compact('resCountries'));
    }
    
    public function CountryCompetitionsDetail(string $countryId){
        $client = new Client();
        $res = $client->get(config('app.api.apiURL'). "/?action=get_leagues&country_id=". $countryId ."&APIkey=". config('app.api.apiKey'));
        
        $resCompetitions = json_decode($res->getBody()->getContents());
        
        return view('countryCompetitionsDetail', compact('resCompetitions'));
    }
    
    public function countryCompetitionsStandings(string $leagueId){
        try{

            $client = new Client();
            $res = $client->get(config('app.api.apiURL'). "/?action=get_standings&league_id=". $leagueId ."&APIkey=". config('app.api.apiKey'));
            
            $resStandings= json_decode($res->getBody()->getContents());
            if(!is_array($resStandings)){
                return redirect()->back()->with('error', "it's not a league, it's a competitions event");
            }
            
            return view('countryCompetitionsStandings', compact('resStandings'));
        } catch(\Exception $e){
            dd($e);
        }
    }
}
