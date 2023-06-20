@extends('layouts.app')
@section('additional-resources')
    <style>
        body {
            background: url({{ asset('images/about-BG.png') }});
            background-size: cover;
        }
        main {
            padding: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="container max" style="max-width: 1400px">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-lg-5 p-4 bg-white rounded-4" style="--bs-bg-opacity: .8;">
                    <h1>About</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt dolorem doloribus vero nulla sapiente unde corrupti magni officia esse. Quos, animi. Tempora odit autem odio sed, ut totam atque reiciendis sequi laboriosam enim obcaecati, aliquam molestias! Necessitatibus veritatis qui minus laboriosam, suscipit, nemo minima pariatur voluptatem enim sit autem quaerat tempore laborum facere deserunt eius tempora repellat iste aperiam corrupti? Debitis, impedit tempore cumque a iste ea aperiam asperiores cum perspiciatis?</p>
                    <h3>GitHub repo</h3>
                    <strong>Here you can find the link of my GitHub repository for my this project, where you can find the overview of my progress</strong>
                    <a href="https://github.com/Saplistic/First-Fullstack-Lara-Project">https://github.com/Saplistic/First-Fullstack-Lara-Project</a>
                </div>
                
                <div class="col-lg-5 p-4 bg-white rounded-4" style="--bs-bg-opacity: .8;">
                    <h3>Resources used to realise my project</h3>
                    <p>Below you can find a list of the resources I used to make this project</p>
                    <h5>Sources</h5>
                    <ul>
                        <li>
                            Bootstrap
                            <a href="https://getbootstrap.com">https://getbootstrap.com</a>
                        </li>
                        <li>Bootstrap icons
                            <a href="https://icons.getbootstrap.com">https://icons.getbootstrap.com</a>
                        </li>
                    </ul>
                    <h5>Courses</h5>
                    <ul>
                        <li>Guestbook demo video
                            <a href="https://ehb.instructuremedia.com/embed/edeb8a9e-3e8f-4af3-85f9-8be5ae754e7d">https://ehb.instructuremedia.com/embed/edeb8a9e-3e8f-4af3-85f9-8be5ae754e7d</a>
                        </li>
                        <li>File upload video
                            <a href="https://www.youtube.com/watch?v=IMld7bPw8P4">https://www.youtube.com/watch?v=IMld7bPw8P4</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
