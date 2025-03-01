<?php

namespace App\Console\Commands;

use App\Services\Rayvarz\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RayvarzProductsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rayvarzproducts:cron';//

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $productService,$productRepository,$settingRepository;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->productService = new ProductService();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("Cron is working fine! ".now());
        log::info($this->productService->addNewRayvarzProductsToProductsTable());
        return 0;
    }
}
