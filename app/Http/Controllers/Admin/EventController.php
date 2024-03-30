<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventContent;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::get();
        return view('pages.event.index', compact('events'));
    }
    public function createEventForm()
    {
        return view('pages.event.create');
    }
    public function createEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'sub_title_1' => 'required|string|max:250',
            'sub_content_1' => 'required|string|max:250',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = Cloudinary::upload($request->file('banner')->getRealPath())->getSecurePath();

        $event = Event::create([
            'title' => $request->input('title'),
            'banner' => $imagePath,
            'start' => $request->input('start'),
            'end' => $request->input('end'),
        ]);

        $maxIndex = 0;

        for ($i = 1; $i <= 5; $i++) {
            if ($request->has("sub_title_$i") && $request->has("sub_content_$i")) {
                $maxIndex = $i;
            } else {
                break;
            }
        }

        $missingData = false;
        for ($i = 1; $i <= 5; $i++) {
            if ($request->has("sub_title_$i") && !$request->has("sub_content_$i")) {
                $missingData = true;
                break;
            } elseif (!$request->has("sub_title_$i") && $request->has("sub_content_$i")) {
                $missingData = true;
                break;
            }
        }
        if ($missingData) {
            return redirect()->back()->withErrors("Can't create when missing sub content or sub title");
        }

        for ($i = 1; $i <= $maxIndex; $i++) {
            if ($request->has("sub_title_$i") && $request->has("sub_content_$i")) {
                EventContent::create([
                    "event_id" => $event->id,
                    "sub_title" => $request->input("sub_title_$i"),
                    "sub_content" => $request->input("sub_content_$i"),
                ]);
            }
        }

        return redirect('/admin/event-manage')->with(['success' => 'Event created successfully']);
    }

    public function updateEventStatus($id)
    {
        $event = Event::find($id);
        $event->status = !$event->status;
        $event->save();
        return redirect('/admin/event-manage')->with(['success' => 'Event status updated successfully']);
    }
}
