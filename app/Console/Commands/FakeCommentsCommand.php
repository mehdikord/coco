<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\User;
use Illuminate\Console\Command;

class FakeCommentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:comment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Product::all() as $product){
            for ($i=0 ; $i < rand(1,26);$i++){
                $product->comments()->create([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'comment' => ' افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.',
                ]);
            }
        }
        return $this->info('Done !');
    }
}
