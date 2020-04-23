<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Extranet\Entities\Element;
use Modules\Extranet\Services\ExportImport\Exporters\ElementExporter;
use Modules\Extranet\Services\ExportImport\Importers\ElementImporter;

class ExporterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $exporter = new ElementExporter(Element::find(98));

        //echo json_encode($exporter->export(), JSON_PRETTY_PRINT);
        // dd(json_encode($exporter->export()));

        $impoter = new ElementImporter(json_encode($exporter->export()));
        $impoter->import();
    }
}
