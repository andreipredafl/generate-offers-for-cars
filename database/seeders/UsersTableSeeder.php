<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Field;
use App\Models\OfferField;
use App\Models\Offer;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
        
        
        $fieldsNames = [
            'Year', 'Kilometers', 'Fuel Type', 'Body Type', 'Transmission', 'Origin Country', 'Doors', 'Places'
        ];

        for($i = 0; $i < count($fieldsNames); $i++) {
            Field::create([
                'name' => $fieldsNames[$i]
            ]);
        }
        
        Offer::create([
            'title' => 'Seat Leon 1.6 TDI DPF Ecomotive',
            'description' => 
                'SEAT LEON 1.6 TDI STYLE CUP - PACKAGE F R - 1.6 TDI - 105 HP - 5 L - 100 KM MIXED CONSUMPTION MOTOR
                - imported from Belgium on February 8 - Circulates 3 months with provisional No.
                - prop pers physics Belgium
                - real km / service card - Seat res test accepted
                - well maintained technically / optically - no accidents in history
                - 2 original keys
                - euro 5 - 210 RON annual tax
                - total service
                - 10 airbags
                - European color ships including Ro
                - Klimatronic
                - multifunctional leather steering wheel
                - ABS / ESP
                - Elec windows
                - original factory color windows
                - light / parking / rain sensors
                - Elec / heated / heliomat mirrors
                - alloy wheels orig 17 - f good - about 20% wear
                - fixed price - possibility of car installments / credit - car lime at 7990 e',
            'link' => env('APP_URL').'/offer/test1'
        ]);
        
        $filedsValues = ['2011', '143.300', 'Diesel', 'Compact', 'Manual', 'Germany', '5', '5'];
        for($i = 0; $i < count($fieldsNames); $i++) {
            OfferField::create([
                'offer_id' => 1,
                'field_id' => $i+1,
                'value' => $filedsValues[$i]
            ]);
        }
        
        
        Offer::create([
            'title' => 'Ford Mustang GT 5.0 V8',
            'description' =>  "Premium package 2, carbon rear spoiler, design stripes in black,
            Exhaust system with flap control, outside mirrors electr. adjustable and heated, floor light in the exterior mirror, on-board computer, twin tailpipe exhaust system, electr. brake force distribution, electron. Stability program (AdvanceTrac), driver assistance system: hill start assistant (Hill-Holder), driver assistance system: emergency brake assistant, driver assistance system: lane departure warning, automatic transmission - type: 10R80 (10 steps), belt tensioners, handbrake lever handle leather , heated rear window, body: 2-door, 2-zone automatic air conditioning, knee airbag on the driver's side, head-shoulder airbag in front, heated steering wheel, line-lock system, LM rims, facelift, engine 5.0 ltr. - 331 kW Ti -VCT V8 KAT, My Key (2nd vehicle key programmable), LED fog lights, rear parking pilot system, aluminum pedals, performance package, tire repair kit, tire pressure monitoring system, reversing camera, low-emission emissions standard Euro 6, low-emission emissions standard Euro 6d-TEMP , LED headlights, limited slip differential, rear bumper sport design with diffuser, bumper body color",
            'video_url' => 'https://youtu.be/n6aUmQfjhRg',
            'link' => env('APP_URL').'/offer/test2'
        ]);
        $filedsValues = ['2018', '13.300', 'Diesel', 'Sedan', 'Automatic', 'Germany', '5', '5'];
        for($i = 0; $i < count($fieldsNames); $i++) {
            OfferField::create([
                'offer_id' => 2,
                'field_id' => $i+1,
                'value' => $filedsValues[$i]
            ]);
        }
    }
}
