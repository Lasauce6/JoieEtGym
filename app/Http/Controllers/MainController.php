<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MainController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view('index');
    }

    public function inscription(): View|Application|Factory
    {
        return view('inscription');
    }

    public function register(): View|Application|Factory
    {
        return view('auth.register');
    }

    public function planning(): Application|Factory|View
    {
        return view('planning');
    }

    /**
     * @throws Exception
     */
    public function loadPlanning(): JsonResponse
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $courses = Course::with('animators')
            ->whereBetween('start', [$startOfWeek, $endOfWeek])
            ->orderBy('start')
            ->get();

        $events = $courses->map(function ($course) {
            $animatorData = $course->animators->map(function ($animator) {
                return [
                    'name' => $animator->name,
                    'photo' => $animator->photo_url,
                    'bio' => $animator->bio,
                ];
            });
            return [
                'id' => $course->id,
                'title' => $course->title,
                'start' => $course->start->toIso8601String(),
                'end' => $course->end->toIso8601String(),
                'location' => $course->location,
                'latitude' => $course->latitude,
                'longitude' => $course->longitude,
                'color' => $course->color,
                'animators' => $animatorData,
            ];
        });

        return response()->json($events);
    }

    public function cours(): View|Application|Factory
    {
        return view('cours');
    }

    public function tarifs(): View|Application|Factory
    {
        return view('tarifs');
    }

    public function login(): View|Factory|Application
    {
        return view('auth.login');
    }

    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'L\'email ou le mot de passe est incorrect.',
        ]);

    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

    public function sitemap(): BinaryFileResponse
    {
        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
        return response()->file(public_path('sitemap.xml'));
    }
}
