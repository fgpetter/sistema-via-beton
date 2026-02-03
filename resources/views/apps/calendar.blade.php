@extends('layouts.vertical', ['title' => 'Calendar'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Calendar'])

    <div class="grid lg:grid-cols-4 gap-5">
        <div class="lg:col-span-3">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div><!--end col-->
        <div class="col-span-1">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-4 text-15">Draggable Events</h6>
                    <div class="flex flex-col gap-3" id="external-events">
                        <p class="text-default-400">Drag and drop your event or click in the calendar</p>
                        <div class="external-event fc-event text-success" data-class="!text-success">
                            <i class="iconify tabler--circle-filled me-2"></i>New Event Planning
                        </div>
                        <div class="external-event fc-event text-info" data-class="!text-info">
                            <i class="iconify tabler--circle-filled me-2"></i>Meeting
                        </div>
                        <div class="external-event fc-event text-warning" data-class="!text-warning">
                            <i class="iconify tabler--circle-filled me-2"></i>Generating Reports
                        </div>
                        <div class="external-event fc-event text-danger" data-class="!text-danger">
                            <i class="iconify tabler--circle-filled me-2"></i>Create New theme
                        </div>
                        <div class="flex items-center gap-2">
                            <input class="form-checkbox" id="drop-remove" type="checkbox" />
                            <label class="align-middle cursor-pointer" for="drop-remove">Remove after drop</label>
                        </div>
                        <div class="flex items-center gap-2">
                            <input class="form-checkbox" id="businessCalendar" type="checkbox" />
                            <label class="align-middle cursor-pointer" for="businessCalendar">Business Hours &amp;
                                Week</label>
                        </div>
                        <div class="flex items-center gap-2">
                            <input class="form-checkbox" id="weekNumberCalendar" type="checkbox" />
                            <label class="align-middle cursor-pointer" for="weekNumberCalendar">Week Number</label>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end grid-->

    <!-- Event Add Modal -->
    <div id="event-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="event-modal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div class="card w-full flex flex-col border border-default-200 shadow-2xs rounded-xl pointer-events-auto">
                <div class="card-header">
                    <h3 id="modal-title" class="font-semibold text-base text-default-800 dark:text-white">
                        Add Event
                    </h3>
                    <button type="button" class="size-5 text-default-800" aria-label="Close"
                        data-hs-overlay="#event-modal">
                        <span class="sr-only">Close</span>
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>

                <form class="needs-validation" name="event-form" id="form-event" autocomplete="off">
                    <div class="card-body">
                        <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                            <div class="xl:col-span-12">
                                <label for="event-title" class="inline-block mb-2 text-base font-medium">Event Name</label>
                                <input type="text" id="event-title" class="form-input" placeholder="Event name" required>
                            </div>

                            <div class="xl:col-span-12">
                                <label for="event-category" class="inline-block mb-2 text-base font-medium">Category</label>
                                <select class="form-input flex items-center" name="event-category" id="event-category"
                                    required>
                                    <option>Select Category</option>
                                    <option selected value="!text-primary">Primary</option>
                                    <option value="!text-success">Success</option>
                                    <option value="!text-info">Info</option>
                                    <option value="!text-warning">Warning</option>
                                    <option value="!text-danger">Danger</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer flex gap-2 md:justify-end">
                        <button type="reset" data-hs-overlay="#event-modal"
                            class="bg-transparent text-danger btn border-0 hover:bg-red-50">Cancel</button>

                        <button type="reset" id="btn-delete-event"
                            class="bg-transparent  text-danger btn border-0 hover:bg-red-50">Delete</button>

                        <button type="submit" id="btn-save-event" class="btn bg-primary text-white">Add Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Event Add Modal -->
@endsection

@section('scripts')
    @vite(['resources/js/pages/apps-calendar.js'])
@endsection
