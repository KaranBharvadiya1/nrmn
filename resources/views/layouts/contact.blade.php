<section id="contact" class="bg-gray-100" aria-labelledby="contact-heading">
  <div class="max-w-screen-xl px-6 py-12 mx-auto">
    
    <!-- Header -->
    <header>
      <p class="text-blue-600 font-semibold">Contact us</p>
      <h2 id="contact-heading" class="mt-2 text-2xl md:text-3xl font-bold text-gray-800">Chat with our friendly team</h2>
      <p class="mt-3 text-gray-600">We’d love to hear from you. Please fill out this form or shoot us an email.</p>
    </header>

    <!-- Contact Grid -->
    <div class="grid gap-12 mt-10 lg:grid-cols-2">

      <!-- Contact Info Boxes -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10" role="list" aria-label="Contact information">
        @php
          $contacts = [
            ['icon' => 'envelope', 'label' => 'Email', 'desc' => 'Our friendly team is here to help.', 'value' => 'hello@nirmaan.com', 'href' => 'mailto:hello@nirmaan.com'],
            ['icon' => 'chat', 'label' => 'Live chat', 'desc' => 'Reach out anytime.', 'value' => 'Start new chat', 'href' => '#'],
            ['icon' => 'map', 'label' => 'Office', 'desc' => 'Visit our HQ.', 'value' => '100 Smith Street, Collingwood, VIC 3066', 'href' => null],
            ['icon' => 'phone', 'label' => 'Phone', 'desc' => 'Mon-Fri from 8am to 5pm.', 'value' => '+91 98765 43210', 'href' => 'tel:+919876543210'],
          ];
        @endphp

        @foreach ($contacts as $item)
        <article role="listitem" tabindex="0" class="group">
          <div class="p-3 bg-blue-600 text-white rounded-full inline-flex items-center justify-center w-10 h-10" aria-hidden="true">
            @if($item['icon'] === 'envelope')
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75" /></svg>
            @elseif($item['icon'] === 'chat')
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" stroke="currentColor" fill="none" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
            @elseif($item['icon'] === 'map')
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" stroke="currentColor" fill="none" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2C7.03 2 3 6.03 3 11c0 4.9 9 11 9 11s9-6.1 9-11c0-4.97-4.03-9-9-9z" /></svg>
            @else
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" stroke="currentColor" fill="none" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.28 6.72 15 15 15H20.5a2.25 2.25 0 002.25-2.25v-1.37a1.12 1.12 0 00-.85-1.09l-4.42-1.11a1.12 1.12 0 00-1.17.42l-.97 1.29a1.12 1.12 0 01-1.21.38c-3.63-1.1-6.67-4.15-7.14-7.15a1.12 1.12 0 01.38-1.21l1.29-.97a1.12 1.12 0 00.42-1.17L6.96 3.1a1.12 1.12 0 00-1.09-.85H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
            @endif
          </div>
          <h3 class="mt-4 text-base font-medium text-gray-800">{{ $item['label'] }}</h3>
          <p class="mt-2 text-sm text-gray-500">{{ $item['desc'] }}</p>
          <p class="mt-1 text-sm text-blue-600">
            @if($item['href'])
              <a href="{{ $item['href'] }}" class="hover:underline" target="_blank" rel="noopener noreferrer">{{ $item['value'] }}</a>
            @else
              {{ $item['value'] }}
            @endif
          </p>
        </article>
        @endforeach
      </div>

      <!-- Contact Form -->
      <div class="bg-white p-6 rounded-lg shadow-sm">
        <form method="POST" action="{{ route('contact.submit') }}" aria-label="Contact form" novalidate>
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="first_name" class="text-sm text-gray-700">First Name</label>
              <input id="first_name" type="text" name="first_name" required aria-required="true" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <div>
              <label for="last_name" class="text-sm text-gray-700">Last Name</label>
              <input id="last_name" type="text" name="last_name" required aria-required="true" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500" />
            </div>
          </div>

          <div class="mt-4">
            <label for="email" class="text-sm text-gray-700">Email Address</label>
            <input id="email" type="email" name="email" required aria-required="true" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500" />
          </div>

          <div class="mt-4">
            <label for="message" class="text-sm text-gray-700">Message</label>
            <textarea id="message" name="message" rows="5" required aria-required="true" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>

          <button type="submit" class="mt-5 w-full py-3 px-4 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-lg transition focus:ring-4 focus:ring-blue-300">
            Send Message
          </button>
        </form>
      </div>

    </div>
  </div>
</section>
