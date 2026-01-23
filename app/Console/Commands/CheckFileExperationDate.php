<?php

namespace App\Console\Commands;

use App\Models\File;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

// created by ahmad obeidat
class CheckFileExperationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckFileExperationDate:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check files that will expire within 7 days and notify department managers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for files expiring soon...');

        $today = Carbon::now('Asia/Amman');
        $sevenDaysLater = Carbon::now('Asia/Amman')->addDays(7);

        // Find files that will expire within the next 7 days
        $soonToExpireFiles = File::with('department.manager')
            ->where('date_of_revision', '>=', $today)
            ->where('date_of_revision', '<=', $sevenDaysLater)
            // ->where('expiration_warning_sent', false) // Only get files without warnings
            ->get();

        $notificationCount = 0;

        if ($soonToExpireFiles->count() > 0) {
            foreach ($soonToExpireFiles as $file) {
                // Calculate days until expiration
                // $daysRemaining = Carbon::now()->diffInDays(Carbon::parse($file->date_of_revision));4$now = Carbon::now();
                $revisionDate = Carbon::parse($file->date_of_revision);
                $now = Carbon::now('Asia/Amman');

                $diff = $now->diff($revisionDate);
                $readableTime = $diff->format('%d days and %h hours');

                // Get the department manager
                $manager = $file->department->manager;

                if ($manager) {
                    // Create notification in the database
                    Notification::create([
                        'user_id' => $manager->id,
                        'file_id' => $file->id,
                        'title' => 'File Expiration Warning',
                        'description' => "File '{$file->name_en}' (Doc #: {$file->document_number}) will expire in {$readableTime}.",
                    ]);

                    $notificationCount++;
                    $this->line("Notification created for {$manager->name} about file Doc #: {$file->document_number} expiring in {$readableTime}.");
                } else {
                    $this->warn("No manager found for department of file Doc #: {$file->document_number}");
                    Log::warning("No manager found for department ID: {$file->department_id}, File ID: {$file->id}");
                }

                // Update the file to record that a notification was sent
                // $file->update([
                //     'expiration_warning_sent' => true,
                //     'expiration_warning_sent_at' => Carbon::now('Asia/Amman'),
                // ]);
            }

            $this->info("{$notificationCount} notifications created for files expiring within 7 days.");
        } else {
            $this->info('No files expiring within the next 7 days.');
        }

        return Command::SUCCESS;
    }
}
