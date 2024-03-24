<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Google\Client as GoogleClient;
use GuzzleHttp\Client as GuzzleClient;
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

    public function news(): View|Application|Factory
    {
        return view('news');
    }

    public function planning(): Application|Factory|View
    {
        return view('planning');
    }

    public function loadPlanning(): JsonResponse
    {
        $client = new GoogleClient();
        $client->setApplicationName('Agenda');
        $client->setScopes(\Google_Service_Calendar::CALENDAR);
        $client->setDeveloperKey("AIzaSyAjgfE_sxrqQe3C5nwXmNI0BWLwT0cV-HM");
        $service = new \Google_Service_Calendar($client);
        $calendarId = '70e8e6af536fe8e57ccbcb3882f80dd3a8f2866781534598537be93e3ce4813a@group.calendar.google.com';

        $startOfWeek = date('Y-m-d', strtotime('monday this week')) . 'T00:00:00Z';
        $startOfNextWeek = date('Y-m-d', strtotime('monday next week')) . 'T00:00:00Z';
        $optParams = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => $startOfWeek,
            'timeMax' => $startOfNextWeek,
            'timeZone' => 'Europe/Paris',
        );

        $results = $service->events->listEvents($calendarId, $optParams)->getItems();
        $filteredResults = [];

        foreach ($results as $result) {
            if (str_contains($result->summary, 'Aqua')) {
                $result->color = '#4285F4FF';
            } else if (str_contains($result->summary, 'Yoga Nidra')) {
                $result->color = '#33B679FF';
            } else if (str_contains($result->location, 'Épinay')) {
                $result->color = '#33B679FF';
            } else if (str_contains($result->location, 'Boussy')) {
                $result->color = '#F4511EFF';
            } else {
                $result->color = '#F6BF26FF';
            }

            $guzzleClient = new GuzzleClient();

            $geocodeUrl = 'https://maps.googleapis.com/maps/api/geocode/json';
            $geocodeResponse = $guzzleClient->get($geocodeUrl, [
                'query' => [
                    'address' => $result->location,
                    'key' => 'AIzaSyASp72IjHskwrcCWyhdFsixQxTICadnwLE',
                ]
            ]);

            $geocodeData = json_decode($geocodeResponse->getBody(), true);

            if ($geocodeData['status'] === 'OK') {
                $result->latitude = $geocodeData['results'][0]['geometry']['location']['lat'];
                $result->longitude = $geocodeData['results'][0]['geometry']['location']['lng'];
            } else {
                $result->latitude = null;
                $result->longitude = null;
            }

            $filteredResult = [
                'title' => $result->summary,
                'start' => $result->start->dateTime,
                'end' => $result->end->dateTime,
                'description' => $result->description,
                'location' => $result->location,
                'latitude' => $result->latitude,
                'longitude' => $result->longitude,
                'color' => $result->color,
            ];

            $filteredResults[] = $filteredResult;
        }

        return response()->json($filteredResults);
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
