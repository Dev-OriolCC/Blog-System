<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Condition
        if (Category::all()->count() == 0) {
            // FLASH MSG
            session()->flash('error', 'You need to create a Category to able to add a Post 😔');
            return redirect(route('categories.index'));
        }
        return $next($request);
    }
}
