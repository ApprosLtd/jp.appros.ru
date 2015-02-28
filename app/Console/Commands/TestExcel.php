<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use PHPExcel_Cell_DataType;

class TestExcel extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'excel';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

        \Excel::selectSheetsByIndex(0)->load(base_path() . '/storage/app/price1.xls', function($reader) {

            /**
             * @var $reader \Maatwebsite\Excel\Readers\LaravelExcelReader
             */
            $reader->setValueBinder(new \App\Helpers\MyValueBinder);

            /**
             * @var $results \Maatwebsite\Excel\Readers\LaravelExcelReader
             */
            $results = $reader->skip(9)->get();

            if (empty($results)) {
                return;
            }

            foreach ($results as $row) {

                /**
                 * @var $row \Maatwebsite\Excel\Readers\LaravelExcelReader
                 */
                $row_mix = $row->toArray();

                if (count($row_mix) <= 10) {
                    continue;
                }

                $column_first = trim($row_mix[0]);
                $column_title = trim($row_mix[2]);
                $column_weight = trim($row_mix[3]);
                $column_price1 = trim($row_mix[4]);
                $column_price2 = trim($row_mix[5]);
                $column_price3 = trim($row_mix[6]);
                $column_price4 = trim($row_mix[7]);
                $column_price5 = trim($row_mix[8]);
                $column_price6 = trim($row_mix[9]);
                $column_price7 = trim($row_mix[10]);

                if (empty($column_first)) {
                    continue;
                }

                if (empty($column_title)) {
                    continue;
                }

                $product = new \App\Models\Product;

                $product->article = $column_first;
                $product->name = $column_title;
                $product->user_id = 1;
                //$product->weight = $column_weight;

                $product->save();

                echo '.';
            }
            echo "\n";
        });
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			//['example', InputArgument::REQUIRED, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
