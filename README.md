alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'



sail artisan migrate:fresh --seed