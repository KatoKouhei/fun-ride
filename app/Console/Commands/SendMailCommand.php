<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\TaskController;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send mail';

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
        //

        // フォローしている人が参加するイベントを通知
        TaskController::followUp();
        // 参加していたイベントが中止したとき
        TaskController::suspension();
        // 参加イベントのリマインダー
        TaskController::reminder();
        // 参加グループのイベントが公開されたとき
        TaskController::groupUp();
    }
}
