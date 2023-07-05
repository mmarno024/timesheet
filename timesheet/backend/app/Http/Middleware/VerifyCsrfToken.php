<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
	/**
	 * The URIs that should be excluded from CSRF verification.
	 *
	 * @var array
	 */
	protected $except = [
		'api/*',
		'http://localhost/tatonas/webmon/monitoring/webadm/p/key',
		'http://localhost/tatonas/webmon/monitoring/webadm/p/send',
		'http://localhost/tatonas/webmon/monitoring/webadm/p/gpa',
		'http://localhost/tatonas/webmon/monitoring/webadm/p/tlcam',
		'http://localhost/tatonas/webmon/monitoring/webadm/p/wlcam',
		'http://localhost/tatonas/webmon/monitoring/webadm/p/rfcam',
		'http://localhost/tatonas/webmon/monitoring/webadm/p/gpaftpcam',
		'http://localhost/tatonas/webmon/monitoring/webadm/p/gpajwtcam',
	];

	public function handle($request, Closure $next)
	{
		if (
			$this->isReading($request) ||
			$this->runningUnitTests() ||
			$this->inExceptArray($request) ||
			$this->tokensMatch($request)
		) {
			return $this->addCookieToResponse($request, $next($request));
		}

		return response()->json('Token Mismatch / Session Expired', 401);
	}
}
