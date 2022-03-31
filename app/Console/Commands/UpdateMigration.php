<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Mobility\InstitutionRepository;
use Illuminate\Support\Collection;


class UpdateMigration extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:migration {path : The relative path for migration} {artisanPath : The absolute path to project root folder} {--targetDomain= : The specific domain to handle}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all client databases as regarding structure and data.';

    /**
     * @var InstitutionRepository
     */
    protected $institutionRepository;

    /**
     * Create a new command instance.
     *
     * @param InstitutionRepository $institutionRepository
     */
    public function __construct(InstitutionRepository $institutionRepository) {
        parent::__construct();
        $this->institutionRepository = $institutionRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        #Get artisan path
        $artisanPath = $this->argument('artisanPath');
        $this->info("Path: " . $artisanPath);

        $path = $this->argument('path');

        $targetDomain = $this->option("targetDomain");
        $cpy = $this->institutionRepository->findByDomain($targetDomain);
        if($cpy) {
            $companies = new Collection;
            $companies->push($cpy);
        } else {
            $companies = $this->institutionRepository->getAll(2);# companies ready
        }

        foreach($companies as $company) {
            # Switch to current company database
            $settings = json_decode($company->settings);
            $database = $settings->db->database;
            $username = $settings->db->username;
            $password = $settings->db->password;

            $parameters = base64_encode($database) . ":" . base64_encode($username) . ":" . base64_encode($password);

            $command = "php ${artisanPath} migrate --database=${parameters} --force --path=\"database/migrations/${path}\"";
            $response = \Terminal::command($command)->execute();
            $data = $response->getBody()->getContents();

            $this->info("Database: ${database}");
            foreach ($data as $datum) {
                $this->info($datum);
            }
            $this->info("");
        }

        return true;
    }

}
