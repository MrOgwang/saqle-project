<?php
declare(strict_types = 1);

namespace App\Routes;

use SaQle\Auth\Guards\Guard;
use SaQle\Core\Support\RouteResolver;

final class HomeResolver implements RouteResolver {

	 public function routes() : array {
	 	 return [
		     'landing' => fn($r) => $r->target('cta')->compose_with(['landing'])->name('app.landing'),
		     'waffle' => fn($r) => $r->target('home')->name('app.waffle')
	     ];
	 }

	 public function resolve($request) : string {
	 	 return !Guard::check('authenticated', $request->user) ? 'landing' : 'waffle';
	 }
}