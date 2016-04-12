<?php

namespace App\Console\Commands;

use File;
use App\Item;
use Illuminate\Console\Command;

class ImportItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:items {itemsfile} {photofile}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入商品信息';

    protected $pre_dir_name = "photo/";


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
        $fitems = $this->argument('itemsfile');
        $fphoto = $this->argument('photofile');

        if (!File::exists($fitems) || !File::exists($fphoto)) {
            $this->error("path not exists");
            return;
        }

        $content = File::get($fitems);
        $lt = explode("\n", $content);
        $lt = array_slice($lt, 1);

        $cols = [];

        foreach ($lt as $line) {
            if (trim($line) == "") {
                continue;
            }
            $col = explode("\t", $line);
            if (count($col) != 12) {
                print_r($col);
                $this->error("error col ".count($col));
                return;
            }
            $cols[] = $col;
        }

        $this->comment("total line: ".strval(count($cols)));

        $this->save($cols);
        $this->cp($fphoto);
        
        $this->info("done");
    }


    public function save($cols) 
    {
        foreach ($cols as $col) {
            $item = Item::firstOrNew(["id" => $col[0]]);
            if ($item->exists() &&
                $item->name == $col[1] &&
                $item->brand == $col[2] &&
                $item->photo == $this->pre_dir_name.$col[3] &&
                $item->major_type == intval($col[4]) &&
                $item->minor_type == intval($col[5]) &&
                $item->url == $col[6] &&
                $item->original_price == floatval($col[7]) &&
                $item->discount_price == floatval($col[8]) &&
                $item->original_points == intval($col[9]) &&
                $item->original_points == intval($col[10]) &&
                $item->active == intval($col[11])) {
                        continue;
            } else {
                $item->name = $col[1];
                $item->brand = $col[2];
                $item->photo = $this->pre_dir_name.$col[3];
                $item->major_type = intval($col[4]);
                $item->minor_type = intval($col[5]);
                $item->url = $col[6];
                $item->original_price = floatval($col[7]);
                $item->discount_price = floatval($col[8]);
                $item->original_points = intval($col[9]);
                $item->original_points = intval($col[10]);
                $item->active = intval($col[11]);

                $item->save();
            }
        }
    }

    public function cp($source) 
    {
        File::copyDirectory($source, public_path()."/".$this->pre_dir_name);
    }
}
