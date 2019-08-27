# dependent-dropdown-with-voyager
Dependent Dropdown with Voyager
 
# Install
Download zip https://github.com/d3turnes/dependent-dropdown-with-voyager/archive/master.zip
 
Copy/Paste the content of routes/api.php in your file routes/api.php

Copy/Paste the content of app/Providers/AppServiceProvider.php in your file app/Providers/AppServiceProvider.php

`
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;

use App\FormFields\SelectDependentDropdown;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Voyager::addFormField(SelectDependentDropdown::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
`
