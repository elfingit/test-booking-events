<?php

use Illuminate\Database\Seeder;

class EventLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu aliquam tellus. Nunc vel magna et mi euismod fermentum. Duis elementum faucibus massa sed malesuada. Ut et tortor et sem porta eleifend nec et ipsum. Phasellus eu sapien quam. Donec ac est id sapien pharetra fringilla. Nunc quis tincidunt lacus. Proin efficitur mollis rutrum. Praesent aliquet pellentesque dictum. Nullam feugiat aliquam lectus, eu congue est dignissim ut. Curabitur eget gravida arcu. Donec commodo risus vel neque fermentum, sed aliquet leo suscipit. Phasellus orci nisi, scelerisque quis nisi in, vestibulum interdum libero. Maecenas elementum risus eu ipsum faucibus, nec accumsan turpis ultricies. Sed vitae enim lorem. Pellentesque sollicitudin ex vitae nulla consectetur, ut elementum diam hendrerit.';

        \App\Model\EventLocation::create([
            'title'         => 'Test event 1',
            'description'   => $lorem,
            'latitude'      => 53.9090441,
            'longitude'     => 27.5570172,
            'started_at'    => \Carbon\Carbon::now(),
            'end_at'    => \Carbon\Carbon::now()->addDays(rand(7, 14))
        ]);

        \App\Model\EventLocation::create([
            'title'         => 'Test event 2',
            'description'   => $lorem,
            'latitude'      => 53.9114231,
            'longitude'     => 27.5468872,
            'started_at'    => \Carbon\Carbon::now(),
            'end_at'    => \Carbon\Carbon::now()->addDays(rand(7, 14))
        ]);

        \App\Model\EventLocation::create([
            'title'         => 'Test event 3',
            'description'   => $lorem,
            'latitude'      => 53.8740064,
            'longitude'     => 27.4988391,
            'started_at'    => \Carbon\Carbon::now(),
            'end_at'    => \Carbon\Carbon::now()->addDays(rand(7, 14))
        ]);
    }
}
