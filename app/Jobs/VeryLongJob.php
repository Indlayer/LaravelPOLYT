<?php

namespace App\Jobs;

use App\Mail\NewPostMail;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VeryLongJob implements ShouldQueue
{
    use Queueable;

    public Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function handle(): void
    {
        $this->post->load('category');

        Log::channel('mail')->info('QUEUE JOB STARTED FOR POST: ' . $this->post->title);

        Mail::to(env('MODERATOR_EMAIL', 'admin@mail.com'))
            ->send(new NewPostMail($this->post));

        Log::channel('mail')->info('MAIL SENT TO MODERATOR FOR POST: ' . $this->post->title);
    }
}