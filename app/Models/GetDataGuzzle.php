<?php

namespace App\Models;

use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class GetDataGuzzle
 * @package App\Models
 */
class GetDataGuzzle extends Model
{
    use HasFactory;


    /**
     * @var mixed
     */
    private $output;
    private ConsoleOutput $consoleOutput;

    public function __construct(ConsoleOutput $consoleOutput)
    {
        parent::__construct();
        $this->consoleOutput = $consoleOutput;
    }

    /**
     * @param string $month
     * @param string $day
     * @return object
     * Get Data
     */
    public function guzzleGet($month = '8', $day = '1'): object
    {

        $getDataForDay = Http::get('https://api.abalin.net/namedays',[
            'country'=>'sk',
            'month' => $month,
            'day'=> $day]);

        $getDataForDay->header('content-type');

        $getDataForDay->successful();

        $getDataForDay->clientError();
        $getDataForDay->serverError();
        $getDataForDay->failed();

        $getDataForDay->body();
        return $getDataForDay->object();

    }

    /**
     * Insert to db all data
     * Setting limit date in $period
     */
    public function insertNamedays()
    {
        $period = CarbonPeriod::create('2021-01-01', '2021-12-31');

        $outputProgress = $this->consoleOutput;
        $progress = new ProgressBar($outputProgress);
        $progress->start();

        foreach ($period as $date) {

            $getData = $this->guzzleGet(
                $date->format('m'),
                $date->format('d')
            );

            $values = array(
                'names' => $getData->data->namedays->sk,
                'dates' => $date->format('Y,m,d')
            );

            $this->insertUpdateDatabase($values);
            $progress->advance();
        }

        $progress->finish();
    }

    /**
     * @param $values
     */
    public function insertUpdateDatabase($values){
        DB::table('namedays')->updateOrInsert($values);
    }

    /**
     * @param null $id
     * @return \Illuminate\Support\Collection|string
     */
    public function getNameday($id = null)
    {
        if(isset($id)){
            $getName = DB::table('namedays')->where('id', $id)->get();
        } else{
            $getName = DB::table('namedays')->where('dates', today()->format("Y-m-d"))->get();
        }
        if ($getName->isNotEmpty()) {
            return $getName;
        } else {
            return 'Error code SD100 . Please contact support.';
        }
    }
}

