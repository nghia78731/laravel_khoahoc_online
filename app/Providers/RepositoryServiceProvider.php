<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Repositories\Students\StudentsRepository::class,
                                        \App\Repositories\Students\StudentsRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Teachers\TeachersRepository::class,
                                        \App\Repositories\Teachers\TeachersRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Users\UserRepository::class,
                                        \App\Repositories\Users\UserRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Classs\ClasssRepository::class,
                                        \App\Repositories\Classs\ClasssRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Attend\AttendRepository::class,
                                            \App\Repositories\Attend\AttendRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Notification\NotificationRepository::class,
                                        \App\Repositories\Notification\NotificationRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Chat\ChatRepository::class,
                                    \App\Repositories\Chat\ChatRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Chapter\ChapterRepository::class,
            \App\Repositories\Chapter\ChapterRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Lession\LessionRepository::class,
            \App\Repositories\Lession\LessionRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Quiz\QuizRepository::class,
                    \App\Repositories\Quiz\QuizRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\Question\QuestionRepository::class,
            \App\Repositories\Question\QuestionRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\QuizResult\QuizResultRepository::class,
            \App\Repositories\QuizResult\QuizResultRepositoryEloquent::class);
        $this->app->singleton(\App\Repositories\OrderClass\OrderClassRepository::class,
                    \App\Repositories\OrderClass\OrderClassRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\StudentsRepositoryEloquentRepository::class, \App\Repositories\StudentsRepositoryEloquentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentsRepositoryRepository::class, \App\Repositories\StudentsRepositoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TeachersRepositoryRepository::class, \App\Repositories\TeachersRepositoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepositoryRepository::class, \App\Repositories\UserRepositoryRepositoryEloquent::class);
        //:end-bindings:
    }
}
