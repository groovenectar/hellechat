<div x-cloak x-show="showVoicemailOpen" class="fixed inset-0 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <div class="absolute inset-0 overflow-hidden">
        <!-- Background overlay, show/hide based on slide-over state. -->
        <div class="absolute inset-0" aria-hidden="true">
            <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex"
                x-cloak
                x-show="showVoicemailOpen"
                x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">

                <div class="w-screen max-w-md">
                    <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                        <div class="px-4 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                                    Voicemail
                                </h2>
                                <div class="ml-3 h-7 flex items-center">
                                    <button @click="showVoicemailOpen = false;" type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <span class="sr-only">Close panel</span>
                                        <!-- Heroicon name: outline/x -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="relative flex-1 px-4 sm:px-6">


                            <div class="pb-1 sm:pb-6">
                                <div>
                                    <div class="mt-6 sm:mt-8 sm:flex sm:items-end ">
                                        <div class="sm:flex-1">
                                            <div>
                                                <div class="flex items-center">
                                                    <h3 class="font-bold text-xl text-gray-900 sm:text-2xl">Ashley Porter</h3>
                                                </div>
                                                <p class="text-sm text-gray-500">Acme Incorporated</p>
                                                <p class="mt-6 text-xs  text-gray-400">
                                                    January 23, 2021 at 9:15 AM
                                                </p>
                                            </div>

                                            <div class="mt-1 mb-6 border-t border-b border-gray-200">
                                                @include('livewire.voicemail-manager._slider')
                                            </div>

                                            <div class="mt-5 flex flex-wrap space-x-3 sm:space-x-3">
                                                <button type="button" class="flex-1 w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Message
                                                </button>
                                                <button type="button" class="flex-1 w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Call
                                                </button>
                                                <button type="button" class="flex-1 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Delete
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mt-3 space-y-3">
                                <p class="text-gray-900 font-bold">Transcription</p>
                                <p class="text-gray-500 text-sm">
                                    I'm baby pug vinyl succulents, intelligentsia typewriter four loko vape. Kombucha bushwick vexillologist meh irony, before they sold out butcher narwhal gastropub tousled. Kombucha banjo 90's hella biodiesel, tote bag sriracha sartorial vexillologist. Fixie craft beer lumbersexual cred iceland. Woke church-key jean shorts, green juice shoreditch yuccie helvetica poutine. Banjo raclette slow-carb pop-up. Cloud bread fashion axe vegan, flexitarian gochujang venmo listicle pitchfork everyday carry deep v YOLO subway tile.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>