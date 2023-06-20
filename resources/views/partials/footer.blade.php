<footer class="py-3 mt-4" style="background-color: rgb(243, 243, 243)">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="{{ route('posts.index') }}" class="nav-link px-2 text-muted">Posts</a></li>
      <li class="nav-item"><a href="{{ route('FAQs') }}" class="nav-link px-2 text-muted">FAQs</a></li>
      <li class="nav-item"><a href="{{ route('about') }}" class="nav-link px-2 text-muted">About</a></li>
      <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link px-2 text-muted">Contact us</a></li>
    </ul>
    <p class="text-center text-muted">© 2023 {{ config('app.name', 'Laravel') }}</p>
</footer>