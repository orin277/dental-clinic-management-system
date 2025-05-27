<x-guest-layout>
    <section class="w-10/12 mt-6 py-8 bg-white border border-gray-200 rounded-lg shadow md:py-16 dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xs px-4 mx-auto 2xl:px-0">
        <div class="lg:grid lg:grid-cols-2 lg:gap-4 xl:gap-8">
            <div class="shrink-0 max-w-sm lg:max-w-lg ">
                <img class="w-4/5 mx-auto" src="{{ asset("storage/avatars/" . $dentist->avatar) }}" alt="" />
            </div>

            <div class="mt-6 sm:mt-8 lg:mt-0">
                <h1
                    class="text-xl font-inter-bold text-gray-900 sm:text-2xl dark:text-white"
                >
                    {{ $dentist->surname . ' ' . $dentist->name . ' ' . $dentist->patronymic }}
                </h1>
                <div class="mt-2 sm:items-center sm:gap-4 sm:flex">
                    <p class="text-xl font-inter-medium text-gray-900 sm:text-xl dark:text-white">
                        {{ $dentist->dentist_specialization_name }}
                    </p>
                </div>
                <div class="mt-2 sm:items-center sm:gap-4 sm:flex">
                    <p class="text-lg font-inter-medium text-gray-900 sm:text-xl dark:text-white">
                        {{ 'Досвід роботи: ' . $dentist->work_experience . ' років' }}
                    </p>
                </div>

                <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
                Освіта
                @foreach ($educations as $education)
                <p class="mb-6 text-gray-500 dark:text-gray-400">
                    {{ $education->name_of_institution . ' (' . $education->graduation_year . ')' }}
                </p>
                @endforeach
            </div>
        </div>
    </div>
</section>
</x-guest-layout>
